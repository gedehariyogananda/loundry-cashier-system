<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\SpesificationLoundry;
use Illuminate\Http\Request;

class SpesificationLoundryController extends Controller
{
    public function getService()
    {
        $spesificationCuci = SpesificationLoundry::where('user_id', auth()->user()->id)->get();
        $paymentMethod = PaymentMethod::where('user_id', auth()->user()->id)->get();
        return view('service.index', compact('spesificationCuci', 'paymentMethod'));
    }

    public function updateServiceCuci($id, Request $request)
    {
        $spesification = SpesificationLoundry::find($id);
        $spesification->update([
            'price_kg_loundry' => $request->price_kg_loundry,
            'name_spesification_loundry' => $request->name_spesification_loundry,
        ]);
        return redirect()->route('service.index')->with('success', 'Data spesifikasi loundry berhasil diubah!');
    }

    public function updateServicePayment($id, Request $request)
    {
        $payment = PaymentMethod::find($id);
        $payment->update([
            'name_payment_method' => $request->name_payment_method,
        ]);
        return redirect()->route('service.index')->with('success', 'Data metode pembayaran berhasil diubah!');
    }

    public function addServiceCuci(Request $request)
    {
        $request->validate([
            'name_spesification_loundry' => ['required'],
            'price_kg_loundry' => ['required'],
        ]);

        SpesificationLoundry::create([
            'user_id' => auth()->user()->id,
            'name_spesification_loundry' => $request->name_spesification_loundry,
            'price_kg_loundry' => $request->price_kg_loundry,
        ]);

        return redirect()->route('service.index')->with('success', 'Data spesifikasi loundry berhasil ditambahkan!');
    }

    public function addServicePayment(Request $request)
    {
        $request->validate([
            'name_payment_method' => ['required'],
        ]);

        PaymentMethod::create([
            'user_id' => auth()->user()->id,
            'name_payment_method' => $request->name_payment_method,
        ]);

        return redirect()->route('service.index')->with('success', 'Data metode pembayaran berhasil ditambahkan!');
    }
}
