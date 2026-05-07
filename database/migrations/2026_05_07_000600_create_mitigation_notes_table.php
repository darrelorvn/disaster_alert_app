<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mitigation_notes', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('officer_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('title');
            $table->string('disaster_type')->index();
            $table->string('affected_area')->nullable()->index();
            $table->date('action_date')->nullable();
            $table->text('description')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mitigation_notes');
    }
};
