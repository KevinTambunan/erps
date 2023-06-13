<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Erp;
use App\Models\ErpRecomendation;
use App\Models\FunctionArea;
use App\Models\Fungsionalitas;
use App\Models\Modul;
use App\Models\OtherRequirement;
use App\Models\Owner;
use App\Models\Type;
use App\Models\UserNeed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function register_admin(){
        return view('auth.register_admin');
    }
    public function welcome()
    {
        return view('welcome');
    }

    public function home()
    {
        if (Auth::user()->role == 'admin') {
            return view('admin.index');
        } else if (Auth::user()->role == 'user') {
            $erps = Erp::take(3)->get();
            $erps_result = ErpRecomendation::where('user_id', Auth::user()->id)->take(5)->get();
            $owner = Owner::where('user_id', Auth::user()->id)->get()->last();
            $company = Company::where('user_id', Auth::user()->id)->get()->last();
            return view('user.index', compact(['erps', 'erps_result', 'owner', 'company']));
        }
    }

    public function erp($id)
    {
        $feedback = session('feedback');
        $error = session('error');
        $erp = Erp::where('id', $id)->get()->last();
        if ($erp == null) {
            $erp = null;
        }
        $erps = Erp::all();
        return view('admin.erp', compact(['erp', 'erps', 'feedback', 'error']));
    }

    public function erp_create()
    {
        return view('admin.erp-create');
    }

    public function modul()
    {
        $moduls = Modul::all();
        $erp = Erp::all();
        // dd($moduls);
        return view('admin.modul', compact(['moduls', 'erp']));
    }

    public function fungsionalitas()
    {
        $moduls = Modul::all();
        $erp = Erp::all();
        $fungsionalitas = Fungsionalitas::all();
        // dd($moduls);
        return view('admin.fungsionalitas', compact(['moduls', 'erp', 'fungsionalitas']));
    }

    public function function_area()
    {
        $moduls = Modul::all();
        $erp = Erp::all();
        $fungsionalitas = Fungsionalitas::all();
        $function_area = FunctionArea::all();
        // dd($moduls);
        return view('admin.function-area', compact(['moduls', 'erp', 'fungsionalitas', 'function_area']));
    }

    public function user_need()
    {
        $moduls = Modul::all();
        $erp = Erp::all();
        $user_needs = UserNeed::all();
        // dd($moduls);
        return view('admin.user-need', compact(['erp', 'user_needs']));
    }

    public function type()
    {
        $type = Type::all();
        $erp = Erp::all();
        $user_needs = UserNeed::all();
        // dd($moduls);
        return view('admin.type', compact(['erp', 'user_needs', 'type']));
    }

    public function other_requirement()
    {
        $type = Type::all();
        $erp = Erp::all();
        $other_requirement = OtherRequirement::all();
        // dd($moduls);
        return view('admin.other-requirement', compact(['erp', 'other_requirement', 'type']));
    }


    // user owner

    public function profile()
    {
        $feedback = session('feedback');
        $error = session('error');
        $owner = Owner::where("user_id", Auth::user()->id)->get()->last();
        $company = Company::where("user_id", Auth::user()->id)->get()->last();
        return view('user.profile', compact(['feedback', 'company', 'owner', 'error']));
    }
    public function erp_user($id)
    {
        $feedback = session('feedback');
        $error = session('error');
        $erp = Erp::where('id', $id)->get()->last();
        if ($erp == null) {
            $erp = null;
        }
        $erps = Erp::all();
        return view('user.erp', compact(['erp', 'erps', 'feedback', 'error']));
    }

    public function erp_recomendation()
    {
        $moduls = Modul::all();
        $fungsionalitas = Fungsionalitas::all();
        $function_area = FunctionArea::all();
        $user_needs = UserNeed::all();
        $types = Type::all();
        $other_requirements = OtherRequirement::all();
        return view('user.erp-recomendation', compact(['moduls', 'fungsionalitas', 'function_area', 'user_needs', 'types', 'other_requirements']));
    }

    public function erp_report()
    {
        $erp_result = ErpRecomendation::where('user_id', Auth::user()->id)->get();
        return view('user.erp-report', compact(['erp_result']));
    }
    public function dashboard()
    {
        return view('user.index');
    }
}
