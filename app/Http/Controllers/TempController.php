<?php

namespace App\Http\Controllers;

use App\Temp;
use Illuminate\Http\Request;

class TempController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suratmasuk = Temp::orderBy('id', 'DESC')->get();
        return view('staff.suratmasuk.suratmasuk', [
            "title" => "Kelola Surat Masuk",
        ], compact('suratmasuk'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Temp  $temp
     * @return \Illuminate\Http\Response
     */
    public function show(Temp $temp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Temp  $temp
     * @return \Illuminate\Http\Response
     */
    public function edit(Temp $temp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Temp  $temp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Temp $temp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Temp  $temp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Temp $temp)
    {
        //
    }
}
