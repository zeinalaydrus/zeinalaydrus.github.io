<?php

namespace App\Http\Controllers;

use App\Models\Raw;
use App\Models\PemasukanRaw;
use Illuminate\Http\Request;

class PemasukanRawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Raw::with('pemasukanraws')->get();
        return view('PemasukanRaw.masuk', compact('data'));
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
            'tanggal_masuk' => 'required',
            'bukti' => 'required|file',
            'description' => 'required',
        ]);

        $masuk = new PemasukanRaw();
        $masuk->raw_id = $request->raw_id;
        $masuk->stock = $request->stock;
        $masuk->tanggal_masuk = $request->tanggal_masuk;
        $masuk->description = $request->description;

        if ($request->bukti) {

            $img = $request->file('bukti');
            $filename = $img->getClientOriginalName();
            if ($request->hasFile('bukti')) {
                $request->file('bukti')->storeAs('/bukti', $filename);
            }
            $masuk->bukti = $request->file('bukti')->getClientOriginalName();
        }
        
        $update = Raw::where('id',$request->raw_id)->first();
        $update->update([
            'stock' =>   $update->stock + $request->stock
        ]);
        
        $masuk->save();


        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PemasukanRaw  $pemasukanraw
     * @return \Illuminate\Http\Response
     */
    public function show(PemasukanRaw $pemasukanraw)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PemasukanRaw  $pemasukanraw
     * @return \Illuminate\Http\Response
     */
    public function edit(PemasukanRaw $pemasukanraw)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PemasukanRaw  $pemasukanraw
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PemasukanRaw $pemasukanraw)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PemasukanRaw  $pemasukanraw
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = PemasukanRaw::find($id);
        $delete->delete();

        return redirect()->back();
    }
}
