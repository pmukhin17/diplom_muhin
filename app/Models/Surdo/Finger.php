<?php

namespace App\Models\Surdo;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Surdo\Finger
 *
 * @property int $id_finger
 * @property string $finger_notation
 * @property string|null $pic
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\FingerCollide[] $fingerCollidesToFinger1
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\FingerCollide[] $fingerCollidesToFinger2
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Finger newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Finger newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Finger query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Finger whereFingerNotation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Finger whereIdFinger($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Finger wherePic($value)
 * @mixin \Eloquent
 */
class Finger extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'srd_hns_fingers';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_finger';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['finger_notation', 'pic'];

    /**
     * Отключает timestamp для Eloquent моделей
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Возвращает все записи таблицы "srd_hns_fingercollide", где в столбце "id_finger1" содержится данный объект
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fingerCollidesToFinger1(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Surdo\FingerCollide', 'id_finger1', 'id_finger');
    }

    /**
     * Возвращает все записи таблицы "srd_hns_fingercollide", где в столбце "id_finger2" содержится данный объект
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fingerCollidesToFinger2(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Surdo\FingerCollide', 'id_finger2', 'id_finger');
    }
}
