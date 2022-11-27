<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\produk;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = produk::all();
        
        $response = [
            'message' => 'Haii Selamat datang di toko kami, Mau cari apa hari ini?',
            'list barang' => $produk
        ];
        
        return $response;
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
        $tables = produk::create([
            "nama_produk" => $request->nama_produk,
            "deskripsi_produk" => $request->deskripsi_produk,
            "kategori" => $request->kategori,
            "jumlah" => $request->jumlah,
            "harga" => $request->harga,
        ]);

        return response()->json([
            'message' => 'Data telah ditambahkan',
            'list barang' =>$tables,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tables = produk::find($id);
        if ($tables) {
            return response()->json([
                'message' => 'Kami menemukan produk ini berdasar pencarianmu',
                'list barang' => $tables
            ]);
        } else {
            return response()->json([
                'message' => 'Yahh, sayang sekali bestie produk nya tidak bisa kami temukan :(. Coba cek lagi nama produk kamu yahh bestiee',
                'status' => 404,
            ], 404);
        };
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
        $tables = produk::find($id);
        if($tables){
            $tables->nama_produk = $request->nama_produk ? $request->nama_produk : $request->nama_produk;
            $tables->deskripsi_produk = $request->deskripsi_produk ? $request->deskripsi_produk : $request->deskripsi_produk;
            $tables->kategori = $request->kategori ? $request->kategori : $request->kategori;
            $tables->jumlah = $request->jumlah ? $request->jumlah : $request->jumlah;
            $tables->harga =  $request->harga ? $request->harga : $request->harga;
            $tables->save();
            
            return response()->json([
                'message' => 'Produk berhasil di update nih min',
                'produk' => $tables
            ]);
        } else {
            return response()->json([
                'status' => 'Data gabisa ke update min :(',
                'message' => $id . 'Yang mimin cari ga ada'
            ]);
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tables = produk::where('id',$id)->first();
        if($tables){
            $tables->delete();
                return response()->json([
                    'produk' => $tables,
                    'message' => 'Produk berhasil dihapus min!'
                ]);
        } else { 
            return response()->json([
                'status' => 'Produk tidak terhapus',
                'message' => 'Produk gabisa dihapus min, id' . $id . 'yang kamu cari tidakk ketemuu'
            ]);
        };
    }
}
