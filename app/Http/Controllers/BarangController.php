<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use illuminate\Support\Facades\Redirect;
use illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('barang.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
          //$barang = Barang::all();
          $barang = DB::table('barang')
          ->join('kategori', 'barang.kode_kategori', '=', 'kategori.kode_kategori')
          ->select('barang.*', 'kategori.nama_kategori')
          ->get();
          return view('barang.index', compact('barang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
            $request->validate([
                'kode_barang' => 'required',
                'nama_barang' => 'required',
                'harga' => 'required',
                'stok' => 'required',
                'kode_kategori' => 'required',
            ]);
    
            $data = [
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $request->nama_barang,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'kode_kategori' => $request->kode_kategori,
            ];
    
            DB::table('barang')->insert($data);
    
            return redirect()->view('barang.index');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $barang = DB::table('barang')->where('id', $id)->first();
        return view('barang.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'kode_kategori' => 'required',
        ]);

        $data = [
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'kode_kategori' => $request->kode_kategori,
        ];

        DB::table('barang')->where('id', $id)->update($data);
        return redicet()->view('barang.index',);
        }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        Db::table('barang')->where('id', $id)->delete();
        return redirect()->route('barang.index');

    }
}


