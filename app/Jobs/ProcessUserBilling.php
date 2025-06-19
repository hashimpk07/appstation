<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\ApiUsage;
use App\Models\Billing;

class ProcessUserBilling implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    public function __construct($user) { $this->user = $user; }

     public function handle(): void
    {
        $month = now()->subMonth()->format('Y-m');
        $count = ApiUsage::where('user_id', $this->user->id)
            ->whereMonth('date', now()->subMonth()->month)
            ->sum('count');

        $extra = max(0, $count - 10000);
        $rate = $this->user->subscriptionTier->rate_per_extra_call;

        Billing::create([
            'user_id' => $this->user->id,
            'month' => $month,
            'included_calls' => 10000,
            'extra_calls' => $extra,
            'total_amount' => $extra * $rate,
        ]);
    }
}