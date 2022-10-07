<?php

namespace App\Http\Controllers\Api\pub\exerc\generator;

use DB;

/* данный файл представляет из себя инкапсуляцию алгоритма по генерации упражнений
    *
    * содержит классы:
    * gen - фасад
    * surdoPrep - выгрузка из базы данных и подготовка данных о жестах и их переводах к дальнейшей обработке
    * NLPgen - создание предложений на русском языке
    * combinator - связывание предложений на русском языке и выгрузки из бд





    * packer - подготовка созданной информации в формат, который будет отображен на фронтэнде
    */

class gen
{

    public $ret;

    private $id_chapt;

    function __construct($_id_chapter)
    {
        $this->id_chapt = $_id_chapter;
    }

    function prepare()
    {

        $this->ret = [
            'assignments' => json_decode('{"1":{"name":"проанализируйте перевод на жесты","key":1,"lines":{"1":"Правитель третьего мира почивает<br>[Царь][Москва][отдых]","2":"Биссектриса будет равна пятнадцати<br>[биссектриса][прямо][=][15]","3":"Где сорочка и трусики?","4":"Доброе утро! Это солёные галеты и бульон.","5":"Гражданин! Это не мой тесак!","6":"Дядька милиционер был сосредоточен."}},"2":{"name":"проанализируйте перевод на жесты","key":2,"lines":{"7":"Бабуля немало Трудится.","8":"Хорош на сегодня бастовать.","9":"Захватывающее совещание было!","10":"Снимать одежду.","11":"Действительно, будь по вашему, аккуратней стройте."}}}'),

            'tasks' => json_decode('{"1":{"name":"1)","key":1,"lines":{"1":"Бабка два дня назад старалась.","2":"Биссектриса будет равна пятнадцати","3":"Где сорочка и трусики?","4":"Доброго здоровьица! Это солёные галеты к первому.","5":"Дядька из компетентных органов был внимателен."}},"2":{"name":"2)","key":2,"lines":{"6":"Забавное совещание было!","7":"Имеется огромное количество фонарей.","8":"Импераор московский передохнул.","9":"Конечно, договорились, водите аккуратнее.","10":"Мужик! это не мой тесак"}},"3":{"name":"3)","key":3,"lines":{"11":"Снимать одежду.","12":"Строим без участия одиннадцати юнцов.","13":"Третьего дня тётки закончили стройку.","14":"Хорош на сегодня бунтовать."}}}'),

        ];
    }


    function gen()
    {
        // $CurSordoPrep = new SurdoPrep();
        // $CustomNLP = new NLPgen();
        // // return $CurSordoPrep->createFilter($this->id_chapt);
        // return $CustomNLP->create();


        return $this->ret;
    }
}

/*======================================*/
class SurdoPrep
{

    private $wordSignStructPerChapter = [];


    private $isCurPrioritized = True;
    private $chapt_id;


    function __construct()
    {
        //

    }
    //
    private function getChapters($chapt_id)
    {
        $this->chapt_id = $chapt_id;

        $chapterMark = DB::table('exerc_chapters')->where('id_chapter', $chapt_id)->get(['id_pair', 'num'])[0];
        $idChapt_mass = DB::table('exerc_chapters')
            ->where('id_pair', '=', $chapterMark->id_pair)
            ->where('num', '<=', $chapterMark->num)
            ->get(['id_chapter']);

            $ret = [];
            foreach ($idChapt_mass as $row) {
                array_push($ret, $row->id_chapter);
            }
            return $ret;

    }
    private function loadSingnsAndWords($chapters){

        $basis = DB::table('exerc_chapters_connections')->whereIn('id_chapter', $chapters)
        ->join('exerc_word_sign_connections as d', 'exerc_chapters_connections.id_dispersion', '=', 'd.id')
        ->join('srd_surd_words as w', 'd.id_word', '=', 'w.id_word')
        ->join('srd_surd_jest as j', 'd.id_jest', '=', 'j.id_jest')
        ->get([ 'j.jest', 'w.word', 'd.id as id_dispersion', 'j.id_jest']);


        $sub_ret = [];
        foreach ($basis as $row) {
            $sub_ret[$row->id_jest]['sign'] = [
                'jest' => explode ( ' (', $row->jest)[0],
                'id' => $row->id_jest,
                'is_priorit' => false,
            ];
            $sub_ret[$row->id_jest]['words'][$row->id_dispersion] = [
                'word' => $row->word,
                'stemmed_word'=> Stemmer::getWordBase(mb_strtolower($row->word))
            ];
        }
        if ($this->isCurPrioritized){

            $basis = DB::table('exerc_chapters_connections')->where('id_chapter', $this->chapt_id)
            ->join('exerc_word_sign_connections as d', 'exerc_chapters_connections.id_dispersion', '=', 'd.id')
            ->get([ 'd.id as id_dispersion', 'd.id_jest']);

            foreach ($basis as $row) {
                $sub_ret[$row->id_jest]['sign']['is_priorit'] = true;
            }
        }

        // удаление подпорок и приведение в нормальный вид итоговой структуры
        $ret = [];
        foreach ($sub_ret as $row) {

            $row['words'] = $this->simplifyDictionary($row);
            array_push($ret, $row);
        }
        // return $raw_data;
        return $ret;
    }

    function simplifyDictionary($row) {
        $tmp_words = [];
        $sample = $row['sign']['jest'];
        foreach ($row['words'] as $value) {
            // упрощение словаря по правилу N2

            // правило N2: если если жест и переод имеют одинаковое написание и
            // : N > 2 то данный перевод не используется далее
            // : N <= 2 то используется только данный перевод

            $isBigBatch = sizeof($row['words']) > 2;
            $isSelftranslated = $value["word"] == $sample;

            //$isBigBatch && !$isSelftranslated || !$isBigBatch && $isSelftranslated => $isBigBatch xor $isSelftranslated
            if($isBigBatch xor $isSelftranslated)
                array_push($tmp_words, $value);

        };
        return $tmp_words;
    }

    function createFilter($_id_chapter, $force = false)
    {
        // если нет в кеше то создать
        if (!array_key_exists($_id_chapter,$this->wordSignStructPerChapter) && !$force)
            $this->wordSignStructPerChapter[$_id_chapter] = $this->loadSingnsAndWords($this->getChapters($_id_chapter));

        // выдать через return
        return $this->wordSignStructPerChapter[$_id_chapter];

    }
}
/*======================================*/
class NLPgen
{

    function create()
    {
        $sentences = [
            'Правитель третьего мира почивает',
            'Биссектриса будет равна пятнадцати',
            'Где сорочка и трусики?',
            'Доброе утро! Это солёные галеты и бульон.',
            'Гражданин! Это не мой тесак!',
            'Бабуля немало Трудится.',
            'Хорош на сегодня бастовать.',
            'Захватывающее совещание было!',
            'Снимать одежду.',
            'Действительно, будь по вашему, аккуратней стройте.',

        ];

        $stemmer = new Stemmer();
        $stemmed = [];

        foreach ($sentences as $index => $sentence) {
            $stemmed[$index]['sentence'] = $sentence;
            foreach (explode(' ', mb_strtolower(str_replace(['!', '?', '.', ','],'',$sentence))) as $word) {
                $stemmed[$index]['words'][] = $stemmer->getWordBase($word);

            }
        }

        return $stemmed;
    }
}
/*======================================*/
class Combinator
{
    private $NLPgen;
    private $surdoPrep;

    private $combinated;

    function __construct($SurdoPrep, $NLPgen)
    {
        $this->NLPgen = $NLPgen;
        $this->surdoPrep = $SurdoPrep;
    }

    function combine()
    {
        // TODO оптимизация как произведения матриц
        foreach ($this->NLPgen->create() as $row) {
            foreach ($row['words'] as $word) {

            }
        }
    }
}
/*======================================*/
class Dispencer
{
}
/*======================================*/
class Packer
{
}
/*======================================*/
/*======================================*/
class filter
{
    function __construct()
    {
    }
}
