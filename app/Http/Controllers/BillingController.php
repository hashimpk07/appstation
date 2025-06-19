<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Billing;

class BillingController extends Controller
{
    public function index(Request $request)
    {
        try{
            $user = $request->user();
            if (!$user->subscriptionTier->billing_required) {
                return response()->json(['message' => 'No billing for your subscription.'], 403);
            }

            return response()->json(Billing::where('user_id', $user->id)->latest()->get());
        }catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([   
                'status' => false,
                'message' => 'Subscription data failed',
                'errors' => $e->errors()
            ]);
        } 
    }
}
