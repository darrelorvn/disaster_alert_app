<?php

namespace Database\Seeders;

use App\Enums\DisasterStatus;
use App\Enums\DisasterType;
use App\Enums\EmergencyPlaceType;
use App\Enums\InformationSource;
use App\Enums\ReportStatus;
use App\Enums\UserRole;
use App\Models\DisasterEvent;
use App\Models\DisasterReport;
use App\Models\EmergencyPlace;
use App\Models\EvacuationRoute;
use App\Models\MitigationNote;
use App\Models\NotificationPreference;
use App\Models\SafetyGuide;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,]);

        $user = User::query()->updateOrCreate(
            ['email' => 'user@siaga.test'],
            [
                'name' => 'Masyarakat Demo',
                'phone' => '081234567890',
                'role' => UserRole::User->value,
                'password' => Hash::make('password'),
            ]
        );

        $officer = User::query()->updateOrCreate(
            ['email' => 'petugas@siaga.test'],
            [
                'name' => 'Petugas BMKG Demo',
                'phone' => '081298765432',
                'role' => UserRole::Officer->value,
                'staff_id' => 'BMKG-001',
                'agency' => 'BMKG',
                'position' => 'Analis Kebencanaan',
                'password' => Hash::make('password'),
            ]
        );

        NotificationPreference::query()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'alert_filter' => 'flood,earthquake,landslide',
                'sound_enabled' => true,
                'push_enabled' => true,
                'email_enabled' => false,
            ]
        );

        NotificationPreference::query()->updateOrCreate(
            ['user_id' => $officer->id],
            [
                'alert_filter' => 'all',
                'sound_enabled' => true,
                'push_enabled' => true,
                'email_enabled' => true,
            ]
        );

        $floodEvent = DisasterEvent::query()->updateOrCreate(
            ['title' => 'Banjir di Kecamatan Cengkareng'],
            [
                'type' => DisasterType::Flood->value,
                'status' => DisasterStatus::Alert->value,
                'source' => InformationSource::UserReport->value,
                'summary' => 'Debit air meningkat dan beberapa ruas jalan tergenang.',
                'location_name' => 'Cengkareng, Jakarta Barat',
                'latitude' => -6.1526,
                'longitude' => 106.7401,
                'occurred_at' => now()->subHours(4),
                'metadata' => ['severity' => 'medium'],
            ]
        );

        DisasterEvent::query()->updateOrCreate(
            ['title' => 'Gempa terasa di wilayah Bantul'],
            [
                'type' => DisasterType::Earthquake->value,
                'status' => DisasterStatus::Watch->value,
                'source' => InformationSource::Bmkg->value,
                'summary' => 'Getaran dirasakan ringan. Warga diminta memantau informasi resmi.',
                'location_name' => 'Bantul, DI Yogyakarta',
                'latitude' => -7.8881,
                'longitude' => 110.3288,
                'occurred_at' => now()->subDay(),
                'metadata' => ['magnitude' => 4.2],
            ]
        );

        DisasterReport::query()->updateOrCreate(
            ['description' => 'Air setinggi lutut orang dewasa dan arus cukup deras di jalan utama.'],
            [
                'user_id' => $user->id,
                'disaster_event_id' => $floodEvent->id,
                'type' => DisasterType::Flood->value,
                'status' => ReportStatus::Submitted->value,
                'location_name' => 'Jalan Lingkar Luar Cengkareng',
                'latitude' => -6.1517,
                'longitude' => 106.7379,
                'occurred_at' => now()->subHours(3),
                'reporter_name' => 'Masyarakat Demo',
                'reporter_phone' => '081234567890',
            ]
        );

        EvacuationRoute::query()->updateOrCreate(
            ['name' => 'Rute Evakuasi Cengkareng - GOR Kecamatan'],
            [
                'disaster_type' => DisasterType::Flood->value,
                'status' => 'active',
                'area' => 'Cengkareng',
                'start_latitude' => -6.1517,
                'start_longitude' => 106.7379,
                'end_latitude' => -6.1433,
                'end_longitude' => 106.7341,
                'distance_km' => 1.4,
                'description' => 'Gunakan jalan utama ke arah GOR Kecamatan sebagai titik kumpul.',
            ]
        );

        EvacuationRoute::query()->updateOrCreate(
            ['name' => 'Rute Evakuasi Bantul - Lapangan Desa'],
            [
                'disaster_type' => DisasterType::Earthquake->value,
                'status' => 'active',
                'area' => 'Bantul',
                'start_latitude' => -7.8881,
                'start_longitude' => 110.3288,
                'end_latitude' => -7.8822,
                'end_longitude' => 110.3341,
                'distance_km' => 0.9,
                'description' => 'Keluar dari bangunan dan menuju lapangan desa terdekat.',
            ]
        );

        EmergencyPlace::query()->updateOrCreate(
            ['name' => 'GOR Kecamatan Cengkareng'],
            [
                'type' => EmergencyPlaceType::Shelter->value,
                'address' => 'Cengkareng, Jakarta Barat',
                'area' => 'Cengkareng',
                'latitude' => -6.1433,
                'longitude' => 106.7341,
                'capacity' => 350,
                'contact' => '112',
                'status' => 'active',
                'metadata' => ['facilities' => ['air bersih', 'toilet', 'dapur umum']],
            ]
        );

        EmergencyPlace::query()->updateOrCreate(
            ['name' => 'Posko Terpadu Cengkareng'],
            [
                'type' => EmergencyPlaceType::EmergencyPost->value,
                'address' => 'Kantor Kecamatan Cengkareng',
                'area' => 'Cengkareng',
                'latitude' => -6.1500,
                'longitude' => 106.7355,
                'capacity' => 80,
                'contact' => '021-555000',
                'status' => 'active',
                'metadata' => ['services' => ['pendataan', 'logistik', 'evakuasi']],
            ]
        );

        EmergencyPlace::query()->updateOrCreate(
            ['name' => 'Puskesmas Cengkareng'],
            [
                'type' => EmergencyPlaceType::HealthFacility->value,
                'address' => 'Cengkareng, Jakarta Barat',
                'area' => 'Cengkareng',
                'latitude' => -6.1492,
                'longitude' => 106.7380,
                'capacity' => 40,
                'contact' => '021-544000',
                'status' => 'active',
                'metadata' => ['services' => ['IGD', 'triase', 'obat dasar']],
            ]
        );

        SafetyGuide::query()->updateOrCreate(
            ['title' => 'Panduan Aman Saat Banjir'],
            [
                'disaster_type' => DisasterType::Flood->value,
                'category' => 'article',
                'content' => 'Matikan listrik, simpan dokumen penting dalam plastik, dan evakuasi ke tempat tinggi jika air terus naik.',
                'video_url' => null,
                'is_published' => true,
            ]
        );

        SafetyGuide::query()->updateOrCreate(
            ['title' => 'Video Pertolongan Pertama Saat Gempa'],
            [
                'disaster_type' => DisasterType::Earthquake->value,
                'category' => 'video',
                'content' => 'Tutorial dasar tindakan aman saat gempa dan setelah guncangan berhenti.',
                'video_url' => 'https://example.com/video/gempa',
                'is_published' => true,
            ]
        );

        SafetyGuide::query()->updateOrCreate(
            ['title' => 'Update Informasi Cuaca Ekstrem'],
            [
                'disaster_type' => DisasterType::Flood->value,
                'category' => 'news',
                'content' => 'Warga diminta memantau informasi resmi terkait potensi hujan intensitas tinggi.',
                'video_url' => null,
                'is_published' => true,
            ]
        );

        MitigationNote::query()->updateOrCreate(
            ['title' => 'Distribusi Logistik Awal Cengkareng'],
            [
                'officer_id' => $officer->id,
                'disaster_type' => DisasterType::Flood->value,
                'affected_area' => 'Cengkareng',
                'action_date' => now()->toDateString(),
                'description' => 'Petugas membuka posko, menyiapkan logistik, dan mengarahkan warga ke GOR Kecamatan.',
                'metadata' => ['priority' => 'high'],
            ]
        );
    }
}
