<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            // Charsets
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            // Columns
            $table->id();
            $table->string('name', 100)->collation('utf8mb4_unicode_ci');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->unsignedInteger('priority')->default(0);
            $table->boolean('active')->default(false);
            $table->foreignId('region_id')->constrained();
            $table->foreignId('brand_id')->constrained();
            $table->string('access_type_code', 1)->collation('utf8mb4_unicode_ci');
            // Timestamps and SoftDelete
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('access_type_code')->references('code')->on('access_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discounts');
    }
}
