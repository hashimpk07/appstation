<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ApiUsage; 
use App\Models\ApiLog; 

class CheckApiQuota
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $tier = $user->subscriptionTier;
        $today = now()->toDateString();

        if (!$tier) {
            return response()->json([
                'message' => 'No valid subscription tier found for this user.'
            ], 403);
        }

        $usage = ApiUsage::firstOrCreate([
            'user_id' => $user->id,
            'date' => $today,
        ], ['count' => 0]);

        if ($usage->count >= $tier->daily_limit) {
            return response()->json(['message' => 'Quota exceeded'], 429);
        }

        $usage->increment('count');

        ApiLog::create([
            'user_id' => $user->id,
            'endpoint' => $request->path(),
            'status_code' => 200,
            'requested_at' => now(),
        ]);

        return $next($request);
    }
}
