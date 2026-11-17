
@extends('panel.layout')

@section('judul', $isEdit ? 'Edit Agenda' : 'Tambah Agenda')

@section('konten')
<div class="mx-auto max-w-4xl space-y-6">

    <div>
        <a href="{{ route('panel.agenda.index') }}"
           class="text-sm font-semibold text-hijau-700 hover:underline">
            ← Kembali ke Agenda Bulanan
        </a>

        <h2 class="mt-4 text-2xl font-extrabold text-ink-900">
            {{ $isEdit ? 'Edit Agenda Kegiatan' : 'Tambah Agenda Kegiatan' }}
        </h2>

        <p class="mt-2 text-sm text-ink-500">
            Lengkapi informasi kegiatan sesuai agenda resmi DKPPP.
            Agenda yang dipublikasikan dapat dilihat oleh masyarakat.
        </p>
    </div>

    <form method="POST"
          action="{{ $isEdit
              ? route('panel.agenda.perbarui', $agenda)
              : route('panel.agenda.simpan') }}"
          class="space-y-6 rounded-2xl border border-hijau-100 bg-white p-6 shadow-sm">

        @csrf

        @if ($isEdit)
            @method('PUT')
        @endif

        @if ($errors->any())
            <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                Ada data yang belum sesuai. Periksa kembali kolom yang ditandai.
            </div>
        @endif

        {{-- Bidang --}}
        @if (auth()->user()->isAdmin())
            <div>
                <label for="bdg_id"
                       class="mb-2 block text-sm font-semibold text-ink-700">
                    Bidang Penyelenggara *
                </label>

                <select name="bdg_id"
                        id="bdg_id"
                        required
                        class="w-full rounded-xl border border-hijau-200 px-4 py-3 text-sm">
                    <option value="">Pilih Bidang</option>

                    @foreach ($bidangs as $bidang)
                        <option value="{{ $bidang->id }}"
                            @selected((string) old('bdg_id', $agenda->bdg_id) === (string) $bidang->id)>
                            {{ $bidang->nama ?? $bidang->nm_bdg ?? $bidang->slug ?? 'Bidang '.$bidang->id }}
                        </option>
                    @endforeach
                </select>

                @error('bdg_id')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        @else
            <div class="rounded-xl border border-hijau-100 bg-hijau-50 px-4 py-3">
                <p class="text-xs font-semibold uppercase text-ink-500">
                    Bidang Penyelenggara
                </p>
                <p class="mt-1 font-bold text-hijau-800">
                    {{ auth()->user()->bdg?->nama
                        ?? auth()->user()->bdg?->nm_bdg
                        ?? auth()->user()->bdg?->slug
                        ?? 'Bidang belum tersedia' }}
                </p>
                <p class="mt-1 text-xs text-ink-500">
                    Bidang ditentukan otomatis dari akun yang login.
                </p>
            </div>
        @endif

        {{-- Judul --}}
        <div>
            <label for="judul"
                   class="mb-2 block text-sm font-semibold text-ink-700">
                Judul Kegiatan *
            </label>

            <input type="text"
                   name="judul"
                   id="judul"
                   maxlength="200"
                   required
                   value="{{ old('judul', $agenda->judul) }}"
                   placeholder="Contoh: Gerakan Pangan Murah"
                   class="w-full rounded-xl border border-hijau-200 px-4 py-3 text-sm focus:border-hijau-500">

            @error('judul')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Uraian --}}
        <div>
            <label for="uraian"
                   class="mb-2 block text-sm font-semibold text-ink-700">
                Uraian Kegiatan *
            </label>

            <textarea name="uraian"
                      id="uraian"
                      rows="5"
                      maxlength="5000"
                      required
                      placeholder="Jelaskan secara singkat kegiatan yang akan dilaksanakan..."
                      class="w-full rounded-xl border border-hijau-200 px-4 py-3 text-sm focus:border-hijau-500">{{ old('uraian', $agenda->uraian) }}</textarea>

            @error('uraian')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tanggal dan waktu --}}
        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="tanggal"
                       class="mb-2 block text-sm font-semibold text-ink-700">
                    Tanggal Kegiatan *
                </label>

                <input type="date"
                       name="tanggal"
                       id="tanggal"
                       required
                       value="{{ old('tanggal', $agenda->tanggal?->format('Y-m-d')) }}"
                       class="w-full rounded-xl border border-hijau-200 px-4 py-3 text-sm">

                @error('tanggal')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="waktu_mulai"
                       class="mb-2 block text-sm font-semibold text-ink-700">
                    Jam Mulai (WIB) *
                </label>

                <input type="time"
                       name="waktu_mulai"
                       id="waktu_mulai"
                       required
                       value="{{ old('waktu_mulai', $agenda->waktu_mulai ? substr($agenda->waktu_mulai, 0, 5) : '') }}"
                       class="w-full rounded-xl border border-hijau-200 px-4 py-3 text-sm">

                @error('waktu_mulai')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="waktu_selesai"
                       class="mb-2 block text-sm font-semibold text-ink-700">
                    Jam Selesai (Opsional)
                </label>

                <input type="time"
                       name="waktu_selesai"
                       id="waktu_selesai"
                       value="{{ old('waktu_selesai', $agenda->waktu_selesai ? substr($agenda->waktu_selesai, 0, 5) : '') }}"
                       class="w-full rounded-xl border border-hijau-200 px-4 py-3 text-sm">

                @error('waktu_selesai')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="keterangan_waktu"
                       class="mb-2 block text-sm font-semibold text-ink-700">
                    Keterangan Waktu (Opsional)
                </label>

                <input type="text"
                       name="keterangan_waktu"
                       id="keterangan_waktu"
                       maxlength="100"
                       value="{{ old('keterangan_waktu', $agenda->keterangan_waktu) }}"
                       placeholder="Contoh: s/d selesai"
                       class="w-full rounded-xl border border-hijau-200 px-4 py-3 text-sm">

                @error('keterangan_waktu')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Lokasi --}}
        <div>
            <label for="lokasi"
                   class="mb-2 block text-sm font-semibold text-ink-700">
                Lokasi Kegiatan *
            </label>

            <input type="text"
                   name="lokasi"
                   id="lokasi"
                   maxlength="255"
                   required
                   value="{{ old('lokasi', $agenda->lokasi) }}"
                   placeholder="Contoh: Desa Karangduren, Kecamatan Balung"
                   class="w-full rounded-xl border border-hijau-200 px-4 py-3 text-sm">

            @error('lokasi')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol --}}
        <div class="flex flex-wrap justify-end gap-3 border-t border-hijau-100 pt-5">
            <a href="{{ route('panel.agenda.index') }}"
               class="rounded-xl border border-hijau-200 px-5 py-3 text-sm font-semibold text-ink-600 hover:bg-hijau-50">
                Batal
            </a>

            <button type="submit"
                    class="rounded-xl bg-hijau-700 px-6 py-3 text-sm font-bold text-white transition hover:bg-hijau-800">
                {{ $isEdit ? 'Simpan Perubahan' : 'Publikasikan Agenda' }}
            </button>
        </div>
    </form>
</div>
@endsection
