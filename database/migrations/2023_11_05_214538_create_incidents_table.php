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
            $table->uuid('ticket_id')->nullable();
            $table->text('description')->nullable();
            $table->dateTime('incident_date');
            $table->boolean('active')->default(true);
            $table->enum('status', ['Pendiente', 'Revisado', 'Anulado'])->default('Pendiente');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('ticket_id')->references('id')->on('tickets');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('user_id')->references('id')->on('users');
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
