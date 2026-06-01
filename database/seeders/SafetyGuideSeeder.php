<?php

namespace Database\Seeders;

use App\Enums\DisasterType;
use App\Models\SafetyGuide;
use Illuminate\Database\Seeder;

class SafetyGuideSeeder extends Seeder
{
    public function run(): void
    {
        $guides = [
            // Articles
            [
                'title' => 'Panduan Evakuasi Mandiri Tanah Longsor',
                'disaster_type' => DisasterType::Landslide->value,
                'category' => 'article',
                'content' => 'Kenali tanda-tanda tanah longsor seperti retakan tanah dan pohon miring. Segera jauhi lereng jika hujan lebat turun terus-menerus. Bawa tas siaga bencana yang telah disiapkan.',
                'video_url' => null,
                'is_published' => true,
            ],
            [
                'title' => 'Langkah Penyelamatan Diri Saat Kebakaran',
                'disaster_type' => DisasterType::Fire->value,
                'category' => 'article',
                'content' => 'Jangan panik. Segera keluar dari bangunan. Jika ada asap tebal, merangkaklah karena udara bersih berada di dekat lantai. Jangan gunakan lift, gunakan tangga darurat.',
                'video_url' => null,
                'is_published' => true,
            ],
            [
                'title' => 'Mitigasi Bencana Tsunami',
                'disaster_type' => DisasterType::Tsunami->value,
                'category' => 'article',
                'content' => 'Jika terjadi gempa kuat di daerah pantai, segera jauhi pantai dan cari tempat tinggi. Jangan tunggu peringatan resmi jika Anda melihat air laut surut tiba-tiba.',
                'video_url' => null,
                'is_published' => true,
            ],
            [
                'title' => 'Persiapan Menghadapi Erupsi Gunung Berapi',
                'disaster_type' => DisasterType::Volcano->value,
                'category' => 'article',
                'content' => 'Siapkan masker dan kacamata pelindung. Patuhi instruksi evakuasi dari pihak berwenang. Tutup semua jendela dan pintu untuk mencegah abu vulkanik masuk ke dalam rumah.',
                'video_url' => null,
                'is_published' => true,
            ],

            // Videos
            [
                'title' => 'Video: Cara Membaca Rambu Jalur Evakuasi Tsunami',
                'disaster_type' => DisasterType::Tsunami->value,
                'category' => 'video',
                'content' => 'Pelajari cara mengenali dan mengikuti rambu-rambu jalur evakuasi tsunami yang ada di lingkungan Anda.',
                'video_url' => 'https://www.youtube.com/embed/dummy_tsunami_video',
                'is_published' => true,
            ],
            [
                'title' => 'Video: Pembuatan Tas Siaga Bencana (TSB)',
                'disaster_type' => DisasterType::Other->value,
                'category' => 'video',
                'content' => 'Video tutorial tentang apa saja yang harus disiapkan dan dimasukkan ke dalam Tas Siaga Bencana untuk keperluan darurat selama 72 jam.',
                'video_url' => 'https://www.youtube.com/embed/dummy_tsb_video',
                'is_published' => true,
            ],
            [
                'title' => 'Video: Cara Menggunakan APAR',
                'disaster_type' => DisasterType::Fire->value,
                'category' => 'video',
                'content' => 'Tutorial singkat dan mudah dipahami tentang cara menggunakan Alat Pemadam Api Ringan (APAR) dengan metode PASS (Pull, Aim, Squeeze, Sweep).',
                'video_url' => 'https://www.youtube.com/embed/dummy_apar_video',
                'is_published' => true,
            ],

            // News
            [
                'title' => 'Waspada: Peningkatan Aktivitas Gunung Merapi',
                'disaster_type' => DisasterType::Volcano->value,
                'category' => 'news',
                'content' => 'Terdapat peningkatan kegempaan vulkanik di kawasan Gunung Merapi. Warga di radius 5km diharapkan untuk tetap waspada dan siap siaga.',
                'video_url' => null,
                'is_published' => true,
            ],
            [
                'title' => 'Peringatan Dini Cuaca: Potensi Hujan Lebat Disertai Angin',
                'disaster_type' => DisasterType::Flood->value,
                'category' => 'news',
                'content' => 'BMKG mengeluarkan peringatan dini terkait potensi hujan lebat yang dapat memicu banjir bandang di beberapa wilayah pegunungan.',
                'video_url' => null,
                'is_published' => true,
            ],
            [
                'title' => 'Info Pemadam Kebakaran: Evaluasi Sarana Gedung Bertingkat',
                'disaster_type' => DisasterType::Fire->value,
                'category' => 'news',
                'content' => 'Dinas Pemadam Kebakaran melakukan pengecekan berkala terhadap sistem keamanan dan jalur evakuasi di berbagai gedung bertingkat di pusat kota.',
                'video_url' => null,
                'is_published' => true,
            ],
        ];

        foreach ($guides as $guide) {
            SafetyGuide::query()->updateOrCreate(
                ['title' => $guide['title']],
                $guide
            );
        }
    }
}