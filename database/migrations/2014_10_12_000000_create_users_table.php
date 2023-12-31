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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('division_sub_division_id')->nullable()->constrained();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('cnic',15)->nullable()->unique();
            $table->string('license_number')->nullable();
            $table->date('license_number_expiry')->nullable();
            $table->string('address')->nullable();
            $table->string('mobile_no',11)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->boolean('status')->default(1);

            $table->unsignedBigInteger('quota')->default(0);

            $table->unsignedBigInteger('domestic')->default(0);
            $table->unsignedBigInteger('commercial')->default(0);
            $table->unsignedBigInteger('industrial')->default(0);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
