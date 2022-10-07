<?php

namespace App\Models\Surdo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * App\Models\Surdo\Word
 *
 * @property int $id_word
 * @property string $word
 * @property int $deviant
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\Jest[] $jests
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Word newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Word newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Word query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Word whereDeviant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Word whereIdWord($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Word whereWord($value)
 * @mixin \Eloquent
*/
class Word extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $casts = [
        'deviant'   => 'int',
    ];
    protected $table = 'srd_surd_words';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_word';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['word', 'deviant'];

    /**
     * Отключает timestamp для Eloquent моделей
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Возвращает все жесты с этими словами (модель Word)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function jests()
    {
        return $this->belongsToMany('App\Models\Surdo\Jest', 'srd_surd_cross_words', 'id_word', 'id_jest');
    }

    /**
     * Осуществляет поиск слова по его части
     *
     * @param $query Builder
     * @param $value string
     * @return Builder
     */
    public function scopeSearch($query, $value)
    {
        return ($value === null) ? $query : $query->where('word', 'like', "%$value%");
    }

    public function scopeSearch_id($query, $value)
    {
        return ($value === null) ? $query : $query->where('id_word', 'like', "$value");
    }

    /**
     * Фильтрует данные по основным полям
     * Поля:
     *    $filter = [
     *        'id_style' => $request->input('id_style'),
     *        'id_dialect' => $request->input('id_dialect'),
     *        'id_tema' =>  $request->input('id_tema'),
     *        'id_actual' => $request->input('id_actual'),
     *        'id_jest_obraz' => $request->input('id_jest_obraz'),
     *        'id_jest_paradigm' => $request->input('id_jest_paradigm'),
     *        'id_vid' => $request->input('id_vid'),
     *        'hand_double' => $request->input('hand_double'),
     *        'id_conf_begin' => $request->input('id_conf_begin'),
     *        'id_conf_end' => $request->input('id_conf_end'),
     *        'id_off_conf_begin' => $request->input('id_off_conf_begin'),
     *        'id_off_conf_end' => $request->input('id_off_conf_end')
     *   ];
     *
     * @param $query \Illuminate\Database\Eloquent\Builder
     * @param $filter array
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfFilter($query, $filter)
    {
        return $query->whereHas('jests', function ($q) use ($filter) {
            $q->where(function ($query) use ($filter) {
                // Ключи значений из фильтра для подстановки в запрос where
                $keys = array_keys($filter);

                // Поочередно добавляем в запрос условие, для фильтра
                for ($index = 0; $index < count($filter); $index++)
                {
                    if (isset($filter[$keys[$index]]) && ($filter[$keys[$index]] !== null))
                        $query->where($keys[$index], '=', $filter[$keys[$index]], 'and');
                }

                return $query;
            });
        });
    }

    /**
     * Возвращает только проверенные админом
     *
     * @param $query Builder
     * @param $id
     * @return Builder
     */
    public function scopeAdminChecked($query)
    {
        return $query->whereHas('jests', function ($q) {
            $q->where('admin_checked', '=', 1);
        });
    }
}
