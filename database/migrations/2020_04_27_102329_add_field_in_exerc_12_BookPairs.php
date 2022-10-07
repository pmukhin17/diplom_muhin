<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldInExerc12BookPairs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exerc_pairs', function (Blueprint $table) {
            $table->boolean('is_favorite')->default(false)->comment('флаг, отображающий присутствие в списке избранного');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exerc_pairs', function (Blueprint $table) {
            $table->dropColumn('is_favorite');
        });
    }
}
