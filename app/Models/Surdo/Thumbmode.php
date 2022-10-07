<?php

namespace App\Models\Surdo;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Surdo\Thumbmode
 *
 * @property int $id_thumbmode
 * @property string $thumbmode_notation
 * @property string|null $pic
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\Config[] $configs
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Thumbmode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Thumbmode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Thumbmode query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Thumbmode whereIdThumbmode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Thumbmode wherePic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Thumbmode whereThumbmodeNotation($value)
 * @mixin \Eloquent
 */
class Thumbmode extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'srd_hns_thumbmode';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_thumbmode';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['thumbmode_notation', 'pic'];

    /**
     * Отключает timestamp для Eloquent моделей
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Возвращает все конфигурации с этим объектом (модель Thumbmode)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function configs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Surdo\Config', 'id_thumbmode', 'id_thumbmode');
    }
}
