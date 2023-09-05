<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            // Charsets
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            // Columns
            $table->id();
            $table->string('name', 100)->collation('utf8mb4_unicode_ci');
            $table->unsignedInteger('display_order')->nullable();
            $table->boolean('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brands');
    }
}
