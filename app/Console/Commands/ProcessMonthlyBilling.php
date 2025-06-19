<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\User;
use App\Models\ApiUsage;
use App\Models\Billing;
use App\Jobs\ProcessUserBilling;

class ProcessMonthlyBilling extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-monthly-billing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $month = now()->subMonth()->format('Y-m');
        $users = User::whereHas('subscriptionTier', fn($q) => $q->where('billing_required', true))->get();

        foreach ($users as $user) {
            $count = ApiUsage::where('user_id', $user->id)->whereMonth('date', now()->subMonth()->month)->sum('count');
            $extra = max(0, $count - 10000);
            $rate = $user->subscriptionTier->rate_per_extra_call;

            Billing::create([
                'user_id' => $user->id,
                'month' => $month,
                'included_calls' => 10000,
                'extra_calls' => $extra,
                'total_amount' => $extra * $rate,
            ]);
            ProcessUserBilling::dispatch($user);
        }
    }
}
