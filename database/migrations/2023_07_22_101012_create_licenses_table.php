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
        Schema::create('licenses', function (Blueprint $table) {
            $table->id()->startingValue(100001);
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('challan_id')->nullable()->constrained();
            $table->foreignId('division_sub_division_id')->nullable()->constrained();
            $table->string('old_license_number')->nullable();
            $table->string('new_license_number')->nullable();
            $table->date('renewal_date')->nullable();
            $table->date('license_expiry')->nullable();
            $table->string('license_document', 2048)->nullable();
            $table->unsignedInteger('recommended_by')->nullable();
            $table->string('recommended_by_remarks')->nullable();
            $table->unsignedInteger('renewed_by')->nullable();
            $table->string('renewed_by_remarks')->nullable();
            $table->enum('status',['In-Process','Rejected','Approved'])->default('In-Process');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licenses');
    }
};
