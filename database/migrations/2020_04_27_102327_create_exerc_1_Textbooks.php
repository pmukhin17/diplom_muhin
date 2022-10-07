<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExerc1Textbooks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Textbooks
        Schema::create('exerc_textbooks', function (Blueprint $table) {
            $table->bigIncrements('id_textbook')->comment('id учебника');
            $table->string('textbook_name', 127)->comment('наименование учебника');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE exerc_textbooks comment 'таблица, хранящая в себе наименования учебников, имеет связь с таблицей exerc_pairs по своему PK'");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('exerc_textbooks');

    }
}
