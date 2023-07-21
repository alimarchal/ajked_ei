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
        Schema::create('division_sub_divisions', function (Blueprint $table) {
            $table->id();
            $table->integer('division_code')->nullable();
            $table->string('division_name')->nullable();
            $table->integer('sub_division_code')->nullable();
            $table->string('sub_division_name')->nullable();
            $table->timestamps();
        });


        DB::table('division_sub_divisions')->insert([
            ['division_code' => '', 'division_name' => '1', 'sub_division_code' => '1', 'sub_division_name' => '1', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('division_sub_divisions');
    }
};
