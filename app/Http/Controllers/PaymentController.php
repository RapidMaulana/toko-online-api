<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\produk;
use App\Models\payment;

class PaymentController extends Controller
{
    public function getPayments()
    {
        $pay = payment::all();

        if($pay) {
            return response()->json([
                $pay
            ]);
        } else {
            return response()->json([
                'message' => 'Belum ada data transaksi, yuk belanja lagi'
            ]);
        }
    }

    public function postPayments(Request $request)
    {
        $pay = payment::create([
            "nama_pembeli" => $request->nama_pembeli,
            "nama_produk" => $request->nama_produk,
            "jumlah" => $request->jumlah,
            "harga" => $request->harga,
            "total" => $request->harga * $request->jumlah,
            "bayar" => $request->bayar
        ]);
        if ( $request->bayar == $request->total ) {
            return response()->json([
                "message" => "yah sayang sekali duit kamu kurang"
            ]);
        } else {
            return response()->json([
                "list pemesanan" => $pay
            ]);
        }
    }
    public function showPayments($id) {
        $pay = payment::find($id);
        if($pay) {
            return response()->json([
                'message' => 'riwayat pembelian',
                'list' => $pay
            ]);
        } else {
            return response()->json([
                'message' => 'id ' . $id . ' tidak ditemukan'
            ]);
        }
    }
    public function deletePayments($id) {
        $pay = payment::find($id);
        if($pay) {
            $pay->delete();
            return response()->json([
                'produk' => $pay,
                'status' => 'data telah terhapus'
            ]);
        } else {
            return response()->json([
                'status' => 'data tidak terhapus',
                'message' => 'id ' . $id . ' data tidak dapat terhapus'
            ]);
        };
    }
}
