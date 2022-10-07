<?php

namespace App\Models\Surdo;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Surdo\OrientationDiacritic
 *
 * @property int $id_orient_diacritics
 * @property string $orient_diacritics_notation
 * @property string|null $pic
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\Orientation[] $orientations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\OrientationDiacritic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\OrientationDiacritic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\OrientationDiacritic query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\OrientationDiacritic whereIdOrientDiacritics($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\OrientationDiacritic whereOrientDiacriticsNotation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\OrientationDiacritic wherePic($value)
 * @mixin \Eloquent
 */
class OrientationDiacritic extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'srd_hns_orient_diacritics';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_orient_diacritics';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['orient_diacritics_notation', 'pic'];

    /**
     * Отключает timestamp для Eloquent моделей
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Возвращает все Orientation, содержащие этот объект
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orientations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Surdo\Orientation', 'id_orient_diacritics', 'id_orient_diacritics');
    }
}
