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
        Schema::create('student_attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->restrictOnDelete();
            $table->date('date');
            $table->enum('status', ['hadir tepat waktu', 'terlambat', 'izin', 'sakit', 'tidak hadir']);
            $table->timestamp('time_in')->nullable();
            $table->enum('input_method', ['QR', 'Tap', 'Manual']);
            $table->boolean('is_manual_override')->default(false);
            $table->text('reason')->nullable();
            $table->string('proof_file_url')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['student_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_attendances');
    }
};
