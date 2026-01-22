<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('title'); // report title
            $table->text('description')->nullable();
            $table->string('disaster_type'); // ex: Flood, Earthquake, Landslide
            $table->string('location')->nullable(); // alamat bebas / teks
            $table->decimal('latitude', 10, 8)->nullable(); // for coordinates
            $table->decimal('longitude', 11, 8)->nullable(); // for coordinates
            
            $table->string('photo_path')->nullable(); // file upload optional
            $table->enum('status', ['pending', 'verified', 'resolved'])->default('pending');
            $table->text('admin_notes')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
