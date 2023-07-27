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
        Schema::create('challan_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->string('name')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->enum('status', ['Active','In-Active'])->default('Active');
            $table->timestamps();
        });





        DB::transaction(function () {
            $query = "
                    INSERT INTO `challan_types` (`id`, `user_id`, `name`, `amount`, `created_at`, `updated_at`) VALUES
                    (1, NULL, 'Inspection Fee', 1000.0000, '2023-07-22 10:32:54', '2023-07-22 10:32:51'),
                    (2, NULL, 'Test Report Fee', 1000.0000, '2023-07-22 10:31:42', '2023-07-22 10:31:42'),
                    (3, NULL, 'Renewal License Fee', 1000.0000, '2023-07-22 10:32:54', '2023-07-22 10:32:51'),
                    (4, NULL, 'New Wiring Contractor Quota Fee', 1000.0000, '2023-07-22 10:31:42', '2023-07-22 10:31:42');
                ";

            DB::statement($query);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('challan_types');
    }
};
