<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'admin']);
        $all_menu = \DB::table('permissions')->pluck('name');
        $admin->givePermissionTo($all_menu);

        $produklayanan = Role::create(['name' => 'produklayanan']);
        $produklayananPermission = ['Dashboard', 'Produk & Layanan - Master Jenis', 'Produk & Layanan - Master Konten'];
        $produklayanan->givePermissionTo($produklayananPermission);

        $berita = Role::create(['name' => 'berita']);
        $beritaPermission = [
            'Dashboard',
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
        ];
        $berita->givePermissionTo($beritaPermission);
        
        $umkmbinaan = Role::create(['name' => 'umkmbinaan']);
        $umkmbinaan->givePermissionTo(['Dashboard', 'UMKM Binaan']);

        $trisuri = Role::create(['name' => 'trisuri']);
        $trisuri->givePermissionTo($all_menu);
    }
}
