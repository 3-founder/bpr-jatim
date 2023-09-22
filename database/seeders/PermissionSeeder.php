<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $all_menu = [
            'Dashboard',
            'Master User',
            'Master Profil Perusahaan',
            'Master Vidio Intro',
            'Master Kebijakan Privasi',
            'Master Syarat dan Ketentuan',
            'Master Bunga',
            'Master Tenor',
            'Master Cabang',
            'Master Kurs',
            'Master Laporan Keuangan',
            'Master Tata Kelola Perusahaan',
            'Master Tanggung Jawab Perusahaan',
            'Master Jumbotron',
            'Tentang BPR - Sejarah',
            'Tentang BPR - Visi Misi',
            'Tentang BPR - Peranan',
            'Tentang BPR - Manajemen',
            'Tentang BPR - Identitas Perusahaan',
            'Transparansi - Hukum Perusahaan',
            'Transparansi - Komposisi Saham',
            'Transparansi - Tata Kelola Perusahaan',
            'Produk & Layanan - Master Jenis',
            'Produk & Layanan - Master Konten',
            'UMKM Binaan',
            'Berita & Info - Kategori Berita',
            'Berita & Info - Berita',
            'Berita & Info - Promo',
            'Berita & Info - ePaper UMKM',
            'Berita & Info - Penghargaan',
            'Berita & Info - Peta Cabang',
            'Berita & Info - Karier',
            'Berita & Info - Data Pengaduan Nasabah',
            'Berita & Info - Tips Keamanan & Info Terkini',
            'Berita & Info - Jaringan Kantor Kas',
            'Berita & Info - Pengumuman Lelang Jaminan',
            'Kataegori FAQ',
            'Item FAQ',
            'List Pengajuan Kredit',
        ];

        for ($i=0; $i < count($all_menu); $i++) { 
            Permission::create(['name' => $all_menu[$i]]);
        }
    }
}
