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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number')->unique(); // Nomor tiket unik, misal TIKET-001
            $table->string('title'); // Judul masalah
            $table->text('description'); // Penjelasan detail masalah
            
            // Relasi ke tabel kategori dan user
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('reporter_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('technician_id')->nullable()->constrained('users')->nullOnDelete();
            
            $table->string('priority')->default('Medium'); // Low, Medium, High, Critical
            $table->string('status')->default('Open'); // Open, Assigned, In Progress, Pending, Resolved, Closed, Rejected
            
            $table->string('location')->nullable(); // Lokasi ruangan/gedung pelapor
            $table->string('attachment')->nullable(); // Bukti foto/file jika ada
            $table->text('solution')->nullable(); // Solusi yang ditulis teknisi
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
