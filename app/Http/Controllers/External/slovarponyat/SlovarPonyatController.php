<?php

namespace App\Http\Controllers\External\slovarponyat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SlovarPonyatRequest;
use App\Models\slovar_ponyat\all_def;
use App\Models\slovar_ponyat\Terms;
use DB;

class SlovarPonyatController extends Controller{


  public function second() {
      $terms = DB::table('terms')->orderBy('term_name')->get(['id_term', 'term_name']);
      $def = DB::table('all_defs')->get(['article', 'definition', 'lit_pr', 'lit_ist', 'id']);
      return view('layouts.slovar-ponyat.second' , ['term' => $terms, 'def' => $def]);
  }

  public function jestmakeup() {
      $req = DB::table('srd_surd_jest')->get(['jest']);
      $states = DB::table('dct_dict_articles')->get(['article_name','article_id','value'])->take(50);

      $state = DB::table('srd_surd_jest')
      ->join('exerc_word_sign_connections', 'srd_surd_jest.id_jest', '=', 'exerc_word_sign_connections.id_jest')
      ->join('srd_surd_words', 'exerc_word_sign_connections.id_word', '=', 'srd_surd_words.id_word')
      ->get(['exerc_word_sign_connections.id_jest','word'])->take(50);


      // dd($test = DB::table('dct_dict_articles')
      // ->where('article_name', '=', $state)->get('article_name'));

      return view('layouts.slovar-ponyat.first', ['jests' => $req, 'state' => $states]);

  }

  public function showonestate($id) {

      $states = DB::table('dct_dict_articles')->get(['article_name','article_id','value']);
      $terms = DB::table('terms')->get(['id_term', 'term_name']);
      return view('layouts.slovar-ponyat.onestate', ['st' => $states->get($id-1), 'statya' => $states->where('article_id', '=', $id), 'term' => $terms]);

  }

  public function form(SlovarPonyatRequest $form){
    $definition = new all_def();
    $term = new terms();
    $definition->article = $form->input('title');
    $definition->definition = $form->input('definition');
    $definition->lit_pr = $form->input('lit-ex');
    $definition->lit_ist = $form->input('ist-lit-ex');
    $term->term_name = $form->input('Term');

    $term->save();
    $definition->save();


    return redirect()->route('makeup')->with('success', 'Запись добавлена.');
  }

  public function updatestate(Request $form){
    $a = $form->get('id');
    $definition = all_def::find($a);
    $definition->article = $form->input('title');
    $definition->definition = $form->input('definition');
    $definition->lit_pr = $form->input('lit-ex');
    $definition->lit_ist = $form->input('ist-lit-ex');

    $definition->save();


    return redirect()->route('editor')->with('success', 'Запись была обновлена.');
  }

  public function deletestate(Request $form){

    $a = $form->get('id');
    all_def::find($a)->delete();

    return redirect()->route('editor')->with('success', 'Запись была удалена.');
  }

}
