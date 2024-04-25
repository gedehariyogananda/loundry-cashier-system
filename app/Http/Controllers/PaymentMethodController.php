<?php

namespace App\Http\Controllers;

use App\Models\CustomerLoundry;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function getCheckout()
    {
        $imageLoundry = User::where('id', auth()->user()->id)->first();
        $userLoundry = CustomerLoundry::where('user_id', auth()->user()->id)->latest()->first();
        $payments = PaymentMethod::where('user_id', auth()->user()->id)->get();
        return view('checkout.index', compact('userLoundry', 'payments', 'imageLoundry'));
    }

    public function paymentUpdate(Request $request)
    {
        $request->validate([
            'payment_method_id' => 'required',
        ]);

        $userLoundry = CustomerLoundry::where('user_id', auth()->user()->id)->latest()->first();
        $userLoundry->update([
            'payment_method_id' => $request->payment_method_id,
            'status_loundry' => "Success",

        ]);
        return redirect()->route('customer')->with('success', 'Pembayaran Berhasil');
    }
}
