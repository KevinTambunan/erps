<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function dashboard()
    {
        if (Auth::user() != null) {
            if (Auth::user()->role == "admin") {
                return view('admin.dashboard');
            } else {
                return view('user.index');
            }
        } else {
            return view('auth.login');
        }
    }
    public function home()
    {
        if (Auth::user()->role == "admin") {
            return view('admin.dashboard');
        } else {
            return view('user.index');
        }
    }

    public function akunBank(){
        $banks = Bank::all();
        $admin_id = User::find(Auth::user()->id)->admin->id;
        return view('admin.bank', compact(['banks', 'admin_id']));
    }

    public function pesanan(){
        $pesanans = Pesanan::all();
        return view('admin.pesanan', compact(['pesanans']));

    }
}
