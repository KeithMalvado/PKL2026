<?php

use App\Models\Bdg;
use App\Support\Bantu;

if (! function_exists('setelan')) {
    function setelan(string $kunci, ?string $bawaan = null): ?string
    {
        return Bantu::setelan($kunci, $bawaan);
    }
}

if (! function_exists('logo_situs')) {
    function logo_situs(): string
    {
        return Bantu::logo();
    }
}

if (! function_exists('logo_bdg')) {
    function logo_bdg(?Bdg $bdg): ?string
    {
        return Bantu::logoBdg($bdg);
    }
}

if (! function_exists('telp_kantor')) {
    function telp_kantor(): ?string
    {
        return Bantu::telp();
    }
}

if (! function_exists('wa_kantor')) {
    function wa_kantor(): ?string
    {
        return Bantu::wa();
    }
}

if (! function_exists('wa_tampil')) {
    function wa_tampil(): ?string
    {
        return Bantu::waTampil();
    }
}

if (! function_exists('tautan_layanan')) {
    function tautan_layanan(): array
    {
        return Bantu::tautanLayanan();
    }
}

if (! function_exists('sosmed')) {
    function sosmed(): array
    {
        return Bantu::sosmed();
    }
}
