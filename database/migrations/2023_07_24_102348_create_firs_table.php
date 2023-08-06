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
        Schema::create('firs', function (Blueprint $table) {
            $table->id();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->text('address');
            $table->text('incident_details');
            $table->boolean('clue')->nullable();
            $table->timestamp('investigation_start_date')->nullable();
            $table->timestamp('investigation_end_date')->nullable();
            $table->string('case_number')->unique();
            $table->string('warrant_number')->unique();
            $table->timestamp('reported_at');
            $table->timestamp('incident_date');
            $table->bigInteger('related_to')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('register_by')->references('id')->on('users');
            $table->foreignId('complain_by')->references('id')->on('complainants');
            $table->foreignId('incident_type_id')->references('id')->on('incident_types');
            $table->foreignId('priority_id')->references('id')->on('case_priorities');
            $table->foreignId('status_id')->references('id')->on('fir_statuses');
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('firs');
    }
};
