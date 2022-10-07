<?php

namespace App\Models\Surdo;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Surdo\OrientationNotation
 *
 * @property int $id_orientation_not
 * @property string $orientation_notation
 * @property string|null $pic
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\Orientation[] $orientations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\OrientationNotation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\OrientationNotation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\OrientationNotation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\OrientationNotation whereIdOrientationNot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\OrientationNotation whereOrientationNotation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\OrientationNotation wherePic($value)
 * @mixin \Eloquent
 */
class OrientationNotation extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'srd_hns_orientation_not';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_orientation_not';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['orientation_notation', 'pic'];

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
        return $this->hasMany('App\Models\Surdo\Orientation', 'id_orientation_not', 'id_orientation_not');
    }
}
