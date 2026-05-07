<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('emergency_places', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('type')->index();
            $table->string('address')->nullable();
            $table->string('area')->nullable()->index();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->unsignedInteger('capacity')->nullable();
            $table->string('contact')->nullable();
            $table->string('status')->default('active')->index();
            $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('emergency_places');
    }
};
