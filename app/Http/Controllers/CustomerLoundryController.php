<?php

namespace App\Http\Controllers;

use App\Models\CustomerLoundry;
use App\Models\PaymentMethod;
use App\Models\SpesificationLoundry;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerLoundryController extends Controller
{
    public function getEntry()
    {
        $spesifications = SpesificationLoundry::where('user_id', auth()->user()->id)->get();
        $payment_methods = PaymentMethod::where('user_id', auth()->user()->id)->get();
        return view('entry_data.index', compact('spesifications', 'payment_methods'));
    }

    public function insertEntry(Request $request)
    {
        $request->validate([
            'name_customer_loundry' => ['required'],
            'spesification_loundry_id' => ['required'],
            'quantity_loundry' => ['required'],
            'end_loundry_customer' => ['required'],
            'phone_number_customer_loundry' => ['required'],
        ]);

        CustomerLoundry::create([
            'user_id' => auth()->user()->id,
            'id_customer' => "#" . uniqid(),
            'name_customer_loundry' => $request->name_customer_loundry,
            'spesification_loundry_id' => $request->spesification_loundry_id,
            'quantity_loundry' => $request->quantity_loundry,
            'result_price_loundry' => "0",
            'end_loundry_customer' => $request->end_loundry_customer,
            'phone_number_customer_loundry' => $request->phone_number_customer_loundry,
            'address_customer_loundry' => $request->address_customer_loundry ? $request->address_customer_loundry : "tidak diantar",
        ]);

        $userLatest = CustomerLoundry::where('user_id', auth()->user()->id)->latest()->first();

        $quantity = $userLatest->quantity_loundry;
        $spesifications = $userLatest->spesificationLoundry->price_kg_loundry;

        if ($userLatest['address_customer_loundry'] != "tidak diantar") {
            CustomerLoundry::where('user_id', auth()->user()->id)->update([
                'result_price_loundry' => ($quantity * $spesifications) + 5000,
            ]);
        } else {
            CustomerLoundry::where('user_id', auth()->user()->id)->update([
                'result_price_loundry' => $quantity * $spesifications,
            ]);
        }
        return redirect()->route('payment.checkout')->with('success', 'Data customer berhasil ditambahkan!');
    }

    public function getEdit()
    {
        $spesifications = SpesificationLoundry::where('user_id', auth()->user()->id)->get();
        $customer = CustomerLoundry::where('user_id', auth()->user()->id)->latest()->first();
        return view('entry_data.index', compact('customer', 'spesifications'));
    }

    public function updateCustomer()
    {
        $customer = CustomerLoundry::where('user_id', auth()->user()->id)->latest()->first();
        $customer->update([
            'name_customer_loundry' => request('name_customer_loundry'),
            'spesification_loundry_id' => request('spesification_loundry_id'),
            'quantity_loundry' => request('quantity_loundry'),
            'end_loundry_customer' => request('end_loundry_customer'),
            'phone_number_customer_loundry' => request('phone_number_customer_loundry'),
            'address_customer_loundry' => request('address_customer_loundry'),
        ]);

        $quantity = $customer->quantity_loundry;
        $spesifications = $customer->spesificationLoundry->price_kg_loundry;

        if ($customer['address_customer_loundry'] != "tidak diantar") {
            $customer->update([
                'result_price_loundry' => ($quantity * $spesifications) + 5000,
            ]);
        } else {
            $customer->update([
                'result_price_loundry' => $quantity * $spesifications,
            ]);
        }
        return redirect()->route('payment.checkout')->with('success', 'Data customer berhasil diubah!');
    }

    public function deleteCustomer($id)
    {
        $customer = CustomerLoundry::find($id);
        $customer->delete();
        return redirect()->route('customer')->with('success', 'Data customer berhasil dihapus!');
    }

    public function notaCustomer($id)
    {
        $imageLoundry = User::where('id', auth()->user()->id)->first();
        $userLoundry = CustomerLoundry::find($id);
        return view('nota.index', compact('userLoundry', 'imageLoundry'));
    }
}
