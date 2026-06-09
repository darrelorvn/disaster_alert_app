<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tambahan geofencing radius pada Tindakan Preventif
        Schema::table('tindakan_preventifs', function (Blueprint $table) {
            $table->decimal('latitude', 10, 7)->nullable()->after('lokasi');
            $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
            $table->decimal('radius_km', 8, 2)->default(1.0)->after('longitude');
        });

        // 2. Tambah waktu expired pada Bencana (DisasterEvent)
        Schema::table('disaster_events', function (Blueprint $table) {
            $table->timestamp('expired_at')->nullable()->after('resolved_at');
        });

        // 3. Relasikan Tindakan Penanggulangan dengan Laporan/Event Bencana
        Schema::table('mitigation_notes', function (Blueprint $table) {
            $table->foreignId('disaster_event_id')->nullable()->after('officer_id')->constrained()->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('tindakan_preventifs', function (Blueprint $table) {
            $table->dropColumn(['latitude', 'longitude', 'radius_km']);
        });

        Schema::table('disaster_events', function (Blueprint $table) {
            $table->dropColumn('expired_at');
        });

        Schema::table('mitigation_notes', function (Blueprint $table) {
            $table->dropConstrainedForeignId('disaster_event_id');
        });
    }
};
