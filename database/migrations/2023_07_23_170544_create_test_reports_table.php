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
        Schema::create('test_reports', function (Blueprint $table) {
            $table->id()->startingValue(10001);
            // test report initiated
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('challan_id')->nullable()->constrained();
            $table->foreignId('phase_id')->nullable()->constrained();
            $table->foreignId('phase_type_id')->nullable()->constrained();
            // reporting date
            $table->date('date')->default(now());
            $table->foreignId('division_sub_division_id')->nullable()->constrained();
            $table->string('transformer_capacity')->nullable();
            $table->string('consumer_name')->nullable();
            $table->string('father_husband_name')->nullable();
            $table->string('cnic', 15)->nullable();
            $table->string('mobile_number')->nullable();
            $table->text('complete_address')->nullable();

            $table->string('insulation')->nullable();
            $table->string('continuity')->nullable();
            $table->string('earthing')->nullable();

            $table->decimal('wc_test_report_fee', 14, 2)->nullable();
            $table->boolean('agreement')->default(0);

            $table->boolean('wc_verified')->default(0);
            $table->boolean('sdo_verified')->default(0);
            $table->boolean('xen_verified')->default(0);
            $table->enum('sdo_xen_status',['Approved','Objection'])->nullable();
            $table->boolean('dei_verified')->default(0);
            $table->boolean('aei_verified')->default(0);
            $table->enum('dei_aei_status',['Approved','Objection'])->nullable();
            $table->boolean('ei_verified')->default(0);
            $table->boolean('noc_issued')->default(0);
            // 1 for single phase work done
//            $table->unsignedInteger('status')->nullable();

            $table->enum('status',['Approved','Objection','In-Process'])->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_reports');
    }
};
