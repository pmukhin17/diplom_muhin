<?php


namespace App\Http\Controllers\Api\pub\v1;
use App\Http\Controllers\Controller;
use App\Models\Surdo\FuzzySearch;
use Illuminate\Http\Request;

class FuzzyApiController extends Controller
{
    public function getConfChild(Request $request){
        $id_parent = $request->input('id_conf');
        $find_conf = FuzzySearch::search($id_parent)->orderBy('id_conf_parent')->get(['id_conf_child','result']);
        return $find_conf;
    }

    public function update_coef(Request $request){
        $id_parent_conf = $request->input('id_parent_conf');
        $id_children_conf = $request->input('id_children_conf');
        $all_coef = $request->input('all_coef');
        FuzzySearch::query()->where('id_conf_parent', '=', $id_parent_conf )->delete();
        $children_count = count($id_children_conf);
        for($i = 0; $i < $children_count; ++$i){
            FuzzySearch::query()->updateOrCreate(['id_conf_parent' => (int)($id_parent_conf), 'id_conf_child' => (int)$id_children_conf[$i], 'result' => (float)$all_coef[$i]]);
        }

    }

}
