<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Pemasukan;
use App\Models\PemasukanProduct;
use Illuminate\Http\Request;

class PemasukanProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::with('pemasukanproducts')->get();
        return view('PemasukanProduct.masuk', compact('data'));
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
            'tanggal_masuk' => 'required',
            'bukti' => 'required|file',
            'description' => 'required',
        ]);

        $masuk = new PemasukanProduct();
        $masuk->product_id = $request->product_id;
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
        
        $update = Product::where('id',$request->product_id)->first();
        $update->update([
            'stock' =>   $update->stock + $request->stock
        ]);
        $masuk->save();


        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pemasukan  $pemasukanproduct
     * @return \Illuminate\Http\Response
     */
    public function show(PemasukanProduct $pemasukanproduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pemasukan  $pemasukanproduct
     * @return \Illuminate\Http\Response
     */
    public function edit(PemasukanProduct $pemasukanproduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PemasukanProduct  $pemasukanproduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PemasukanProduct $pemasukanproduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pemasukan  $pemasukanproduct
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = PemasukanProduct::find($id);
        $delete->delete();

        return redirect()->back();
    }
}
