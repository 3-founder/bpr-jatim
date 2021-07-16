<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SyaratDanKetentuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sk = new \App\Models\SyaratDanKetentuan;
        $sk->syarat_dan_ketentuan = '<p><strong>Kebijaksanaan informasi</strong></p>
        </p>
        
        <p>Penggunaan website ini dan isinya disediakan untuk kenyamanan Anda. Informasi pada website ini disediakan untuk Anda tanpa jaminan jenis apapun, baik tersurat maupun tersirat, termasuk tetapi tidak terbatas pada jaminan atas barang dan/atau produk jasa layak dagang, keselarasan untuk maksud tertentu, promosi atas suatu produk dengan tidak melanggar aturan.</p>
        
        <p>Informasi pada website ini mungkin menyertakan petunjuk teknis yang tidak/kurang akurat serta kekeliruan tipografi. PT Bank Perkreditan Rakyat Jawa Timur berhak untuk setiap saat melakukan perbaikan dan/atau perubahan pada informasi dalam website ini dengan cara bagaimanapun juga, tanpa pemberitahuan sebelumnya.</p>
        
        <p>PT Bank Perkreditan Rakyat Jawa Timur tidak bertanggung-jawab atas segala bentuk kerugian baik materiil maupun non-materiil, yang mungkin akan diderita oleh siapapun dan pihak manapun juga, sebagai akibat langsung maupun tidak langsung dari penggunaan informasi dalam website ini baik sebagian maupun seluruhnya.<br />
        &nbsp;</p>
        
        <p><strong>Link ke situs lainnya</strong></p>
        
        <p>Untuk kenyamanan Anda, PT Bank Perkreditan Rakyat Jawa Timur dapat menyertakan links ke situs-situs lainnya di internet yang dimiliki dan/atau dioperasikan oleh pihak manapun juga. Harap dicatat bahwa situs yang terkait itu tidak berada di bawah pengendalian PT Bank Perkreditan Rakyat Jawa Timur, oleh karenanya PT Bank Perkreditan Rakyat Jawa Timur &nbsp;sama sekali tidak bertanggung-jawab terhadap isi dari situs-situs tersebut.</p>';
        $sk->save();
    }
}
