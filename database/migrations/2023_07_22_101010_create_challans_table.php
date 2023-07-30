<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('challans', function (Blueprint $table) {
            $table->id();
            // who generated challan
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('challan_type_id')->nullable()->constrained();
            $table->decimal('amount', 10, 2)->nullable();
            $table->enum('status', ['Paid', 'Unpaid', 'Canceled'])->default('Unpaid');
            $table->string('challan_receipt_path', 2048)->nullable();
            $table->unsignedInteger('report_id')->nullable();
            $table->unsignedInteger('verified_by_user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('challans');
    }
};
