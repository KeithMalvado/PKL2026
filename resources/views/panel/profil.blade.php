@extends('panel.layout')

@section('judul', 'Profil Saya')

@section('konten')
    <div class="grid gap-6 lg:grid-cols-2">
        {{-- data diri --}}
        <div class="rounded-2xl border border-hijau-100 bg-white p-6 shadow-sm" data-reveal>
            <h3 class="mb-1 font-bold text-slate-800">Data Diri</h3>
            <p class="mb-5 text-sm text-slate-500">Perbarui informasi akun Anda.</p>

            @if ($errors->any() && old('_form') === 'diri')
                <div class="mb-4 rounded-xl border border-red-200 bg-red-50 p-3 text-sm text-red-700">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('panel.profil.perbarui') }}" class="space-y-4">
                @csrf
                @method('PUT')
                <input type="hidden" name="_form" value="diri">
                <div>
                    <label class="mb-1 block text-sm font-medium text-slate-700">Nama</label>
                    <input type="text" name="name" value="{{ old('name', $pgn->name) }}" required class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-slate-700">Email</label>
                    <input type="email" name="email" value="{{ old('email', $pgn->email) }}" required class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-slate-700">No. Telepon</label>
                    <input type="text" name="no_telp" value="{{ old('no_telp', $pgn->no_telp) }}" class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                </div>
                <div class="rounded-xl bg-hijau-50 px-4 py-3 text-sm">
                    <span class="text-slate-500">Jabatan:</span> <span class="font-semibold text-hijau-700">{{ $pgn->jbt ?? '-' }}</span>
                </div>
                <button class="rounded-xl bg-hijau-600 px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-hijau-700">Simpan Perubahan</button>
            </form>
        </div>

        {{-- ubah sandi --}}
        <div class="rounded-2xl border border-hijau-100 bg-white p-6 shadow-sm" data-reveal data-delay="1">
            <h3 class="mb-1 font-bold text-slate-800">Ubah Kata Sandi</h3>
            <p class="mb-5 text-sm text-slate-500">Gunakan kata sandi yang kuat demi keamanan.</p>

            @if ($errors->any() && old('_form') === 'sandi')
                <div class="mb-4 rounded-xl border border-red-200 bg-red-50 p-3 text-sm text-red-700">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('panel.profil.sandi') }}" class="space-y-4">
                @csrf
                @method('PUT')
                <input type="hidden" name="_form" value="sandi">
                <div>
                    <label class="mb-1 block text-sm font-medium text-slate-700">Kata Sandi Lama</label>
                    <input type="password" name="sandi_lama" required class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-slate-700">Kata Sandi Baru</label>
                    <input type="password" name="sandi_baru" required class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-slate-700">Konfirmasi Kata Sandi Baru</label>
                    <input type="password" name="sandi_baru_confirmation" required class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                </div>
                <button class="rounded-xl bg-hijau-600 px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-hijau-700">Ubah Kata Sandi</button>
            </form>
        </div>
    </div>
@endsection
