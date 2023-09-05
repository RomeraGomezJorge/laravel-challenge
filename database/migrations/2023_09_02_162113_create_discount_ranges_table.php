<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountRangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_ranges', function (Blueprint $table) {
            // Charsets
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            // Columns
            $table->id();
            $table->unsignedInteger('from_days');
            $table->unsignedInteger('to_days');
            $table->double('discount')->nullable();
            $table->string('code', 15)->nullable()->collation('utf8mb4_unicode_ci');
            $table->foreignId('discount_id')->constrained();
            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discount_ranges');
    }
}
