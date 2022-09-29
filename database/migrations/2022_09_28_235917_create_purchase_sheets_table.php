<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_sheets', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->float('total_usd', 11, 3)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }       

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_sheets');
    }
};
