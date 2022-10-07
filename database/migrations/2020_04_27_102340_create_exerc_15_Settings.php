<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExerc15Settings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exerc_settings', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('id настройки модуля exerc');

            $table->string('codename', 63)->comment('кодовое наименование группы настроек');
            $table->string('setings_name', 255)->comment('текстовое наименование');

            $table->json('value')->comment('значение настройки + тип значения + доп информация');

        });
        DB::statement("ALTER TABLE exerc_settings comment 'таблица, хранящая в себе список настроек,не имеет связей с другими таблицами'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exerc_settings');
    }
}
