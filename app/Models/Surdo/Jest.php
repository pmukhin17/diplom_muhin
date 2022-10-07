<?php

namespace App\Models\Surdo;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/**
 * App\Models\Surdo\Jest
 *
 * @property int $id_jest
 * @property string $jest
 * @property string|null $description
 * @property string|null $etymology
 * @property string|null $paradigm_root
 * @property string|null $obraz_root
 * @property int|null $hand_double
 * @property string|null $context_in
 * @property string|null $context_off
 * @property string|null $note
 * @property int $state
 * @property int $admin_checked
 * @property int $nedooformleno
 * @property int $deviant
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $id_jest_paradigm
 * @property int|null $id_jest_obraz
 * @property int|null $id_style
 * @property int|null $id_vid
 * @property int|null $id_dialect
 * @property int|null $id_actual
 * @property int|null $id_move
 * @property int|null $id_tema
 * @property int|null $id_conf_begin
 * @property int|null $id_conf_end
 * @property int|null $id_conf_offhand_begin
 * @property int|null $id_conf_offhand_end
 * @property string|null $notation_formula
 * @property int|null $id_location
 * @property int|null $id_hns_move
 * @property int|null $id_face
 * @property int|null $id_orientation_body
 * @property int|null $id_orientation_hand
 * @property int|null $id_orient
 * @property int|null $id_sym_marker
 * @property-read \App\Models\Surdo\Actual|null $actual
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\Bibliography[] $bibliographies
 * @property-read \App\Models\Surdo\Config|null $configBegin
 * @property-read \App\Models\Surdo\Config|null $configEnd
 * @property-read \App\Models\Surdo\Config|null $configOffhandBegin
 * @property-read \App\Models\Surdo\Config|null $configOffhandEnd
 * @property-read \App\Models\Surdo\Dialect|null $dialect
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\Jest[] $jestAnalogs
 * @property-read \App\Models\Surdo\Jest|null $jestObraz
 * @property-read \App\Models\Surdo\Jest|null $jestParadigm
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\Sostav[] $jestSostav
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\Sostav[] $jestSostavChild
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\Lexicon[] $lexicons
 * @property-read \App\Models\Surdo\Location|null $location
 * @property-read \App\Models\Surdo\Movement|null $move
 * @property-read \App\Models\Surdo\Orientation|null $orientation
 * @property-read \App\Models\Surdo\Style|null $style
 * @property-read \App\Models\Surdo\SymMarker|null $symMarker
 * @property-read \App\Models\Surdo\Theme|null $theme
 * @property-read \App\Models\Surdo\Vid|null $vid
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\Word[] $words
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Jest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Jest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Jest query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Jest whereAdminChecked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Jest whereContextIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Jest whereContextOff($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Jest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Jest whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Jest whereDeviant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Jest whereEtymology($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Jest whereHandDouble($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Jest whereIdActual($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Jest whereIdConfBegin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Jest whereIdConfEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Jest whereIdConfOffhandBegin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Jest whereIdConfOffhandEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Jest whereIdDialect($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Jest whereIdJest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Jest whereIdJestObraz($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Jest whereIdJestParadigm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Jest whereIdLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Jest whereIdMove($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Jest whereIdOrient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Jest whereIdStyle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Jest whereIdSymMarker($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Jest whereIdTema($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Jest whereIdVid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Jest whereJest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Jest whereNedooformleno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Jest whereNotationFormula($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Jest whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Jest whereObrazRoot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Jest whereParadigmRoot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Jest whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Jest whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Jest extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'srd_surd_jest';
    protected $casts = [
        'id_style'   => 'int',
        'deviant'   => 'int',
        'state'   => 'int',
        'hand_double'   => 'int',
        'nedooformleno'   => 'int',
        'admin_checked'   => 'int',
        'id_jest_paradigm'   => 'int',
        'id_jest_obraz'   => 'int',
        'id_vid'   => 'int',
        'id_dialect'   => 'int',
        'id_actual'   => 'int',
        'id_move'   => 'int',
        'id_tema'   => 'int',
        'id_conf_begin'   => 'int',
        'id_conf_end'   => 'int',
        'id_conf_offhand_begin'   => 'int',
        'id_conf_offhand_end'   => 'int',
        'id_location'   => 'int',
        'id_hns_move'   => 'int',
        'id_face'   => 'int',
        'id_orientation_body'   => 'int',
        'id_orientation_hand'   => 'int',
        'id_orient'   => 'int',
        'id_sym_marker'   => 'int',
    ];

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_jest';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = [
        'id_jest_paradigm',
        'id_jest_obraz',
        'id_style',
        'id_vid',
        'id_dialect',
        'id_actual',
        'id_move',
        'id_tema',
        'id_conf_begin',
        'id_conf_end',
        'id_conf_offhand_begin',
        'id_conf_offhand_end',
        'id_location',
        'id_hns_move',
        'id_face',
        'id_orientation_body',
        'id_orientation_hand',
        'id_orient',
        'id_sym_marker',
        'jest',
        'description',
        'etymology',
        'paradigm_root',
        'obraz_root',
        'hand_double',
        'context_in',
        'context_off',
        'note',
        'state',
        'admin_checked',
        'nedooformleno',
        'deviant',
        'created_at',
        'updated_at',
        'notation_formula'
    ];

    /**
     * Включает timestamp для Eloquent моделей
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Возвращает привязанную модель Actual
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function actual()
    {
        return $this->belongsTo('App\Models\Surdo\Actual', 'id_actual', 'id_actual');
    }

    /**
     * Возвращает привязанную модель Config
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function configBegin()
    {
        return $this->belongsTo('App\Models\Surdo\Config', 'id_conf_begin', 'id_conf');
    }

    /**
     * Возвращает привязанную модель Config
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function configEnd()
    {
        return $this->belongsTo('App\Models\Surdo\Config', 'id_conf_end', 'id_conf');
    }

    /**
     * Возвращает привязанную модель Config
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function configOffhandBegin()
    {
        return $this->belongsTo('App\Models\Surdo\Config', 'id_conf_offhand_begin', 'id_conf');
    }

    /**
     * Возвращает привязанную модель Config
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function configOffhandEnd()
    {
        return $this->belongsTo('App\Models\Surdo\Config', 'id_conf_offhand_end', 'id_conf');
    }

    /**
     * Возвращает привязанную модель Dialect
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dialect()
    {
        return $this->belongsTo('App\Models\Surdo\Dialect', 'id_dialect', 'id_dialect');
    }

    /**
     * Возвращает привязанную модель Jest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jestObraz()
    {
        return $this->belongsTo('App\Models\Surdo\Jest', 'id_jest_obraz', 'id_jest');
    }

    /**
     * Возвращает привязанную модель Jest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jestParadigm()
    {
        return $this->belongsTo('App\Models\Surdo\Jest', 'id_jest_paradigm', 'id_jest');
    }

    /**
     * Возвращает привязанную модель Location
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo('App\Models\Surdo\Location', 'id_location', 'id_location');
    }

    public function face()
    {
        return $this->belongsTo('App\Models\Surdo\Face', 'id_face', 'id_face');
    }

    public function hns_move()
    {
        return $this->belongsTo('App\Models\Surdo\HnsMove', 'id_hns_move', 'id_move');
    }

    public function orientation_body()
    {
        return $this->belongsTo('App\Models\Surdo\Orientation_body', 'id_orientation_body', 'id_orientation');
    }

    public function orientation_hand()
    {
        return $this->belongsTo('App\Models\Surdo\Orientation_hand', 'id_orientation_hand', 'id_orientation');
    }




    /**
     * Возвращает привязанную модель Move
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function move()
    {
        return $this->belongsTo('App\Models\Surdo\Movement', 'id_move', 'id_move');
    }

    /**
     * Возвращает привязанную модель Orientation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orientation()
    {
        return $this->belongsTo('App\Models\Surdo\Orientation', 'id_orient', 'id_orientation');
    }

    /**
     * Возвращает привязанную модель Style
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function style()
    {
        return $this->belongsTo('App\Models\Surdo\Style', 'id_style', 'id_style');
    }

    /**
     * Возвращает привязанную модель SymMarker
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function symMarker()
    {
        return $this->belongsTo('App\Models\Surdo\SymMarker', 'id_sym_marker', 'id_sym_marker');
    }

    /**
     * Возвращает привязанную модель Theme
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function theme()
    {
        return $this->belongsTo('App\Models\Surdo\Theme', 'id_tema', 'id_tema');
    }

    /**
     * Возвращает привязанную модель Vid
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vid()
    {
        return $this->belongsTo('App\Models\Surdo\Vid', 'id_vid', 'id_vid');
    }

    /**
     * Возвращает аналоги текущего Jest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function jestAnalogs()
    {
        return $this->belongsToMany('App\Models\Surdo\Jest', 'srd_surd_cross_analogs', 'id_jest', 'id_jest_analog');
    }

    /**
     * Возвращает все модели Bibliography привязанные к жесту
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function bibliographies()
    {
        return $this->belongsToMany('App\Models\Surdo\Bibliography', 'srd_surd_cross_bibliography', 'id_jest', 'id_bibliography')->where("id_bibliography_type", 1);
    }

    /**
     * Возвращает все модели Bibliography привязанные к жесту
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function bibliographies_source()
    {
        return $this->belongsToMany('App\Models\Surdo\Bibliography', 'srd_surd_cross_bibliography', 'id_jest', 'id_bibliography')->where("id_bibliography_type", 3);
    }

    /**
     * Возвращает все модели Bibliography привязанные к жесту
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function bibliographies_slovar()
    {
        return $this->belongsToMany('App\Models\Surdo\Bibliography', 'srd_surd_cross_bibliography', 'id_jest', 'id_bibliography')->where("id_bibliography_type", 2);
    }

    /**
     * Возвращает все модели Lexicon привязанные к жесту
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function lexicons()
    {
        return $this->belongsToMany('App\Models\Surdo\Lexicon', 'srd_surd_cross_lexicon', 'id_jest', 'id_lexicon');
    }

    /**
     * Возвращает все жесты, в состав которых, входит текущий жест
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jestSostavChild()
    {
        return $this->hasMany('App\Models\Surdo\Sostav', 'id_jest_child', 'id_jest');
    }

    /**
     * Возвращает жесты из которых состоит текущий жест
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jestSostav()
    {
        return $this->hasMany('App\Models\Surdo\Sostav', 'id_jest_master', 'id_jest')->orderBy('order_id');
    }

    /**
     * Возвращает слова, относящиеся к данному жесту
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function words()
    {
        return $this->belongsToMany('App\Models\Surdo\Word', 'srd_surd_cross_words', 'id_jest', 'id_word')->orderBy('word');
    }

    public function scopeOfFilter($query, $filter)
    {
        return $query->where(function ($q) use ($filter) {
                // Ключи значений из фильтра для подстановки в запрос where
                $keys = array_keys($filter);

                // Поочередно добавляем в запрос условие, для фильтра
                for ($index = 0; $index < count($filter); $index++)
                {
                    if (isset($filter[$keys[$index]]) && ($filter[$keys[$index]] !== null))
                    {
                        // При фильтре тем нужно брать несколько значений поля "Темы"
                        if ($keys[$index] == "id_tema")
                            $q->whereIn($keys[$index], $filter[$keys[$index]]);
                        else
                            $q->where($keys[$index], '=', $filter[$keys[$index]], 'and');
                    }
                }

                return $q;
            });
    }

    /**
     * Фильтрует по id_tema
     *
     * @param $query Builder
     * @param $id
     * @return Builder
     */
    public function scopeOfTheme($query, $id){
        return ($id === null) ? $query : $query->where('id_tema', '=', $id);
    }

    /**
     * Фильтрует по id_actual
     *
     * @param $query Builder
     * @param $id
     * @return Builder
     */
    public function scopeOfActuality($query, $id){
        return ($id === null) ? $query : $query->where('id_actual', '=', $id);
    }

    /**
     * Фильтрует по id_dialect
     *
     * @param $query Builder
     * @param $id
     * @return Builder
     */
    public function scopeOfDialect($query, $id){
        return ($id === null) ? $query : $query->where('id_dialect', '=', $id);
    }

    /**
     * Фильтрует по id_style
     *
     * @param $query Builder
     * @param $id
     * @return Builder
     */
    public function scopeOfStyle($query, $id){
        return ($id === null) ? $query : $query->where('id_style', '=', $id);
    }

    /**
     * Фильтрует по id_jest_obraz
     *
     * @param $query Builder
     * @param $id
     * @return Builder
     */
    public function scopeOfBaseObraz($query, $id){
        return ($id === null) ? $query : $query->where('id_jest_obraz', '=', $id);
    }

    /**
     * Осуществляет поиск жеста по его части
     *
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeSearch($query, $value)
    {
        return ($value === null) ? $query : $query->where('jest', 'like', "%$value%");
    }

    /**
     * Фильтрует по id_jest_paradigm
     *
     * @param $query Builder
     * @param $id
     * @return Builder
     */
    public function scopeOfParadigm($query, $id){
        return ($id === null) ? $query : $query->where('id_jest_paradigm', '=', $id);
    }

    /**
     * Фильтрует по id_vid
     *
     * @param $query Builder
     * @param $id
     * @return Builder
     */
    public function scopeOfVid($query, $id){
        return ($id === null) ? $query : $query->where('id_vid', '=', $id);
    }

    /**
     * Фильтрует по id_hand_double
     *
     * @param $query Builder
     * @param $bool
     * @return Builder
     */
    public function scopeOfHandDouble($query, $bool){
        return ($bool === null) ? $query : $query->where('hand_double', '=', $bool);
    }

    /**
     * Фильтрует по id_conf_begin
     *
     * @param $query Builder
     * @param $id
     * @return Builder
     */
    public function scopeOfBaseConfBegin($query, $id){
        return ($id === null) ? $query : $query->where('id_conf_begin', '=', $id);
    }

    /**
     * Фильтрует по id_conf_end
     *
     * @param $query Builder
     * @param $id
     * @return Builder
     */
    public function scopeOfBaseConfEnd($query, $id){
        return ($id === null) ? $query : $query->where('id_conf_end', '=', $id);
    }

    /**
     * Фильтрует по id_conf_offhand_begin
     *
     * @param $query Builder
     * @param $id
     * @return Builder
     */
    public function scopeOfBaseOffConfBegin($query, $id){
        return ($id === null) ? $query : $query->where('id_conf_offhand_begin', '=', $id);
    }

    /**
     * Фильтрует по id_conf_offhand_end
     *
     * @param $query Builder
     * @param $id
     * @return Builder
     */
    public function scopeOfBaseOffConfEnd($query, $id){
        return ($id === null) ? $query : $query->where('id_conf_offhand_end', '=', $id);
    }

    /**
     * @param $query
     * @param $id
     * @return mixed
     */
    public function scopeOfDeviant($query, $value) {
        return ($value === false) ? $query : $query->where('deviant', '=', $value);
    }
}
