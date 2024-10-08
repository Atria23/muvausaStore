<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TransactionController extends Controller
{
    // Menampilkan form transaksi
    public function create()
    {
        return view('transactions.create'); // Pastikan untuk membuat view ini
    }

    // Proses transaksi
    public function makeTransaction(Request $request)
    {
        $username = env('P_U');
        $apiKey = env('P_AK');
        $ref_id = uniqid(); // Membuat ref_id unik untuk setiap transaksi
        $buyer_sku_code = $request->input('buyer_sku_code');
        $customer_no = $request->input('customer_no');
        $sign = md5($username . $apiKey . $ref_id); // Membuat signature
        
        // Data request untuk API
        $data = [
            'username' => $username,
            'buyer_sku_code' => $buyer_sku_code,
            'customer_no' => $customer_no,
            'ref_id' => $ref_id,
            'sign' => $sign,
            'testing' => $request->input('testing', false), // optional
            'max_price' => $request->input('max_price', null), // optional
            'cb_url' => $request->input('cb_url', null), // optional
            'allow_dot' => $request->input('allow_dot', false), // optional
        ];

        // Kirim permintaan POST ke endpoint Digiflazz API
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://api.digiflazz.com/v1/transaction', $data);

        // Cek apakah respon dari API berhasil
        if ($response->successful()) {
            return response()->json($response->json(), 200);
        } else {
            return response()->json([
                'message' => 'Gagal melakukan transaksi',
                'error' => $response->json(),
            ], $response->status());
        }
    }
}
