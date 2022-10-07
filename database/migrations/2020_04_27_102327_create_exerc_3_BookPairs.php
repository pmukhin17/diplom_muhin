<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExerc3BookPairs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        // BookPairs
        Schema::create('exerc_pairs', function (Blueprint $table) {
            $table->bigIncrements('id_pair')->comment('id пары учебника и рабочей тетради');
            $table->string('pair_name', 127)->comment('наименование пары учебника и рабочей тетради');
            $table->unsignedBigInteger('id_workbook')->comment('ссылка на id учебника');
            $table->unsignedBigInteger('id_textbook')->comment('ссылка на id рабочей тетради');
            $table->foreign('id_workbook')->references('id_workbook')->on('exerc_workbooks')->onDelete('cascade');
            $table->foreign('id_textbook')->references('id_textbook')->on('exerc_textbooks')->onDelete('cascade');

            $table->timestamps();
        });
        DB::statement("ALTER TABLE exerc_pairs comment 'таблица, хранящая в себе пары учебника и рабочей тетради, имеет связь с таблицами exerc_workbooks и exerc_textbooks по своим FK, имеет связь с таблицей '");


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('exerc_pairs');
    }
}
