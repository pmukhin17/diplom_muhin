<?php

namespace App\Models\Surdo;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Surdo\FingerCollideNotation
 *
 * @property integer $id_fingercollide_not
 * @property string $fingercollide_notation
 * @property string $pic
 * @property SrdHnsFingercollide[] $srdHnsFingercollides
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\FingerCollide[] $fingerCollides
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\FingerCollideNotation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\FingerCollideNotation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\FingerCollideNotation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\FingerCollideNotation whereFingercollideNotation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\FingerCollideNotation whereIdFingercollideNot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\FingerCollideNotation wherePic($value)
 * @mixin \Eloquent
 */
class FingerCollideNotation extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'srd_hns_fingcollide_not';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_fingercollide_not';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['fingercollide_notation', 'pic'];

    /**
     * Отключает timestamp для Eloquent моделей
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Возвращает все записи таблицы "srd_hns_fingercollide", где в столбце "id_fingercollide_not" содержится данный объект
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fingerCollides(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Surdo\FingerCollide', 'id_fingercollide_not', 'id_fingercollide_not');
    }
}
