<?php

namespace App\Http\Controllers;

use App\Models\ErpRecomendation;
use App\Models\Modul;
use Illuminate\Http\Request;

class ErpRecomendationController extends Controller
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
        // dd($request->keys());
        $result = [];
        $i = 0;

        $moduls = Modul::all();
        foreach ($request->keys() as $item) {
            foreach ($moduls as $modul) {
                if ("modul" . $modul->name == str_replace("_", " ", $item)) {
                    $i++;
                }
            }
            
        }

        echo ($i);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ErpRecomendation  $erpRecomendation
     * @return \Illuminate\Http\Response
     */
    public function show(ErpRecomendation $erpRecomendation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ErpRecomendation  $erpRecomendation
     * @return \Illuminate\Http\Response
     */
    public function edit(ErpRecomendation $erpRecomendation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ErpRecomendation  $erpRecomendation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ErpRecomendation $erpRecomendation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ErpRecomendation  $erpRecomendation
     * @return \Illuminate\Http\Response
     */
    public function destroy(ErpRecomendation $erpRecomendation)
    {
        //
    }
}
