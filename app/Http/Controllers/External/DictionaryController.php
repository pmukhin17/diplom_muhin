<?php

namespace App\Http\Controllers\External;

use App\Http\Controllers\Api\pub\v1\WordApiController;
use App\Models\Surdo\Actual;
use App\Models\Surdo\Config;
use App\Models\Surdo\Dialect;
use App\Models\Surdo\Jest;
use App\Models\Surdo\Style;
use App\Models\Surdo\Theme;
use App\Models\Surdo\Vid;
use App\Models\Surdo\Bibliography;
use App\Models\Surdo\JestBibliography;
use App\Models\Surdo\Location;
use App\Models\Surdo\Face;
use App\Models\Surdo\Orientation_body;
use App\Models\Surdo\Orientation_hand;
use App\Models\Surdo\HnsMove;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DictionaryController extends Controller
{
    /**
     * Возвращает данные для главной страницы словаря
     *
     * @return array
     */
    public function index(): array
    {
        $data = [
            'actuality' => Actual::get(['id_actual', 'actual']),
            'translation' => Style::get(['id_style', 'style']),
            'dialect' => Dialect::get(['id_dialect', 'dialect']),
            'theme' => Theme::orderBy('id_tema')->get(['id_tema as id', 'value as label', 'parent_id']),
            'configs' => Config::get(['id_conf', 'base_conf','pic']),
            'vids' => Vid::get(),
            'bibliography' => Bibliography::get(['id_bibliography', 'bibliography','id_bibliography_type']),
            'jestbibliography' => JestBibliography::get(['id_jest', 'id_bibliography']),
            'location' => Location::get(['id_location','name_location', 'pic']),
            'face' => Face::get(['id_face','name_face']),
            'orientation_body' => Orientation_body::get(['id_orientation','name_orientation', 'pic']),
            'orientation_hand' => Orientation_hand::get(['id_orientation','name_orientation','pic']),
            'hnsmove' => HnsMove::get(['id_move','name_move','pic']),

        ];

        return $data;
    }

    /**
     * Возвращает страницу жеста по его id
     *
     * @param $id
     * @return void
     */
    public function alone($id)
    {
        $jest = Jest::whereIdJest($id)->first();

        if (empty($jest))
            abort(404);
        else if ($jest->deviant == 1 && Auth::check() && Auth::user()->hasPermission('browse_deviant') || $jest->deviant == 0)
            return view('alone', compact('id'));

        return abort(403);
    }

    /**
     * Возвращает страницу русско-жестового переводика
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function rusjest(Request $request)
    {
        $words = new WordApiController();

        $words = $words->index($request);

        return view('layouts.rusjest.index', ['words' => $words]);
    }

    
    /**
     * Возвращает страницу жестово-русского переводчика
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function jestrus()
    {
        return view('layouts.jestrus.index', ['jests' => Jest::where('admin_checked', '=', 1)->orderBy('jest')->get(['jest', 'srd_surd_jest.id_jest', 'nedooformleno'])]);
    }

    /**
     * Возвращаем страницу "О словаре"
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dictionary()
    {
        return view('layouts.about');
    }

    public function similarity()
    {
        return view('layouts.similarity', ['config' => Config::orderBy('base_conf')->get(['id_conf', 'base_conf'])]);
    }

    /**
     * Возвращает страницу добавления жеста
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createJest()
    {
        if (Auth::user()->hasPermission('create_jest'))
            return view('create_jest');
    }
}
