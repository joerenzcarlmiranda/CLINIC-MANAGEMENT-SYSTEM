<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('display_id', 20)->nullable()->unique()->comment('Human-readable consultation ID, e.g. CONS-0001');
            $table->foreignUuid('appointment_id')->constrained('appointments')->cascadeOnDelete();
            $table->text('chief_complaint');
            $table->text('diagnosis')->nullable();
            $table->text('treatment_plan')->nullable();
            $table->text('doctors_notes')->nullable();
            $table->date('consultation_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
