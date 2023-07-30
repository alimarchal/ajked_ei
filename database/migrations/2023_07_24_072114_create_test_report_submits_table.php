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
        Schema::create('test_report_submits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('test_report_id')->nullable()->constrained();
            $table->foreignId('division_sub_division_id')->nullable()->constrained();
            $table->foreignId('phase_id')->nullable()->constrained();
            $table->string('submit_by_role')->nullable();
            $table->string('submit_to_role')->nullable();
            $table->boolean('remarks')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_report_submits');
    }
};
