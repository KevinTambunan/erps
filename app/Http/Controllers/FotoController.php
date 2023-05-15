<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use Illuminate\Http\Request;

class FotoController extends Controller
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
    public function store(Request $request, $id)
    {
        // dd($request);

        foreach($request->file('gambar') as $item){
            $gambar = $item->getClientOriginalName();
            $tujuan_upload = './assets/images';
            $item->move($tujuan_upload, $gambar);

            Foto::create([
                'homestay_id' => $id,
                'nama' => $gambar
            ]);
        }



        // $admin_id = User::find(Auth::user()->id)->admin->id;
        // Homestay::create([
        //     'pemilik_id' => $admin_id,
        //     'nama' => $request->nama,
        //     'alamat' => $request->alamat,
        //     'harga' => $request->harga,
        //     'gambar' => $gambar,
        //     'rating' => 0,
        //     'status' => "tersedia"
        // ]);

        return redirect('/homestay');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function show(Foto $foto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function edit(Foto $foto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Foto $foto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Foto $foto)
    {
        //
    }
}
