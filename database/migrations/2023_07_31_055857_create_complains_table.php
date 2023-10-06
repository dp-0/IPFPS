<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('complains', function (Blueprint $table) {
            $table->id();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->text('address');
            $table->text('complain_details');
            $table->string('complain_number')->unique();
            $table->timestamp('reported_at');
            $table->timestamp('incident_date')->default(DB::raw('CURRENT_TIMESTAMP'));;
            $table->foreignId('register_by')->references('id')->on('users');
            $table->foreignId('complain_by')->references('id')->on('complainants');
            $table->foreignId('incident_type_id')->references('id')->on('incident_types');
            $table->foreignId('status_id')->references('id')->on('fir_statuses');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complains');
    }
};
