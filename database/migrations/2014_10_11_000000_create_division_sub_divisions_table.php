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
            $table->string('circle')->nullable();
            $table->timestamps();
        });


        DB::transaction(function () {
            $query = "
                    INSERT INTO `division_sub_divisions` (`id`, `division_code`, `division_name`, `sub_division_code`, `sub_division_name`, `circle`, `created_at`, `updated_at`) VALUES
                    (1, 7111, 'GHARRI DUPATTA', 71111, 'AIRPORT', 'Muzaffarabad', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (2, 7111, 'GHARRI DUPATTA', 71112, 'GHARRI DUPATTA', 'Muzaffarabad', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (3, 7112, 'HATTIAN', 71121, 'CHIKAR', 'Muzaffarabad', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (4, 7112, 'HATTIAN', 71122, 'CHINARI', 'Muzaffarabad', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (5, 7112, 'HATTIAN', 71123, 'HATTIAN', 'Muzaffarabad', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (6, 7113, 'MUZAFFARABAD', 71131, 'CITY-1', 'Muzaffarabad', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (7, 7113, 'MUZAFFARABAD', 71132, 'CITY-2', 'Muzaffarabad', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (8, 7113, 'MUZAFFARABAD', 71133, 'DANNA', 'Muzaffarabad', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (9, 7113, 'MUZAFFARABAD', 71134, 'PATTIKA', 'Muzaffarabad', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (10, 7114, 'NEELUM', 71141, 'ATHMUQAM', 'Muzaffarabad', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (11, 7114, 'NEELUM', 71142, 'SHARDA', 'Muzaffarabad', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (12, 7121, 'BAGH', 71211, 'BAGH', 'Rawalakot', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (13, 7121, 'BAGH', 71212, 'DHIRKOT', 'Rawalakot', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (14, 7121, 'BAGH', 71213, 'HARIGEHL', 'Rawalakot', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (15, 7121, 'BAGH', 71214, 'RAIRAH', 'Rawalakot', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (16, 7122, 'HAJIRA', 71221, 'HAJIRA', 'Rawalakot', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (17, 7123, 'KAHUTTA', 71231, 'KAHUTTA', 'Rawalakot', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (18, 7124, 'PALLANDRI', 71241, 'BALOCH', 'Rawalakot', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (19, 7124, 'PALLANDRI', 71242, 'MONG', 'Rawalakot', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (20, 7124, 'PALLANDRI', 71243, 'PALLANDRI', 'Rawalakot', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (21, 7124, 'PALLANDRI', 71244, 'TRARKHAL', 'Rawalakot', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (22, 7125, 'RAWLAKOT', 71251, 'KHAIGALA', 'Rawalakot', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (23, 7125, 'RAWLAKOT', 71252, 'PANIOLA', 'Rawalakot', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (24, 7125, 'RAWLAKOT', 71253, 'RAWLAKOT', 'Rawalakot', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (25, 7125, 'RAWLAKOT', 71254, 'THORAR', 'Rawalakot', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (26, 7126, 'ABBASSPUR', 71261, 'ABBASPUR', 'Rawalakot', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (27, 7211, 'BHIMBER', 72111, 'BARNALA 1', 'Mirpur', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (28, 7211, 'BHIMBER', 72112, 'BARNALA2', 'Mirpur', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (29, 7211, 'BHIMBER', 72113, 'BHIMBER 1', 'Mirpur', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (30, 7211, 'BHIMBER', 72114, 'BHIMBER 2', 'Mirpur', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (31, 7211, 'BHIMBER', 72115, 'JANDALA', 'Mirpur', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (32, 7211, 'BHIMBER', 72116, 'SAMANI', 'Mirpur', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (33, 7212, 'CHAKSWARI', 72121, 'CHAKSWARI', 'Mirpur', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (34, 7212, 'CHAKSWARI', 72122, 'DADYAL 1', 'Mirpur', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (35, 7212, 'CHAKSWARI', 72123, 'DADYAL-2', 'Mirpur', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (36, 7212, 'CHAKSWARI', 72124, 'ISLAMGHAR', 'Mirpur', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (37, 7212, 'CHAKSWARI', 72125, 'KANALI', 'Mirpur', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (38, 7213, 'MIRPUR', 72131, 'CITY 1', 'Mirpur', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (39, 7213, 'MIRPUR', 72132, 'CITY 2', 'Mirpur', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (40, 7213, 'MIRPUR', 72133, 'MIRPUR WEST', 'Mirpur', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (41, 7214, 'NEWCITY', 72141, 'CHECHIAN', 'Mirpur', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (42, 7214, 'NEWCITY', 72142, 'JATLAN', 'Mirpur', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (43, 7214, 'NEWCITY', 72143, 'NEW CITY', 'Mirpur', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (44, 7221, 'KHUIRATTA', 72211, 'CHAROI', 'Mirpur', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (45, 7221, 'KHUIRATTA', 72212, 'DUNGI', 'Mirpur', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (46, 7221, 'KHUIRATTA', 72213, 'KHUIRATTA CITY', 'Mirpur', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (47, 7221, 'KHUIRATTA', 72214, 'KHUIRATTA CITY 2', 'Mirpur', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (48, 7221, 'KHUIRATTA', 72215, 'NAR', 'Mirpur', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (49, 7222, 'KOTLI', 72221, 'FATEH PUR', 'Mirpur', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (50, 7222, 'KOTLI', 72222, 'KOTLI HEAD QUARTER', 'Mirpur', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (51, 7222, 'KOTLI', 72223, 'QAMRUTI', 'Mirpur', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (52, 7222, 'KOTLI', 72224, 'TATTA PANI', 'Mirpur', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (53, 7223, 'SEHNSA', 72231, 'SARSAWA', 'Mirpur', '2023-07-11 14:00:00', '2023-07-12 14:00:00'),
                    (54, 7223, 'SEHNSA', 72232, 'SEHNSA HEAD QUARTER', 'Mirpur', '2023-07-11 14:00:00', '2023-07-12 14:00:00');
                ";

            DB::statement($query);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('division_sub_divisions');
    }
};
