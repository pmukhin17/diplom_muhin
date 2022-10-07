<?php


namespace App\Models\Surdo;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Surdo\Synsets
 *
 * @property int $synset_id
 * @property string $ruthes_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\Jest[] $jests
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Synsets newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Synsets newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Synsets query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Synsets whereSynsets($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Synsets whereIdSynsets($value)
 * @mixin \Eloquent
 */


class Synsets extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tez_synsets';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'synset_id';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['ruthes_name','definit'];

    /**
     * Отключает timestamp для Eloquent моделей
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * Возвращает список жестов, где используется данный объект данных
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function jests(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany('App\Models\Surdo\JestConcept', 'tez_cross_jest_to_concept', 'synset_id', 'id_jest');
    }

    public function scopeSearch($query, $value)
    {
        return ($value === null) ? $query : $query->where('synset_id', 'like', "$value");
    }



}
