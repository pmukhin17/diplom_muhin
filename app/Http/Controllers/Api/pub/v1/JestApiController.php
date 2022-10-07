<?php

namespace App\Http\Controllers\Api\pub\v1;

use App\Models\Surdo\Bibliography;
use App\Models\Surdo\FuzzySearch;
use App\Models\Surdo\Jest;
use App\Models\Surdo\JestBibliography;
use App\Models\Surdo\Word;
use App\Models\Surdo\Analog;
use App\Models\Surdo\Sostav;
use App\Models\Surdo\JestWord;
use Carbon\Carbon;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class JestApiController extends Controller
{
    private $filter;

    public function __construct()
    {
        $this->middleware('auth:api')->only(['update', 'uploadFiles', 'deleteMedia',  'destroy', 'store', 'countJests']);
    }

    /**
     * Display a listing of the resource.
     * Возвращает список жестов к выбранному слову;
     * Поддерживает фильтры по ключевым столбцам;
     * Если значение фильтра === null, то фильтр не работает
     * Если не получен id слова, то возвращает []
     *
     * @param Request $request
     * @return Jest[]
     */
    public function index(Request $request)
    {
        $id = $request->input('id_word');

        $this->filter = [
            'deviant' => $request->input('deviant') == 'true' ? 1 : 0,
        ];

        return ($request->input('id_word') === null) ? []
            : Word::findOrFail($id)->jests()
                ->orderBy('jest')->whereAdminChecked(1)
                ->whereDeviant($this->filter['deviant'])
                ->with(['dialect', 'actual', 'style'])
                ->get(['srd_surd_jest.id_jest', 'jest', 'nedooformleno', 'id_dialect', 'id_actual', 'id_style']);
    }


    public function getGestures_fuzzy(Request $request){

        $fuzzy = $request->input('fuzzy');
        $id_conf_begin = $request->input('id_conf_begin');

        $this->filter = [
            'id_jest' => $request->input('id_jest'),
            'id_style' => $request->input('id_style'),
            'id_dialect' => $request->input('id_dialect'),
            'id_tema' => $request->input('id_tema'),
            'id_actual' => $request->input('id_actual'),
            'id_jest_obraz' => $request->input('id_jest_obraz'),
            'id_jest_paradigm' => $request->input('id_jest_paradigm'),
            'id_vid' => $request->input('id_vid'),
            'hand_double' => $request->input('hand_double'),
            'id_conf_begin' => $request->input('id_conf_begin'),
            'id_conf_end' => $request->input('id_conf_end'),
            'id_conf_offhand_begin' => $request->input('id_conf_offhand_begin'),
            'id_conf_offhand_end' => $request->input('id_conf_offhand_end'),
            'id_move' => $request->input('id_move'),
            'id_location' => $request->input('id_location'),
            'id_hns_move' => $request->input('id_hns_move'),
            'id_face' => $request->input('id_face'),
            'id_orientation_body' => $request->input('id_orientation_body'),
            'id_orientation_hand' => $request->input('id_orientation_hand'),
            'admin_checked' => $request->input('admin_checked'),
            'nedooformleno' => $request->input('nedooformleno'),
            'deviant' => $request->input('deviant') == 'true' ? 1 : 0,
        ];

        if ($fuzzy === 'true'){
            if ($id_conf_begin !== null){
                $find_syn = array();
                $find_syn = FuzzySearch::search($id_conf_begin)->orderBy('id_conf_parent')->get(['id_conf_child','result']);
                $find_syn_count = count($find_syn);
                $find_syn_clear = array();
                for ($i = 0; $i < $find_syn_count; ++$i){
                    if ($find_syn[$i]->result > 0.7){
                        array_push($find_syn_clear,$find_syn[$i]);

                    }
                }
                $array = array();
                for ($i = 0; $i < count($find_syn_clear); ++$i){
                    array_push($array,$find_syn_clear[$i]->result);
                }
                for ($j = 0; $j < count($array) - 1; $j++){
                    for ($i = 0; $i < count($array) - $j - 1; $i++){
                        // если текущий элемент больше следующего
                        if ($array[$i] < $array[$i + 1]){
                            // меняем местами элементы
                            $tmp_var = $array[$i + 1];
                            $array[$i + 1] = $array[$i];
                            $array[$i] = $tmp_var;

                            $tmp_var_2 = $find_syn_clear[$i + 1];
                            $find_syn_clear[$i + 1] = $find_syn_clear[$i];
                            $find_syn_clear[$i] = $tmp_var_2;

                        }
                    }
                }
                $this->filter_fuzzy = [
                    'id_jest' => $request->input('id_jest'),
                    'id_style' => $request->input('id_style'),
                    'id_dialect' => $request->input('id_dialect'),
                    'id_tema' => $request->input('id_tema'),
                    'id_actual' => $request->input('id_actual'),
                    'id_jest_obraz' => $request->input('id_jest_obraz'),
                    'id_jest_paradigm' => $request->input('id_jest_paradigm'),
                    'id_vid' => $request->input('id_vid'),
                    'hand_double' => $request->input('hand_double'),
                    'id_conf_end' => $request->input('id_conf_end'),
                    'id_conf_offhand_begin' => $request->input('id_conf_offhand_begin'),
                    'id_conf_offhand_end' => $request->input('id_conf_offhand_end'),
                    'id_move' => $request->input('id_move'),
                    'id_location' => $request->input('id_location'),
                    'id_hns_move' => $request->input('id_hns_move'),
                    'id_face' => $request->input('id_face'),
                    'id_orientation_body' => $request->input('id_orientation_body'),
                    'id_orientation_hand' => $request->input('id_orientation_hand'),
                    'admin_checked' => $request->input('admin_checked'),
                    'nedooformleno' => $request->input('nedooformleno'),
                    'deviant' => $request->input('deviant') == 'true' ? 1 : 0,
                ];
                $return_gestures = array();
                for ($i = 0; $i < count($find_syn_clear); ++$i){
                    $find_id_jest = Jest::orderBy('jest')->ofFilter($this->filter_fuzzy)->OfBaseConfBegin($find_syn_clear[$i]->id_conf_child)->get(['jest', 'srd_surd_jest.id_jest', 'nedooformleno']);
                    array_push($return_gestures,$find_id_jest);
                }
                $return_gestures_2 = array();
                for ($i = 0; $i < count($return_gestures); ++$i){
                    for ($j = 0; $j < count($return_gestures[$i]); ++$j){
                        array_push($return_gestures_2,$return_gestures[$i][$j]);
                    }
                }

                return $return_gestures_2;


            }
            else{
                return Jest::orderBy('jest')
                    ->ofFilter($this->filter)
                    ->get(['jest', 'srd_surd_jest.id_jest', 'nedooformleno']);
            }

        }
        else{
            return Jest::orderBy('jest')
                ->ofFilter($this->filter)
                ->get(['jest', 'srd_surd_jest.id_jest', 'nedooformleno']);
        }
    }

    public function getGestures(Request $request)
    {
        $this->filter = [
            'id_jest' => $request->input('id_jest'),
            'id_style' => $request->input('id_style'),
            'id_dialect' => $request->input('id_dialect'),
            'id_tema' => $request->input('id_tema'),
            'id_actual' => $request->input('id_actual'),
            'id_jest_obraz' => $request->input('id_jest_obraz'),
            'id_jest_paradigm' => $request->input('id_jest_paradigm'),
            'id_vid' => $request->input('id_vid'),
            'hand_double' => $request->input('hand_double'),
            'id_conf_begin' => $request->input('id_conf_begin'),
            'id_conf_end' => $request->input('id_conf_end'),
            'id_conf_offhand_begin' => $request->input('id_conf_offhand_begin'),
            'id_conf_offhand_end' => $request->input('id_conf_offhand_end'),
            'id_move' => $request->input('id_move'),
            'id_location' => $request->input('id_location'),
            'id_hns_move' => $request->input('id_hns_move'),
            'id_face' => $request->input('id_face'),
            'id_orientation_body' => $request->input('id_orientation_body'),
            'id_orientation_hand' => $request->input('id_orientation_hand'),
            'admin_checked' => $request->input('admin_checked'),
            'nedooformleno' => $request->input('nedooformleno'),
            'deviant' => $request->input('deviant') == 'true' ? 1 : 0,
        ];

        return Jest::orderBy('jest')
            ->ofFilter($this->filter)
            ->get(['jest', 'srd_surd_jest.id_jest', 'nedooformleno']);
    }




    /**
     * Возвращает массив жестов (по поиску)
     * Ищет по части названия жеста
     *
     * @param Request $request
     * @return array
     */
    public function search(Request $request)
    {
        $searchText = $request->input('search');

        $this->filter = [

            'id_style' => $request->input('id_style'),
            'id_dialect' => $request->input('id_dialect'),
            'id_tema' => $request->input('id_tema'),
            'id_actual' => $request->input('id_actual'),
            'id_jest_obraz' => $request->input('id_jest_obraz'),
            'id_jest_paradigm' => $request->input('id_jest_paradigm'),
            'id_vid' => $request->input('id_vid'),
            'hand_double' => $request->input('hand_double'),
            'id_conf_begin' => $request->input('id_conf_begin'),
            'id_conf_end' => $request->input('id_conf_end'),
            'id_conf_offhand_begin' => $request->input('id_conf_offhand_begin'),
            'id_conf_offhand_end' => $request->input('id_conf_offhand_end'),
            'id_move' => $request->input('id_move'),
            'id_location' => $request->input('id_location'),
            'id_hns_move' => $request->input('id_hns_move'),
            'id_face' => $request->input('id_face'),
            'id_orientation_body' => $request->input('id_orientation_body'),
            'id_orientation_hand' => $request->input('id_orientation_hand'),
            'admin_checked' => $request->input('admin_checked'),
            'nedooformleno' => $request->input('nedooformleno'),
            'deviant' => $request->input('deviant') == 'true' ? 1 : 0,
        ];

        return Jest::where('jest', 'like', "%$searchText%")->OfFilter($this->filter)->limit(100)->with(['dialect', 'actual', 'style'])->orderBy('jest')->get(['id_jest', 'jest', 'nedooformleno', 'id_dialect', 'id_actual', 'id_style']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    public function store(Request $request)
    {
        if (!Auth::user()->hasPermission("create_jest")) {
            return response()->json(['error' => 'Вы не можете создавать жесты.']);
        }

        $jest = new Jest();

        $jest->jest = $request->input('jest');
        $jest->id_dialect = $request->input('id_dialect');
        $jest->id_style = $request->input('id_style');
        $jest->id_tema = $request->input('id_tema');
        $jest->id_actual = $request->input('id_actual');
        $jest->id_jest_obraz = $request->input('id_jest_obraz');
        $jest->id_jest_paradigm = $request->input('id_jest_paradigm');
        $jest->id_vid = $request->input('id_vid');
        $jest->id_move = $request->input('id_move');
        $jest->id_location = $request->input('id_location');
        $jest->id_hns_move = $request->input('id_hns_move');
        $jest->id_face = $request->input('id_face');
        $jest->id_orientation_body = $request->input('id_orientation_body');
        $jest->id_orientation_hand = $request->input('id_orientation_hand');
        $jest->hand_double = $request->input('hand_double');
        $jest->id_conf_begin = $request->input('id_conf_begin');
        $jest->id_conf_end = $request->input('id_conf_end');
        $jest->id_conf_offhand_begin = $request->input('id_conf_offhand_begin');
        $jest->id_conf_offhand_end = $request->input('id_conf_offhand_end');
        $jest->deviant = $request->input('deviant');
        $jest->description = $request->input('description');
        $jest->etymology = $request->input('etymology');
        $jest->paradigm_root = $request->input('paradigm_root');
        $jest->obraz_root = $request->input('obraz_root');
        $jest->context_in = $request->input('context_in');
        $jest->context_off = $request->input('context_off');
        $jest->note = $request->input('note');
        $jest->admin_checked = $request->input('admin_checked');
        $jest->nedooformleno = $request->input('nedooformleno');
        $jest->created_at = Carbon::now();
        $jest->updated_at = Carbon::now();

        $jest->save();

        $analogsEdit = $request->input('jest_analogs');

        foreach ($analogsEdit as $item) {
            Analog::query()->updateOrCreate(
                ['id_jest' => $jest->id_jest, 'id_jest_analog' => $item['id_jest']]
            );
        }

        $sostavEdit = $request->input('jest_sostav');

        foreach ($sostavEdit as $item) {
            Sostav::query()->updateOrCreate(
                ['id_jest_master' => $jest->id_jest, 'id_jest_child' => $item['id_jest_child']],
                ['order_id' => $item['order_id']]
            );
        }

        $wordsEdit = $request->input('words');

        foreach ($wordsEdit as $item) {
            $word = null;
            // Добавление нового слова.
            if (!isset($item["id_word"])) {
                if (!is_array($item) && isset($item))
                    $word = Word::query()->updateOrCreate(['word' => $item, 'deviant' => 0]);
                else
                    $word = Word::query()->updateOrCreate(['word' => $item["word"], 'deviant' => 0]);

                JestWord::query()->updateOrCreate(['id_word' => $word->id_word, 'id_jest' => $jest->id_jest]);
            } else {
                JestWord::query()->updateOrCreate(
                    ['id_word' => $item['id_word'], 'id_jest' => $jest->id_jest]
                );
            }
        }



        return response()->json(['create' => 'Жест "'.$jest->jest.'" успешно создан.', 'id' => $jest->id_jest]);
    }

    private static function bibliographyCreate($jestId, $bibliographiesEdit, $bibliographyType)
    {
        try {
            if (empty($bibliographiesEdit))
                throw new \Exception("Список библиографии пуст.");

            foreach ($bibliographiesEdit as $item) {
                // Если автора нет в базе данных, добавляем автора.
                $author = null;
                if (!isset($item['id_bibliography'])) {
                    if (isset($item['bibliography']))
                        $author = Bibliography::query()->updateOrCreate(['bibliography' => $item['bibliography'], 'id_bibliography_type' => $bibliographyType]);
                    else
                        $author = Bibliography::query()->updateOrCreate(['bibliography' => $item, 'id_bibliography_type' => $bibliographyType]);

                    JestBibliography::query()->updateOrCreate(
                        ['id_bibliography' => $author->id_bibliography, 'id_jest' => $jestId]
                    );
                } else {
                    JestBibliography::query()->updateOrCreate(
                        ['id_bibliography' => $item['id_bibliography'], 'id_jest' => $jestId]
                    );
                }
            }
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    /**
     * Display the specified resource.
     * Возвращает жест со всей информацией
     * @param int $id
     * @return Jest|array
     */
    public function show($id)
    {
        return Jest::whereIdJest($id)->with([
                'actual', 'configBegin', 'configEnd', 'configOffhandBegin', 'configOffhandEnd',
                'dialect', 'jestObraz', 'jestParadigm', 'location', 'move',
                'face','hns_move','orientation_body','orientation_hand',
                'orientation', 'style', 'symMarker', 'theme', 'vid', 'jestAnalogs',
                'bibliographies', 'bibliographies_source', 'bibliographies_slovar', 'lexicons', 'jestSostav.jestChild', 'words'])
                ->first() ?? abort(404);
    }


    public function uploadFiles(Request $request)
    {
        if (Auth::check() && !Auth::user()->hasRole("admin")) {
            return response()->json(['error' => 'Только администратор может загружать медиафайлы жестов.']);
        }

        $id = $request->header('id');

        /**
         * Проверить файлы по id в папке с видео и изображениями.
         * Если файлы присутствуют, а поля загрузки файлов не пустые,
         * тогда заменяем файлы в папке на файлы из полей.
         * @param $name
         * @param $path
         */
        $uploadFile = function($name, $path) use ($request, $id) {
            if ($request->file($name) != null) {
                $request->file($name)->storeAs($path, $id . '.' . $request->file($name)->getClientOriginalExtension());
            }
        };

        $nameVideoFull = 'file_video_full';
        $nameVideoQu = 'file_video_qu';
        $nameImage = 'file_image';
        $nameImageSmall = 'file_image_small';

        $uploadFile($nameVideoFull, 'public/media/video');
        $uploadFile($nameVideoQu, 'public/media/video_lq');
        $uploadFile($nameImage, 'public/media/img');
        $uploadFile($nameImageSmall, 'public/media/small_img');


        return response()->json("Файлы успешно загружены");
    }

    /**
     * Проверяет существование медиа файлов жеста.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function existsMedia(Request $request)
    {
        $id = $request->get('id');

        $videoFullExists = (new \Illuminate\Filesystem\Filesystem)->glob(public_path()."/storage/media/video/".$id.".*", 0);
        $videoQuExists = (new \Illuminate\Filesystem\Filesystem)->glob(public_path()."/storage/media/video_lq/".$id.".*", 0);
        $imgExists = (new \Illuminate\Filesystem\Filesystem)->glob(public_path()."/storage/media/img/".$id.".*", 0);
        $imgSmallExists = (new \Illuminate\Filesystem\Filesystem)->glob(public_path()."/storage/media/small_img/".$id.".*", 0);

        $checkOfExists = [
            "videoFull" => $videoFullExists != [] ? pathinfo($videoFullExists[0], PATHINFO_BASENAME) : false,
            "videoQu" => $videoQuExists != [] ? pathinfo($videoQuExists[0], PATHINFO_BASENAME) : false,
            "image" => $imgExists != [] ? pathinfo($imgExists[0], PATHINFO_BASENAME) : false,
            "imageSmall" => $imgSmallExists != [] ? pathinfo($imgSmallExists[0], PATHINFO_BASENAME) : false
        ];

        return response()->json($checkOfExists);
    }

    /**
     * Удаляет выбранный медиа файл жеста
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function deleteMedia(Request $request)
    {
        if (Auth::check() && !Auth::user()->hasRole('admin')) {
            return response()->json(['error' => 'Вы не можете удалять медиа данные жестов.']);
        }

        $this->validate($request, [
            'fileNames' => 'required',
            'media' => 'required'
        ]);

        $fileNames = $request->get('fileNames');
        $media = $request->get('media');

        if ($media == 'videoFull')
            Storage::disk('public')->delete('media/video/'.$fileNames["videoFull"]);
        else if ($media == 'videoQu')
            Storage::disk('public')->delete('media/video_lq/'.$fileNames["videoQu"]);
        else if ($media == 'image')
            Storage::disk('public')->delete('media/img/'.$fileNames["image"]);
        else if ($media == 'imageSmall')
            Storage::disk('public')->delete('media/small_img/'.$fileNames["imageSmall"]);



        return response()->json(['property' => $media]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param int $id
     * @return string
     * @throws \Exception
     */
    public function update(Request $request, $id)
    {
        if (Auth::check() && !Auth::user()->hasPermission("browse_edit_jest")) {
            return response()->json(['error' => 'Вы не можете редактировать жесты.']);
        }

        $jest = Jest::find($id);

        if (empty($jest))
            abort(404);

        $jest->jest = $request->input('jest');
        $jest->id_dialect = $request->input('id_dialect');
        $jest->id_style = $request->input('id_style');
        $jest->id_tema = $request->input('id_tema');
        $jest->id_actual = $request->input('id_actual');
        $jest->id_jest_obraz = $request->input('id_jest_obraz');
        $jest->id_jest_paradigm = $request->input('id_jest_paradigm');
        $jest->id_vid = $request->input('id_vid');
        $jest->hand_double = $request->input('hand_double');
        $jest->id_conf_begin = $request->input('id_conf_begin');
        $jest->id_conf_end = $request->input('id_conf_end');
        $jest->id_conf_offhand_begin = $request->input('id_conf_offhand_begin');
        $jest->id_conf_offhand_end = $request->input('id_conf_offhand_end');
        $jest->id_move = $request->input('id_move');
        $jest->id_location = $request->input('id_location');
        $jest->id_hns_move = $request->input('id_hns_move');
        $jest->id_face = $request->input('id_face');
        $jest->id_orientation_body = $request->input('id_orientation_body');
        $jest->id_orientation_hand = $request->input('id_orientation_hand');
        $jest->deviant = $request->input('deviant');
        $jest->description = $request->input('description');
        $jest->etymology = $request->input('etymology');
        $jest->paradigm_root = $request->input('paradigm_root');
        $jest->obraz_root = $request->input('obraz_root');
        $jest->context_in = $request->input('context_in');
        $jest->context_off = $request->input('context_off');
        $jest->note = $request->input('note');
        $jest->admin_checked = $request->input('admin_checked');
        $jest->nedooformleno = $request->input('nedooformleno');
        $jest->updated_at = Carbon::now();

        $jest->save();

        // Текущие аналоги в жесте
        $currentAnalogs = Analog::query()->where('id_jest', '=', $id)->get();
        $analogsEdit = $request->input('jest_analogs');

        /**
         * Удаление аналогов.
         * Сравниваем текущие аналоги в базе данных
         * с теми, которые пришли с клиента. Если аналога из БД
         * не найдено в массиве слов на клиенте, удаляем его.
         */
        if (count($analogsEdit) == 0) {
            Analog::query()->where('id_jest', '=', $id)->delete();
        } else {
            foreach ($currentAnalogs as $analogDb)
            {
                if (!array_search($analogDb->id_jest_analog, $analogsEdit)) {
                    Analog::query()->where('id_jest_analog', $analogDb->id_jest_analog)->where('id_jest', $id)->delete();
                }
            }
        }

        foreach ($analogsEdit as $item) {
            Analog::query()->updateOrCreate(
                ['id_jest' => $id, 'id_jest_analog' => $item['id_jest']]
            );
        }

        // Текущий состав в жесте
        $currentSostav = Sostav::query()->where('id_jest_master', '=', $id)->get();
        $sostavEdit = $request->input('jest_sostav');

        /**
         * Удаление состава жеста.
         * Сравниваем текущий состав слова в базе данных
         * с теми, которые пришли с клиента. Если слово входящее в состав
         * жеста не найдено в массиве слов на клиенте, удаляем его.
         */
        if (count($sostavEdit) == 0) {
            Sostav::query()->where('id_jest_master', '=', $id)->delete();
        } else {
            foreach ($currentSostav as $sostavDb)
            {
                if (!array_search($sostavDb->id_jest_analog, $sostavEdit)) {
                    Sostav::query()->where('id_jest_child', $sostavDb->id_jest_child)->where('id_jest_master', $id)->delete();
                }
            }
        }

        foreach ($sostavEdit as $item) {
            Sostav::query()->updateOrCreate(
                ['id_jest_master' => $id, 'id_jest_child' => $item['id_jest_child']],
                ['order_id' => $item['order_id']]
            );
        }

        // Текущие слова в жесте
        $current = JestWord::query()->where('id_jest', '=', $id)->get();
        $wordsEdit = $request->input('words');

        /**
         * Удаление слов.
         * Сравниваем текущие слова жеста в базе данных
         * с теми, которые пришли с клиента. Если слово из БД
         * не найдено в массиве слов на клиенте, удаляем его.
         */
        if (count($wordsEdit) == 0) {
            JestWord::query()->where('id_jest', '=', $id)->delete();
        } else {
            foreach ($current as $wordDb)
            {
                if (!array_search($wordDb->id_word, $wordsEdit)) {
                    JestWord::query()->where('id_word', $wordDb->id_word)->where('id_jest', $id)->delete();
                }
            }
        }

        foreach ($wordsEdit as $item) {
            $word = null;
            // Добавление нового слова.
            if (!isset($item["id_word"])) {
                if (!is_array($item) && isset($item))
                    $word = Word::query()->updateOrCreate(['word' => $item, 'deviant' => 0]);
                else
                    $word = Word::query()->updateOrCreate(['word' => $item["word"], 'deviant' => 0]);

                JestWord::query()->updateOrCreate(['id_word' => $word->id_word, 'id_jest' => $jest->id_jest]);
            } else {
                JestWord::query()->updateOrCreate(
                    ['id_word' => $item['id_word'], 'id_jest' => $jest->id_jest]
                );
            }
        }

        return response()->json('Жест "'.$jest->jest.'" успешно обновлен.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Возвращает количество жестов в базе данных
     * @return mixed
     */
    public function countJests()
    {
        if (!Auth::user()->hasPermission("browse_statistics"))
            return Jest::count();
    }
}
