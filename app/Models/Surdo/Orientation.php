<?php

namespace App\Models\Surdo;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Surdo\Orientation
 *
 * @property int $id_orientation
 * @property int $id_orientation_not
 * @property int $id_orient_diacritics
 * @property string|null $pic
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\Jest[] $jests
 * @property-read \App\Models\Surdo\OrientationDiacritic $orientationDiacritic
 * @property-read \App\Models\Surdo\OrientationNotation $orientationNotation
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Orientation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Orientation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Orientation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Orientation whereIdOrientDiacritics($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Orientation whereIdOrientation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Orientation whereIdOrientationNot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Orientation wherePic($value)
 * @mixin \Eloquent
 */
class Orientation extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'srd_hns_orientation';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_orientation';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['id_orientation_not', 'id_orient_diacritics', 'pic'];

    /**
     * Отключает timestamp для Eloquent моделей
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Возвращает привязанную модель OrientationDiacritic
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orientationDiacritic(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Surdo\OrientationDiacritic', 'id_orient_diacritics', 'id_orient_diacritics');
    }

    /**
     * Возвращает привязанную модель OrientationNotation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orientationNotation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Surdo\OrientationNotation', 'id_orientation_not', 'id_orientation_not');
    }

    /**
     * Возвращает все жесты, содержащие этот объект
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Surdo\Jest', 'id_orient', 'id_orientation');
    }
}
