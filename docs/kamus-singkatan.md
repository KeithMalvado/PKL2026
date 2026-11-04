# Kamus Singkatan Kode — DKPP Jember

Dokumen ini adalah **acuan wajib** penamaan singkatan di seluruh kode (variabel,
fungsi, nama tabel, kolom, route, dsb). Tujuannya agar singkatan selalu
**konsisten** dan tim tidak bingung. Jika butuh singkatan baru, tambahkan di sini
dulu sebelum dipakai.

## Aturan Umum
- Singkatan memakai huruf kecil (camelCase bila gabungan, mis. `$dtPgdn`).
- Hilangkan vokal bila masih jelas (mis. pengaduan -> `pgdn`).
- Jangan menyingkat kata yang sudah pendek (mis. `role`, `foto`, `user`).
- Nama tabel/kolom database tetap pakai singkatan yang sama (konsisten).

## Daftar Singkatan Baku

| Kata Lengkap            | Singkatan | Contoh Pemakaian            |
|-------------------------|-----------|-----------------------------|
| pengaduan               | pgdn      | `$dtPgdn`, tabel `pgdn`     |
| tiket                   | tkt       | `$kdTkt`, `generateKdTkt()`|
| pengguna / user         | pgn       | `$dtPgn`                    |
| bidang                  | bdg       | `$dtBdg`                    |
| berita                  | brt       | `$dtBrt`                    |
| galeri                  | glr       | `$dtGlr`                    |
| disposisi               | dsps      | `$dtDsps`                   |
| status                  | sts       | `$stsTkt`                   |
| kode                    | kd        | `$kdTkt`                    |
| data                    | dt        | `$dtPgdn`                   |
| tanggal                 | tgl       | `$tglLapor`                 |
| laporan                 | lpr       | `$dtLpr`                    |
| lampiran / bukti        | bkt       | `$fileBkt`                  |
| kegiatan                | kgt       | `$dtKgt`                    |
| dokumen                 | dok       | `$dtDok`                    |
| kategori                | kat       | `$dtKat`                    |
| keterangan              | ket       | `$ket`                      |
| nomor                   | no        | `$noTelp`                   |
| telepon                 | telp      | `$noTelp`                   |
| alamat                  | almt      | `$almt`                     |
| jabatan                 | jbt       | `$jbt`                      |
| struktur organisasi     | strukOrg  | `$dtStrukOrg`               |
| sambutan                | smbt      | `$dtSmbt`                   |
| sejarah                 | sjrh      | `$dtSjrh`                   |
| sekretariat             | sekr      | `$dtSekr`                   |
| peternakan              | ternak    | (tidak disingkat)           |
| perikanan               | ikan      | (tidak disingkat)           |
| ketahanan pangan        | pangan    | (tidak disingkat)           |
| kesehatan hewan         | keswan    | `$dtKeswan`                 |
| masyarakat veteriner    | kesmavet  | `$dtKesmavet`               |
| Laporan Hasil Tindak Lanjut | lhtl  | `$fileLhtl`                 |
| Survei Kepuasan Masyarakat  | skm   | `$dtSkm`                    |
| Service Level Agreement | sla       | `$batasSla`                 |
| verifikasi              | verif     | `verifPgdn()`               |
| forum konsultasi        | forum     | `$dtForum`                  |
| artikel                 | art       | `$dtArt`                    |
| jurnal                  | jrn       | `$dtJrn`                    |
| inovasi                 | inov      | `$dtInov`                   |
| produk hukum            | prodHkm   | `$dtProdHkm`                |
| video                   | vid       | `$dtVid`                    |

## Role Petugas (nilai kolom `role` pada tabel pgn)
| Role            | Nilai disimpan |
|-----------------|----------------|
| Admin / PPID    | `admin`        |
| Kepala Dinas    | `kadis`        |
| Kepala Bidang   | `kabid`        |
| Tim Teknis      | `teknis`       |

## Status Tiket Pengaduan (kolom `sts` pada tabel `pgdn`)
| Status                    | Nilai disimpan |
|---------------------------|----------------|
| Baru masuk                | `baru`         |
| Terverifikasi             | `verif`        |
| Ditolak                   | `tolak`        |
| Didisposisi ke bidang     | `dsps`         |
| Sedang ditindaklanjuti    | `proses`       |
| Selesai                   | `selesai`      |
