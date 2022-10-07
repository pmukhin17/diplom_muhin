<?php

namespace App\Models\Surdo;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Surdo\Fingersmode
 *
 * @property int $id_fingersmode
 * @property string $fingersmode_notation
 * @property string|null $pic
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\Config[] $configs
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Fingersmode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Fingersmode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Fingersmode query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Fingersmode whereFingersmodeNotation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Fingersmode whereIdFingersmode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Fingersmode wherePic($value)
 * @mixin \Eloquent
 */
class Fingersmode extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'srd_hns_fingersmode';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_fingersmode';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['fingersmode_notation', 'pic'];

    /**
     * Отключает timestamp для Eloquent моделей
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Возвращает все записи таблицы "srd_hns_config", где в столбце "id_fingersmode" содержится данный объект
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function configs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Surdo\Config', 'id_fingersmode', 'id_fingersmode');
    }
}
