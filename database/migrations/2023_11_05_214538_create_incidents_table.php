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
        Schema::create('incidents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('employee_id')->nullable();
            $table->uuid('item_id')->nullable();
            $table->uuid('user_id')->nullable();
            $table->enum('priority', ['Alto', 'Medio', 'Bajo'])->default('Bajo');
            $table->dateTime('incident_date');
            $table->dateTime('incident_review')->nullable();
            $table->boolean('active')->default(true);
            $table->enum('status', ['Pendiente', 'Revisado', 'Anulado'])->default('Pendiente');
            $table->uuid('category_id');
            $table->string('title', 250);
            $table->mediumText('description');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidents');
    }
};
