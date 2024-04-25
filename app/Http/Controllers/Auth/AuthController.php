<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Models\SpesificationLoundry;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email_user' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email_user', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }
        return redirect()->back()->with('error', 'Email atau Password salah');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerStore(Request $request)
    {
        $request->validate([
            'name_user' => 'required',
            'email_user' => 'required|email',
            'password' => 'required',
            'phone_number_user' => 'required',
            'loundry_name_user' => 'required',
            'image_loundry_user' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $userLog = User::create([
            'name_user' => $request->name_user,
            'email_user' => $request->email_user,
            'password' => bcrypt($request->password),
            'phone_number_user' => $request->phone_number_user,
            'loundry_name_user' => $request->loundry_name_user,
            'image_loundry_user' => $request->file('image_loundry_user')->store('icon_user_loundry'),
            'id_loundry' => "#" . Str::random(6),
        ]);

        // example services
        SpesificationLoundry::create([
            'user_id' => $userLog->id,
            'name_spesification_loundry' => "Cuci Kering",
            'price_kg_loundry' => 5000,
        ]);

        PaymentMethod::create([
            'user_id' => $userLog->id,
            'name_payment_method' => "Cash",
        ]);
        return redirect()->route('login')->with('success', 'Sistem Loundry Berhasil Dibuat, silahkan login terlebih dahulu');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
