<?php

namespace App\Models\Surdo;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Surdo\MovementDiacritic
 *
 * @property int $id_move_diacritics
 * @property string $move_diacritics_notation
 * @property string|null $pic
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\Movement[] $movements
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\MovementDiacritic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\MovementDiacritic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\MovementDiacritic query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\MovementDiacritic whereIdMoveDiacritics($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\MovementDiacritic whereMoveDiacriticsNotation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\MovementDiacritic wherePic($value)
 * @mixin \Eloquent
 */
class MovementDiacritic extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'srd_hns_move_diacritics';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_move_diacritics';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['move_diacritics_notation', 'pic'];

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
    public function movements(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Surdo\Movement', 'id_move_diacritics', 'id_move_diacritics');
    }
}
