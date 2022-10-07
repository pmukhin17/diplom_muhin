<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExerc2Workbooks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Workbooks
        Schema::create('exerc_workbooks', function (Blueprint $table) {
            $table->bigIncrements('id_workbook')->comment('id рабочей тетради');
            $table->string('workbook_name', 127)->comment('наименование рабочей тетради');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE exerc_workbooks comment 'таблица, хранящая в себе наименования рабочих тетрадей, имеет связь с таблицей exerc_pairs по своему PK'");


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('exerc_workbooks');

    }
}
