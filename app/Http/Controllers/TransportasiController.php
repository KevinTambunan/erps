<?php

namespace App\Http\Controllers;

use App\Models\Transportasi;
use Illuminate\Http\Request;

class TransportasiController extends Controller
{
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
        $product_image = $request->file('foto');
        $gambar = $product_image->getClientOriginalName();
        $tujuan_upload = './assets/images';
        $product_image->move($tujuan_upload, $gambar);

        $validate = $request->validate([
            'homestay_id' => 'required',
            'nama_supir' => 'required',
            'nama_transportasi' => 'required',
            'harga' => 'required',
        ]);

        Transportasi::create([
            'homestay_id' => $request->homestay_id,
            'nama_supir' => $request->nama_supir,
            'nama_transportasi' => $request->nama_transportasi,
            'harga' => $request->harga,
            'foto' => $gambar,
        ]);

        return redirect('/homestay');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transportasi  $transportasi
     * @return \Illuminate\Http\Response
     */
    public function show(Transportasi $transportasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transportasi  $transportasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transportasi $transportasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transportasi  $transportasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transportasi $transportasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transportasi  $transportasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transportasi $transportasi)
    {
        //
    }
}
