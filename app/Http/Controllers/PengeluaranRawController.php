<?php

namespace App\Http\Controllers;

use App\Models\Raw;
use App\Models\Pengeluaran;
use App\Models\PengeluaranRaw;
use Illuminate\Http\Request;

class PengeluaranRawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Raw::with('pengeluaranraws')->get();
        return view('PengeluaranRaw.keluar', compact('data'));
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
        $validateData = $request->validate([
            'raw_id' => 'required',
            'stock' => 'required',
            'tanggal_keluar' => 'required',
            'bukti' => 'required|file',
            'description' => 'required',
        ]);

        $keluar = new PengeluaranRaw();
        $keluar->raw_id = $request->raw_id;
        $keluar->stock = $request->stock;
        $keluar->tanggal_keluar = $request->tanggal_keluar;
        $keluar->description = $request->description;

        if($request->bukti){

            $img = $request->file('bukti');
            $filename = $img->getClientOriginalName();
            if ($request->hasFile('bukti')) {
                $request->file('bukti')->storeAs('/bukti',$filename);
            }
            $keluar->bukti = $request->file('bukti')->getClientOriginalName();

        }

        $update = Raw::where('id',$request->raw_id)->first();
        // if($update->stock == 0) {
        //     return redirect()->back();
        // }
        $update->update([
            'stock' =>   $update->stock - $request->stock
        ]);

        $keluar->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PengeluaranRaw  $pengeluaranraw
     * @return \Illuminate\Http\Response
     */
    public function show(PengeluaranRaw $pengeluaranraw)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PengeluaranRaw  $pengeluaranraw
     * @return \Illuminate\Http\Response
     */
    public function edit(PengeluaranRaw $pengeluaranraw)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PengeluaranRaw  $pengeluaranraw
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PengeluaranRaw $pengeluaranraw)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PengeluaranRaw  $pengeluaranraw
     * @return \Illuminate\Http\Response
     */
    public function destroy(PengeluaranRaw $pengeluaranraw)
    {
        //
    }
}
