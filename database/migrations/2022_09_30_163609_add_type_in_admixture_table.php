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
        Schema::table('admixtures', function (Blueprint $table) {
            $table->foreignId('type_id')->nullable()->constrained('admixture_types')->after('replace_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admixture', function (Blueprint $table) {
            //
        });
    }
};
