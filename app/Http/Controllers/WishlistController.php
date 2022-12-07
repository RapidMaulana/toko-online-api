<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\wishlist;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'message' => 'Ini wishlist kamu, semangat nabung yaa',
            'list wishlist' => wishlist::all()
        ]);
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
        $wish = wishlist::create([
            "nama_barang" => $request->nama_barang,
            "harga" => $request->harga
        ]);

        return response()->json([
            "message" =>"wishlist telah ditambahkan",
            "wishlisted" => $wish
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
        if (wishlist::find($id)) {
            return response()->json([
                'message' => 'Kami menemukan wishlist ini berdasar pencarianmu',
                'wishlisted' => wishlist::find($id)
            ]);
        } else {
            return response()->json([
                'message' => 'Hmmm, kayanya kamu belum nge wishlist produk ini deh, coba cek id kamu lagi bestie.',
                'status' => 404,
            ], 404);
        }
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
        $wish = wishlist::find($id);
        if($wish) {
            $wish->nama_barang = $request->nama_barang ? $request->nama_barang : $request->nama_barang;
            $wish->harga = $request->harga ? $request->harga : $request->harga;
            $wish->save();

            return response()->json([
                'message' => 'data telah ter update',
                'wishlist' => $wish
            ]);
        } else {
            return response()->json([
                'status' => 'Data tida berhasil di update nih bestie :(',
                'message' => 'coba cek lagi id yang mau di update'
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
        $tables = wishlist::where('id',$id)->first();
        if($tables){
            $tables->delete();
                return response()->json([
                    'wishlist' => $tables,
                    'message' => 'Produk berhasil dihapus min!'
                ]);
        } else { 
            return response()->json([
                'status' => 'Wishlist tidak terhapus',
                'message' => 'Wishlist gabisa dihapus min, id ' . $id . ' yang kamu cari tidakk ketemuu'
            ]);
        };
    }
}
