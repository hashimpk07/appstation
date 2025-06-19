<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class AdminController extends Controller
{
    public function setTier(Request $request)
    {
        try{
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'subscription_tier_id' => 'required|exists:subscription_tiers,id'
            ]);

            $user = User::findOrFail($request->user_id);
            $user->subscription_tier_id = $request->subscription_tier_id;
            $user->save();

            return response()->json(['message' => 'User tier updated']);

        }catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([   
                'status' => false,
                   'message' => 'User tier update failed',
                'errors' => $e->errors()
            ]);
        } 
    }
}
