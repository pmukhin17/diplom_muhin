<?php

namespace App\Models\Surdo;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Surdo\Movement
 *
 * @property int $id_move
 * @property string $move
 * @property int|null $id_movement
 * @property int|null $id_move_diacritics
 * @property string|null $pic
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\Jest[] $jests
 * @property-read \App\Models\Surdo\MovementDiacritic|null $movementDiacritic
 * @property-read \App\Models\Surdo\MovementNotation|null $movementNotation
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Movement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Movement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Movement query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Movement whereIdMove($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Movement whereIdMoveDiacritics($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Movement whereIdMovement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Movement whereMove($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Movement wherePic($value)
 * @mixin \Eloquent
 */
class Movement extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'srd_surd_move';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_move';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['id_movement', 'id_move_diacritics', 'move', 'pic'];

    /**
     * Отключает timestamp для Eloquent моделей
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Возвращает привязанную модель MovementDiacritic
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function movementDiacritic(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Surdo\MovementDiacritic', 'id_move_diacritics', 'id_move_diacritics');
    }

    /**
     * Возвращает привязанную модель MovementNotation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function movementNotation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Surdo\MovementNotation', 'id_movement', 'id_movement');
    }

    /**
     * Возвращает все жесты, содержащие этот объект
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Surdo\Jest', 'id_move', 'id_move');
    }
}
