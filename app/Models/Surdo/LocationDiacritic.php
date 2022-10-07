<?php

namespace App\Models\Surdo;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Surdo\LocationDiacritic
 *
 * @property int $id_loc_diacritics
 * @property string $loc_diacritics_notation
 * @property string|null $pic
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\Location[] $locations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\LocationDiacritic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\LocationDiacritic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\LocationDiacritic query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\LocationDiacritic whereIdLocDiacritics($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\LocationDiacritic whereLocDiacriticsNotation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\LocationDiacritic wherePic($value)
 * @mixin \Eloquent
 */
class LocationDiacritic extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'srd_hns_loc_diacritics';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_loc_diacritics';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['loc_diacritics_notation', 'pic'];

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
    public function locations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Surdo\Location', 'id_loc_diacritics', 'id_loc_diacritics');
    }
}
