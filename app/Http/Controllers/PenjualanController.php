<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $penjualans = Penjualan::with(['barang', 'user'])->paginate(10);
        return view('penjualan.index', compact('penjualans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $barangs = Barang::all();
        return view('penjualan.create', compact('barangs'));
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

        $request->validate([
            'id_barang' => 'required|exists:barangs,id',
            'jumlah'   => 'required|integer|min:1'
        ]);

        $barangs = Barang::findOrFail($request->id_barang);

        if ($barangs->stok < $request->jumlah) {
            return redirect()->back()->with(['error' => 'stok tidak mencukupi']);
        }

        $barangs->decrement('stok', $request->jumlah);

        Penjualan::create([
            'id_user' => auth()->id(),
            'id_barang' => $request->id_barang,
            'jumlah' => $request->jumlah,
        ]);

        return redirect()->route('penjualan.index')->with(['success' => 'Data Berhasil dicatat']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $penjualan = Penjualan::with(['barang', 'user'])->findOrFail($id);
        return view('penjualan.show', compact('penjualan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}