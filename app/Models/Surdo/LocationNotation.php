<?php

namespace App\Models\Surdo;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Surdo\LocationNotation
 *
 * @property integer $id_location_notation
 * @property string $location_notation
 * @property string $pic
 * @property SrdHnsLocation[] $srdHnsLocations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\Location[] $location
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\LocationNotation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\LocationNotation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\LocationNotation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\LocationNotation whereIdLocationNotation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\LocationNotation whereLocationNotation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\LocationNotation wherePic($value)
 * @mixin \Eloquent
 */
class LocationNotation extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'srd_hns_location_not';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_location_notation';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['location_notation', 'pic'];

    /**
     * Отключает timestamp для Eloquent моделей
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Возвращает все Location, содержащие этот объект
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function location(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Surdo\Location', 'id_location_notation', 'id_location_notation');
    }
}
