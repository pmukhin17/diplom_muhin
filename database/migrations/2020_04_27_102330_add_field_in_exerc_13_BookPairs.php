<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldInExerc13BookPairs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exerc_pairs', function (Blueprint $table) {
            $table->boolean('is_visible')->default(true)->comment('флаг отображения пары в общем списке пар');
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
            $table->dropColumn('is_visible');
        });
    }
}
