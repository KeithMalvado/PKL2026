<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Forum;
use App\Models\ForumBalas;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ForumController extends Controller
{
    public function index(Request $request): View
    {
        $dtForum = Forum::with(['balasan.petugas'])
            ->when($request->sts, fn ($q) => $q->where('sts', $request->sts))
            ->when($request->q, fn ($q) => $q->where('judul', 'like', "%{$request->q}%"))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('panel.forum.index', [
            'dtForum' => $dtForum,
            'jumlahTunggu' => Forum::where('sts', 'tunggu')->count(),
        ]);
    }

    public function jawab(Request $request, Forum $forum): RedirectResponse
    {
        $data = $request->validate([
            'isi' => ['required', 'string', 'min:5', 'max:2000'],
        ], [], ['isi' => 'jawaban']);

        ForumBalas::create([
            'forum_id' => $forum->id,
            'pgn_id' => $request->user()->id,
            'isi' => $data['isi'],
        ]);

        $forum->update(['sts' => 'tampil']);

        return back()->with('sukses', 'Jawaban tersimpan dan pertanyaan ditampilkan di situs publik.');
    }

    public function tampil(Forum $forum): RedirectResponse
    {
        $forum->update(['sts' => 'tampil']);

        return back()->with('sukses', 'Pertanyaan ditampilkan di situs publik.');
    }

    public function hapus(Forum $forum): RedirectResponse
    {
        $forum->delete();

        return back()->with('sukses', 'Pertanyaan dihapus.');
    }
}
