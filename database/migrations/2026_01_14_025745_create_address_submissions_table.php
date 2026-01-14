<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('address_submissions', function (Blueprint $table) {
            $table->id();

            $table->string('user_name');

            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('commune_id');
            $table->unsignedBigInteger('village_id');

            // store names too (nice for reports, and safer if data changes later)
            $table->string('province_name');
            $table->string('district_name');
            $table->string('commune_name');
            $table->string('village_name');

            $table->timestamps();

            $table->index(
    ['province_id', 'district_id', 'commune_id', 'village_id'],
    'idx_addr_full'
);

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('address_submissions');
    }
};
