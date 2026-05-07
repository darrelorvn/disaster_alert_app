<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('safety_guides', function (Blueprint $table): void {
            $table->id();
            $table->string('title');
            $table->string('disaster_type')->nullable()->index();
            $table->string('category')->default('article')->index();
            $table->longText('content')->nullable();
            $table->string('video_url')->nullable();
            $table->boolean('is_published')->default(false)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('safety_guides');
    }
};
