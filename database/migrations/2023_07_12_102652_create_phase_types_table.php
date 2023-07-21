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
        Schema::create('phase_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('phase_id')->nullable()->constrained();
            $table->string('type')->nullable();
            $table->timestamps();
        });


        DB::table('phase_types')->insert([
            ['type' => 'Domestic', 'phase_id' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'Commercial', 'phase_id' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'Industrial', 'phase_id' => '1', 'created_at' => now(), 'updated_at' => now()],

            ['type' => 'Domestic', 'phase_id' => '2', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'Commercial', 'phase_id' => '2', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'Industrial', 'phase_id' => '2', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phase_types');
    }
};
