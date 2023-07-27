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
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('challan_id')->nullable()->constrained();
            $table->string('old_license_number')->nullable();
            $table->string('new_license_number')->nullable();
            $table->date('renewal_date')->default(now());
            $table->date('license_expiry')->default(now());
            $table->string('license_document', 2048)->nullable();
            $table->unsignedInteger('renewed_by')->nullable();
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
