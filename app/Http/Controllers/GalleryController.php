<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Post::with('buku')
            ->whereNotNull('picture')
            ->where('picture', '!=', '')
            ->orderBy('created_at', 'desc')
            ->paginate(30);

        return view('gallery.index', compact('galleries'));
    }

    public function create()
    {
        $bukus = Buku::orderBy('judul')->get();

        return view('gallery.create', compact('bukus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|max:200',
            'description' => 'required',
            'id_buku'     => 'nullable|exists:buku,id',
            'picture'     => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $extension = $request->file('picture')->getClientOriginalExtension();
        $filenameSimpan = uniqid() . time() . '.' . $extension;
        $request->file('picture')->storeAs('posts_images', $filenameSimpan, 'public');

        $post = new Post();
        $post->id_buku = $request->input('id_buku');
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->picture = $filenameSimpan;
        $post->save();

        return redirect()->route('gallery.index')
            ->with('success', 'Berhasil menambahkan gambar baru.');
    }

    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        $bukus = Buku::orderBy('judul')->get();

        return view('gallery.edit', compact('post', 'bukus'));
    }

    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title'       => 'required|max:200',
            'description' => 'required',
            'id_buku'     => 'nullable|exists:buku,id',
            'picture'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('picture')) {
            // Hapus file lama, lalu simpan yang baru
            if ($post->picture) {
                Storage::disk('public')->delete('posts_images/' . $post->picture);
            }
            $extension = $request->file('picture')->getClientOriginalExtension();
            $filenameSimpan = uniqid() . time() . '.' . $extension;
            $request->file('picture')->storeAs('posts_images', $filenameSimpan, 'public');
            $post->picture = $filenameSimpan;
        }

        $post->id_buku = $request->input('id_buku');
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->save();

        return redirect()->route('gallery.index')
            ->with('success', 'Berhasil memperbarui gambar.');
    }

    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        if ($post->picture) {
            Storage::disk('public')->delete('posts_images/' . $post->picture);
        }
        $post->delete();

        return redirect()->route('gallery.index')
            ->with('success', 'Gambar berhasil dihapus.');
    }
}