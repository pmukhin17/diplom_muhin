<?php

namespace App\Models\Surdo;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Surdo\Location
 *
 * @property int $id_location
 * @property int $id_location_notation
 * @property int $id_loc_diacritics
 * @property string|null $pic
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\Jest[] $jests
 * @property-read \App\Models\Surdo\LocationDiacritic $locationDiacritic
 * @property-read \App\Models\Surdo\LocationNotation $locationNotation
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Location newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Location newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Location query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Location whereIdLocDiacritics($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Location whereIdLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Location whereIdLocationNotation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Location wherePic($value)
 * @mixin \Eloquent
 */
class Location extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'srd_hns_location';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_location';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['name_location','id_location_notation', 'id_loc_diacritics', 'pic'];

    /**
     * Отключает timestamp для Eloquent моделей
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Возвращает привязанную модель LocationDiacritic
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function locationDiacritic(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Surdo\LocationDiacritic', 'id_loc_diacritics', 'id_loc_diacritics');
    }

    /**
     * Возвращает привязанную модель LocationNotation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function locationNotation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Surdo\LocationNotation', 'id_location_notation', 'id_location_notation');
    }

    /**
     * Возвращает все модели с текущим Location
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Surdo\Jest', 'id_location', 'id_location');
    }
}
