<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\buku;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        // Data seluruh buku dari praktikum sebelumnya
        $data_buku = Buku::all();

        // Tugas 2: mengambil 5 buku terbaru
        $bukuTerbaru = Buku::orderByDesc('created_at')
            ->take(5)
            ->get();

        // Tugas 3: filter berdasarkan penulis
        $nama_penulis = $request->query('penulis');

        if ($nama_penulis) {
            $bukuFilter = Buku::where('penulis', $nama_penulis)->get();
        } else {
            $bukuFilter = Buku::all();
        }

        // Tugas 4: statistik harga
        $statistik = [
            'total_buku' => Buku::count(),
            'total_harga' => Buku::sum('harga'),
            'harga_tertinggi' => Buku::max('harga'),
            'harga_terendah' => Buku::min('harga'),
        ];

        // Tugas 5: pencarian berdasarkan judul
        $keyword = $request->query('keyword');

        if ($keyword) {
            $hasilPencarian = Buku::where(
                'judul',
                'like',
                '%' . $keyword . '%'
            )->get();
        } else {
            $hasilPencarian = collect();
        }

        // Tugas tambahan 1
        $jumlahBuku = Buku::count();
        $totalHarga = Buku::sum('harga');

        return view('index', compact(
            'data_buku',
            'bukuTerbaru',
            'bukuFilter',
            'statistik',
            'hasilPencarian',
            'nama_penulis',
            'keyword',
            'jumlahBuku',
            'totalHarga'
        ));



        // return view('buku.index', compact(
        //     'data_buku',
        //     'bukuTerbaru',
        //     'bukuFilter',
        //     'nama_penulis',
        //     'daftarPenulis',
        //     'jumlahBuku',
        //     'totalHarga'
        // ));



    }
}
