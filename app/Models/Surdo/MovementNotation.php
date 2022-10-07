<?php

namespace App\Models\Surdo;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Surdo\MovementNotation
 *
 * @property int $id_movement
 * @property string $movement_notation
 * @property string|null $pic
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\Movement[] $movements
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\MovementNotation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\MovementNotation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\MovementNotation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\MovementNotation whereIdMovement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\MovementNotation whereMovementNotation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\MovementNotation wherePic($value)
 * @mixin \Eloquent
 */
class MovementNotation extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'srd_hns_move_not';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_movement';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['movement_notation', 'pic'];

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
        return $this->hasMany('App\Models\Surdo\Movement', 'id_movement', 'id_movement');
    }
}
