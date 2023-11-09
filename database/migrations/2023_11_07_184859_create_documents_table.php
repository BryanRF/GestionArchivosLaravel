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
        Schema::create('documents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('incident_id')->nullable();
            $table->uuid('employees_id')->nullable();
            $table->string('name', 600);
            $table->string('icon')->default('bi bi-file-earmark');
            $table->string('color')->default('btn btn-primary');
            $table->string('tipo')->default('Archivo');
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->string('file')->nullable();
            $table->foreign('incident_id')->references('id')->on('incidents');
            $table->foreign('employees_id')->references('id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
