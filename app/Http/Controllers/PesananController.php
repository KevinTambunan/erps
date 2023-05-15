<?php

namespace App\Http\Controllers;

use App\Models\Homestay;
use App\Models\Pemesan;
use App\Models\Pesanan;
use App\Models\Ulasan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{

    public function ulasan(Request $request){
        $validate = $request->validate([
            'pemesan_id' => 'required',
            'homestay_id' => 'required',
            'ulasan' => 'required',
            'rate' => 'required'
        ]);

        Ulasan::create($validate);

        return redirect('/pesanan_user');
    }
    public function konfirmasiPembayaran($id){
        Pesanan::where('id', $id)->update([
            'status' => 'dikonfirmasi'
        ]);

        return redirect('/pesanan');
    }
    public function pesananDetail($id){

        $pesanan = Pesanan::find($id);
        $ulasans = $pesanan->homestay->ulasan;
        // dd($pesanan->homestay->nama);
        return view('user.pesanan_detail', compact(['pesanan', 'ulasans']));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * display of pesanan
     *
     * @return \Illuminate\Http\Response
     */
    public function pesananUser()
    {
        // $homestays = Homestay::all();
        // $pesanans =  Pesanan::all();
        $pesanans =  Pemesan::find(Auth::user()->id)->pesanan;
        if($pesanans == null){
            $pesanan = [];
        }

        // $banks = Homestay::find(3)->pemilik->bank;
        return view('user.pesanan', compact(['pesanans']));
        //
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUser()
    {
        $pemesan_id = User::find(Auth::user()->id)->pemesan->id;

        $pesanans = Pemesan::find($pemesan_id)->pesanan;


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'tanggal_mulai' =>  'required',
            'tanggal_berakhir' => 'required'
        ]);
        $start = \Carbon\Carbon::parse($request->tanggal_mulai);

        // Tanggal akhir
        $end = \Carbon\Carbon::parse($request->tanggal_berakhir);

        // Menghitung selisih hari
        $diffInDays = $start->diffInDays($end);
        $total_harga = Homestay::find($id)->harga * $diffInDays;

        $pemesan_id = User::find(Auth::user()->id)->pemesan->id;

        Pesanan::create([
            'pemesan_id' => $pemesan_id,
            'homestay_id' => $id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_berakhir' => $request->tanggal_berakhir,
            'total_harga' => $total_harga,
            'status' => 'menunggu pembayaran'
        ]);

        return redirect('/pesanan_user');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function show(Pesanan $pesanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pesanan $pesanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pesanan $pesanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pesanan $pesanan)
    {
        //
    }
}
