<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Homestay;
use App\Models\Transportasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomestayController extends Controller
{
    public function tersedia(){
        $homestays = Homestay::where('status', 'tersedia')->get();
        return view('admin.homestay_tersedia', compact(['homestays']));
    }

    public function dibooking(){
        $homestays = Homestay::where('status', 'sedang_dibooking')->get();
        return view('admin.homestay_tersedia', compact(['homestays']));
    }

    public function digunakan(){
        $homestays = Homestay::where('status', 'sedang_digunakan')->get();
        return view('admin.homestay_tersedia', compact(['homestays']));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUser()
    {
        $homestays = Homestay::all();
        $transportasi = Transportasi::all();
        // $homestay = Homestay::find(7);
        // $transportasi = $homestay->transportasi;
        // dd($transportasi->nama);

        return view('user.homestay', compact('homestays', 'transportasi'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAdmin()
    {
        $admin_id = User::find(Auth::user()->id)->admin->id;
        // dd($admin_id);
        // $homestays = Homestay::where("pemilik_id", $admin_id);
        $akun = Admin::where('user_id', Auth::user()->id)->get()->last();
        $homestays = Homestay::where('pemilik_id', $admin_id)->get();
        $transportasi = Transportasi::where('homestay_id', $homestays[0]->id)->get();
        // dd($transportasi);

        return view("admin.homestay", compact(['homestays', 'akun', 'transportasi']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'harga' => 'required',
            'gambar' => 'required',
        ]);

        $product_image = $request->file('gambar');
        $gambar = $product_image->getClientOriginalName();
        $tujuan_upload = './assets/images';
        $product_image->move($tujuan_upload, $gambar);

        $admin_id = User::find(Auth::user()->id)->admin->id;
        Homestay::create([
            'pemilik_id' => $admin_id,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'harga' => $request->harga,
            'gambar' => $gambar,
            'rating' => 0,
            'status' => "tersedia"
        ]);

        return redirect('/homestay');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Homestay  $homestay
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $homestay = Homestay::find($id);
        $ulasans = $homestay->ulasan;
        return view('user.homestay_detail', compact(['homestay', 'ulasans']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Homestay  $homestay
     * @return \Illuminate\Http\Response
     */
    public function edit(Homestay $homestay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Homestay  $homestay
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // dd($request);
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'harga' => 'required',
        ]);

        $product_image = $request->file('gambar');

        if($product_image != null){
            $gambar = $product_image->getClientOriginalName();
            $tujuan_upload = './assets/images';
            $product_image->move($tujuan_upload, $gambar);
            Homestay::where("id", $id)->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'harga' => $request->harga,
                'gambar' => $gambar,
                'rating' => 0
            ]);
        }

        Homestay::where("id", $id)->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'harga' => $request->harga,
            'rating' => 0
        ]);

        return redirect('/homestay');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Homestay  $homestay
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Homestay::find($id)->delete();

        return redirect('/homestay');
    }

    /**
     *
     *
     * @param  \App\Models\Homestay  $homestay
     * @return \Illuminate\Http\Response
     */
    public function foto(Request $request, $id)
    {

        dd($request);
        return redirect('/homestay');
    }
}
