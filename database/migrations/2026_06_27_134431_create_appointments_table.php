<?php

use App\Enums\AppointmentStatusEnum;
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
        Schema::create('appointments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignuuid('patient_id')
                ->nullable()
                ->constrained('patients')
                ->nullOnDelete();
            $table->foreignuuid('doctor_id')
                ->nullable()
                ->constrained('doctors')
                ->nullOnDelete();
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->char('status', 20)->default(AppointmentStatusEnum::DEFAULT->value)->comment('Status of the appointment');
            $table->string('reason_for_visit');
            $table->string('notes')->nullable();
            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
