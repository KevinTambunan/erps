<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Bank;
use App\Models\Homestay;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function listHomestay(){
        $homestays = Homestay::where('status', 'tersedia')->get();
        return view('list', compact(['homestays']));
    }

    public function dashboard()
    {
        if (Auth::user() != null) {
            if (Auth::user()->role == "admin") {
                return view('admin.dashboard');
            } else {
                return view('user.index');
            }
        } else {
            return view('welcome');
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
        $admin_id = User::find(Auth::user()->id)->admin->id;
        $banks = Bank::where('admin_id', $admin_id)->get();
        return view('admin.bank', compact(['banks', 'admin_id']));
    }

    public function pesanan(){
        $admin_id = User::find(Auth::user()->id)->admin->id;
        $homestay = Homestay::where('pemilik_id', $admin_id)->get();
        $pesanans = Pesanan::all();
        return view('admin.pesanan', compact(['pesanans', 'homestay']));

    }
}
