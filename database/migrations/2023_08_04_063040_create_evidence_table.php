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
        Schema::create('evidence', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fir_id');
            $table->text('description');
            $table->text('type');
            $table->unsignedBigInteger('collected_by');
            $table->timestamp('collected_at');
            $table->unsignedBigInteger('preserved_by');
            $table->timestamp('preserved_at')->default(DB::raw('CURRENT_TIMESTAMP'));;
            $table->text('attachment_path');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('fir_id')->references('id')->on('firs');
            $table->foreign('collected_by')->references('id')->on('users');
            $table->foreign('preserved_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evidence');
    }
};
