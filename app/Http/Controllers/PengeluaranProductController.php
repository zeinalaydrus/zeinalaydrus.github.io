<?php

namespace App\Http\Controllers;

use App\Models\PengeluaranProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class PengeluaranProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::with('pengeluaranproducts')->get();
        return view('PengeluaranProduct.keluar', compact('data'));
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
            'product_id' => 'required',
            'stock' => 'required',
            'tanggal_keluar' => 'required',
            'bukti' => 'required|file',
            'description' => 'required',
        ]);

        $keluar = new PengeluaranProduct();
        $keluar->product_id = $request->product_id;
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

        $update = Product::where('id',$request->product_id)->first();
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
     * @param  \App\Models\PengeluaranProduct  $pengeluaranproduct
     * @return \Illuminate\Http\Response
     */
    public function show(PengeluaranProduct $pengeluaranproduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PengeluaranProduct  $pengeluaranproduct
     * @return \Illuminate\Http\Response
     */
    public function edit(PengeluaranProduct $pengeluaranproduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PengeluaranProduct  $pengeluaranproduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PengeluaranProduct $pengeluaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PengeluaranProduct  $pengeluaranproduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(PengeluaranProduct $pengeluaranproduct)
    {
        //
    }
}
