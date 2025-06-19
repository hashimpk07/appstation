<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ApiUsage;
use Carbon\Carbon;

class UsageController extends Controller
{
    public function index(Request $request)
    {
        try{
            $user = $request->user();
            $today = Carbon::today();
            $month = Carbon::now()->month;

            $daily = ApiUsage::where('user_id', $user->id)->where('date', $today)->sum('count');
            $monthly = ApiUsage::where('user_id', $user->id)->whereMonth('date', $month)->sum('count');

            return response()->json([
                'daily_usage' => $daily,
                'monthly_usage' => $monthly,
                'remaining_quota' => max(0, $user->subscriptionTier->daily_limit - $daily)
            ]);
        }catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([   
                'status' => false,
                   'message' => 'User  update failed',
                'errors' => $e->errors()
            ]);
        } 
    }
}
