<?php

namespace App\Http\Controllers;

use App\Models\CustomerLoundry;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $dataset = [];
        foreach (range(1, 12) as $month) {
            $customerLoundryStatistic = CustomerLoundry::where('user_id', auth()->user()->id)
                ->whereMonth('start_loundry_customer', $month)->count();
            $dataset[$month] = $customerLoundryStatistic;
        }

        $dataPembayaran = [];
        $dataPaymentUser = PaymentMethod::where('user_id', auth()->user()->id)->get();
        foreach ($dataPaymentUser as $payment) {
            $dataPembayaran[$payment->name_payment_method]['count'] = CustomerLoundry::where('user_id', auth()->user()->id)
                ->where('payment_method_id', $payment->id)->count();
            $dataPembayaran[$payment->name_payment_method]['data'] = CustomerLoundry::where('user_id', auth()->user()->id)
                ->where('payment_method_id', $payment->id)->get();
        }

        return view('dashboard.index', compact('dataset', 'dataPembayaran'));
    }

    public function tutorial()
    {
        return view('dashboard.tutorials');
    }

    public function dataCustomer()
    {
        $userLog = auth()->user()->id;
        $dataset = CustomerLoundry::where('user_id', $userLog)->get();
        $dataPayment = PaymentMethod::where('user_id', auth()->user()->id)->get();
        return view('customer_data.index', compact('dataset', 'dataPayment'));
    }

    public function dataSorting($namePayment)
    {
        $userLog = auth()->user()->id;
        $datasets = CustomerLoundry::where('user_id', $userLog)->get();
        $dataset = [];

        foreach ($datasets as $data) {
            if ($data->paymentMethod->name_payment_method == $namePayment) {
                $dataset[] = $data;
            } else {
                $dataset = CustomerLoundry::where('user_id', $userLog)->get();
            }
        }

        $dataPayment = PaymentMethod::where('user_id', auth()->user()->id)->get();
        return view('customer_data.index', compact('dataset', 'dataPayment'));
    }
}
