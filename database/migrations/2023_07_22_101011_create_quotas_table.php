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
        Schema::create('quotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('challan_id')->nullable()->constrained();

            $table->foreignId('phase_id')->nullable()->constrained();
            $table->foreignId('phase_type_id')->nullable()->constrained();

            $table->enum('type',['Credit','Debit']);
            $table->unsignedBigInteger('quantity');
            $table->unsignedBigInteger('outstanding_balance');
            $table->unsignedInteger('approved_by')->nullable();
            $table->string('remarks')->nullable();
            $table->enum('status',['In-Process','Rejected','Approved'])->default('In-Process');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotas');
    }
};
