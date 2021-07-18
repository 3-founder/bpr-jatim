<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // sejarah
        $sejarah = new \App\Models\About;
        $sejarah->text_top = '<p style="margin-left:5%;margin-right:5%;">Melalui perjalanan panjang sejarah yang telah dilalui, Bank BPR Jatim Bank UMKM Jawa Timur selalu berkomitmen memberikan kontribusi terbaik guna membangun masyarakat Jawa Timur melalui berbagai produk layanan terbaik.</p>';
        $sejarah->judul = 'Sejarah';
        $sejarah->konten = '<p style="text-align:justify; text-justify:inter-word;">Berawal saat Pemerintah Jawa Timur mengeluarkan kebijakan di bidang perkreditan guna mendorong pengembangan usaha kecil, dengan membentuk Kredit Pedesaan yang disebut Kredit Usaha Rakyat Kecil (KURK). Pilot project yang semula hanya dilaksanakan di wilayah Madura pada tahun 1984/1985 diperluas ke seluruh Jawa Timur dengan SK No. 197 tahun 1984, kemudian status kelembagaannya   di perjelas sebagai BUMD dengan Perda Prov. Jatim No. 5 tahun 1987 dan mulai tahun 1988/1989 melalui beberapa tahapan konsolidasi LKURK telah menjadi 222 unit di 37 Kabupaten/kota se Jawa Timur.</p>
        <p style="text-align:justify; text-justify:inter-word;">Dengan berlakunya undang-undang No.7 tahun 1992 maka sesuai ketentuan pasal 58 bahwa Lembaga Kredit Usaha Rakyat Kecil (KURK), diberikan status sebagai Bank Perkreditan Rakyat dengan memenuhi persyaratan tata cara yang ditetapkan dengan peraturan Pemerintah. </p>
        <p style="text-align:justify; text-justify:inter-word;">Diantara 222 unit Lembaga Kredit Usaha Rakyat Kecil Jawa Timur (LKURK)setelah melalui beberapa penyaringan dan penelitian oleh Bank Indoensia dikukuhkan menjadi 66 unit PD. BPR KURK JATIM dengan Perda No. 16 tahun 1994.</p>
        <p style="text-align:justify; text-justify:inter-word;">Sesuai surat keputusan Bank Indonesia Nomor : 32/52/Kep/Dir tanggal 14 Mei 1999 tentang persyaratan dan tata cara merger, konsolidasi, dan akuisisi Bank Perkreditan Rakyat, dan sekaligus untuk menumbuhkan brand image masyarakat maka terhadap 66 unit PR. BPR KURK JATIM direncanakan dilakukan konsolidasi menjadi Perseroan Terbatas Bank Perkreditan Rakyat Jawa Timur atau yang lebih dikenal dengan Bank BPR Jatim.
        Konsolidasi PD. BPR JATIM menjadi Bank BPR Jatim bertujuan agar dapat tumbuh sehat, kuat, serta bekerja lebih berdaya guna dan berhasil guna sehingga mampu memberikan pelayanan kepada masyrakat secara profesional.</p>';
        $sejarah->tipe = 'sejarah';
        $sejarah->save();

        // visi misi
        $visiMisi = new \App\Models\About;
        $visiMisi->text_top = '<p style="margin-left:5%;margin-right:5%;">Melalui perjalanan panjang sejarah yang telah dilalui, Bank BPR Jatim Bank UMKM Jawa Timur selalu berkomitmen memberikan kontribusi terbaik guna membangun masyarakat Jawa Timur melalui berbagai produk layanan terbaik.</p>';
        $visiMisi->judul = 'Visi dan Misi';
        $visiMisi->konten = '<p>				
        Menjadi Bank yang sehat <br /> dan berkembang secara wajar, didukung oleh SDM  <br /> yang profesional dan berintegritas tinggi <br />serta fokus di UMKMK.</p><br><p>Ikut berperan dalam perekonomian Jawa Timur
        melalui pengembangan UMKMK
        (Usaha Mikro, Kecil, Menengah, Koperasi)
        utamanya Sektor Pertanian dan Sektor Perekonomian lainnya serta meningkatkan layanan berbasis digital.</p><br><p>Mitra UMKM
        terpercaya.</p>';
        $visiMisi->tipe = 'visi-misi';
        $visiMisi->save();

        // peranan
        $peranan = new \App\Models\About;
        $peranan->text_top = '<p style="margin-left:5%;margin-right:5%;">Melalui perjalanan panjang sejarah yang telah dilalui, Bank BPR Jatim Bank UMKM Jawa Timur selalu berkomitmen memberikan kontribusi terbaik guna membangun masyarakat Jawa Timur melalui berbagai produk layanan terbaik.</p>';
        $peranan->judul = 'Peranan';
        $peranan->konten = '<p>				
        Mendukung pengentasan kemiskinan yang harus dilakukan oleh Pemerintah Provinsi Kabupaten/kota.</p><br><p>Mendukung penciptaan lapangan kerja sehingga mengurangi pengangguran.</p><br><p>Mendukung pertumbuhan ekonomi daerah.</p>';
        $peranan->tipe = 'peranan';
        $peranan->save();
        
        // stuktur
        $stuktur = new \App\Models\About;
        $stuktur->text_top = '<p style="margin-left:5%;margin-right:5%;">Melalui perjalanan panjang sejarah yang telah dilalui, Bank BPR Jatim Bank UMKM Jawa Timur selalu berkomitmen memberikan kontribusi terbaik guna membangun masyarakat Jawa Timur melalui berbagai produk layanan terbaik.</p>';
        $stuktur->judul = 'Struktur Organisasi';
        $stuktur->konten = '<h3>STRUKTUR ORGANISASI KANTOR PUSAT</h3>';
        $stuktur->tipe = 'stuktur';
        $stuktur->save();

        // manajemen
        $manajemen = new \App\Models\About;
        $manajemen->text_top = '<p style="margin-left:5%;margin-right:5%;">Melalui perjalanan panjang sejarah yang telah dilalui, Bank BPR Jatim Bank UMKM Jawa Timur selalu berkomitmen memberikan kontribusi terbaik guna membangun masyarakat Jawa Timur melalui berbagai produk layanan terbaik.</p>';
        $manajemen->judul = 'Manajemen';
        $manajemen->konten = '<h3>Manajemen</h3>';
        $manajemen->tipe = 'manajemen';
        $manajemen->save();

        // identitas
        $identitas = new \App\Models\About;
        $identitas->text_top = '<p style="margin-left:5%;margin-right:5%;">Melalui perjalanan panjang sejarah yang telah dilalui, Bank BPR Jatim Bank UMKM Jawa Timur selalu berkomitmen memberikan kontribusi terbaik guna membangun masyarakat Jawa Timur melalui berbagai produk layanan terbaik.</p>';
        $identitas->judul = 'Identitas Perusahaan';
        $identitas->konten = '<h3>Identitas Perusahaan</h3>';
        $identitas->tipe = 'identitas';
        $identitas->save();

        // hukum perusahaan
        $hukum = new \App\Models\About;
        $hukum->text_top = '<p style="margin-left:5%;margin-right:5%;">Bank BPR Jatim Bank UMKM Jawa Timur sebagai perusahaan terbuka memiliki kewajiban untuk melakukan keterbukaan dan transparansi informasi laporan kinerja kepada pihak investor, masyarakat pasar modal, dan pemegang saham.</p>';
        $hukum->judul = 'Hukum Perusahaan';
        $hukum->konten = '<h3>Hukum Perusahaan</h3>';
        $hukum->tipe = 'hukum';
        $hukum->save();

        // komposisi saham
        $komposisi = new \App\Models\About;
        $komposisi->text_top = '<p style="margin-left:5%;margin-right:5%;">Bank BPR Jatim Bank UMKM Jawa Timur sebagai perusahaan terbuka memiliki kewajiban untuk melakukan keterbukaan dan transparansi informasi laporan kinerja kepada pihak investor, masyarakat pasar modal, dan pemegang saham.</p>';
        $komposisi->judul = 'Komposisi Saham';
        $komposisi->konten = '<h3>Komposisi Saham</h3>';
        $komposisi->tipe = 'komposisi';
        $komposisi->save();

        // tata kelola perusahaan
        $tata_kelola = new \App\Models\About;
        $tata_kelola->text_top = '<p style="margin-left:5%;margin-right:5%;">Bank BPR Jatim Bank UMKM Jawa Timur sebagai perusahaan terbuka memiliki kewajiban untuk melakukan keterbukaan dan transparansi informasi laporan kinerja kepada pihak investor, masyarakat pasar modal, dan pemegang saham.</p>';
        $tata_kelola->judul = 'Tata Kelola Perusahaan';
        $tata_kelola->konten = '<h3>Tata Kelola Perusahaan</h3>';
        $tata_kelola->tipe = 'tata_kelola';
        $tata_kelola->save();
    }
}
