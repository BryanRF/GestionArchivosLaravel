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
            $table->uuid('employee_id');
            $table->uuid('item_id');
            $table->text('description');
            $table->dateTime('incident_date');
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->enum('status', ['Pendiente', 'Revisado', 'Anulado'])->default('Pendiente');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->foreign('item_id')->references('id')->on('items');
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
