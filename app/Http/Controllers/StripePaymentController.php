<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\StripeClient;

class StripePaymentController extends Controller
{
    public function stripe()
    {
        return view('stripe');
    }


    public function stripePost(Request $request)
    {
        $request->validate([
            'card_holder_name' => 'required',
            'card_no' => 'required',
            'card_cvc' => 'required',
            'card_exp_month' => 'required',
            'card_exp_year' => 'required',
            'amount' => 'required',
        ]);

        //Generate Stripe Token

        try {
            $stripe = new StripeClient(env('STRIPE_KEY'));
            $token = $stripe->tokens->create([
                'card' => [
                    'number' => $request->card_no,
                    'exp_month' => $request->card_exp_month,
                    'exp_year' => $request->card_exp_year,
                    'cvc' => $request->card_cvc,
                ],
            ]);

            if (!isset($token['id'])) {
                return back()->with('danger', 'Invalid Token');
            }


            Stripe::setApiKey(env('STRIPE_SECRET'));

            Charge::create([
                'amount' => $request->amount,
                'currency' => 'usd',
                'source' => $token->id,
                'description' => 'Test payment',
            ]);


            return redirect()->route('stripe')->with('success', 'Payment successful!');
        } catch (\Exception $e) {
            return redirect()->route('stripe')->with('danger', $e->getMessage());
        }
    }
}
