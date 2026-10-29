<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\buku;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        // Data seluruh buku dari praktikum sebelumnya
        $data_buku = Buku::paginate(5);

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

    //fungsi tambah buku
    public function create()
    {
        return view('create');
    }

    //function simpan buku
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date',
        ]);
        $buku = new Buku();
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;

        $buku->save();


        return redirect('/buku')->with('success', 'Buku berhasil ditambahkan!');
    }
    //fungsi edit buku
    public function edit($id)
    {
        $buku = Buku::find($id);

        return view('edit', compact('buku'));
    }
    public function update(Request $request, $id)
    {
        $buku = Buku::find($id);

        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date',
        ]);

        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;

        $buku->save();

        return redirect('/buku')->with('success', 'Buku berhasil diperbarui!');
    }
    public function destroy($id)
    {
        $buku = Buku::find($id);

        $buku->delete();

        return redirect('/buku')->with('success', 'Buku berhasil dihapus!');
    }
    public function search(Request $request)
    {
       $batas = 5;
        $cari = $request->cari;

        $data_buku = Buku::where('judul', 'like', "%$cari%")
            ->orWhere('penulis', 'like', "%$cari%")
            ->paginate($batas);

        $jumlah_buku = $data_buku->total();

        $no = $batas * ($data_buku->currentPage() - 1);

        return view('search', compact(
            'jumlah_buku',
            'data_buku',
            'no',
            'cari'
        ));
    }
}
