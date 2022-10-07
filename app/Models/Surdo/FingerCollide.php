<?php

namespace App\Models\Surdo;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Surdo\FingerCollide
 *
 * @property int $id_fingercollide
 * @property int $id_finger1
 * @property int $id_finger2
 * @property int $id_fingercollide_not
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\Config[] $configsWithFingerCollide1
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\Config[] $configsWithFingerCollide2
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\Config[] $configsWithFingerCollide3
 * @property-read \App\Models\Surdo\FingerCollideNotation $fingcollideNotation
 * @property-read \App\Models\Surdo\Finger $finger1
 * @property-read \App\Models\Surdo\Finger $finger2
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\FingerCollide newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\FingerCollide newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\FingerCollide query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\FingerCollide whereIdFinger1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\FingerCollide whereIdFinger2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\FingerCollide whereIdFingercollide($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\FingerCollide whereIdFingercollideNot($value)
 * @mixin \Eloquent
 */
class FingerCollide extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'srd_hns_fingercollide';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_fingercollide';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['id_finger1', 'id_finger2', 'id_fingercollide_not'];

    /**
     * Возвращает привязанный объект из таблицы "srd_hns_fingers"
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function finger1(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Surdo\Finger', 'id_finger1', 'id_finger');
    }

    /**
     * Возвращает привязанный объект из таблицы "srd_hns_fingers"
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function finger2(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Surdo\Finger', 'id_finger2', 'id_finger');
    }

    /**
     * Отключает timestamp для Eloquent моделей
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Возвращает привязанный объект из таблицы "srd_hns_fingcollide_not"
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fingcollideNotation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Surdo\FingerCollideNotation', 'id_fingercollide_not', 'id_fingercollide_not');
    }

    /**
     * Возвращает все записи таблицы "srd_surd_conf", где в столбце "id_finger_collide1" содержится данный объект
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function configsWithFingerCollide1(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Surdo\Config', 'id_finger_collide1', 'id_fingercollide');
    }

    /**
     * Возвращает все записи таблицы "srd_surd_conf", где в столбце "id_finger_collide2" содержится данный объект
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function configsWithFingerCollide2(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Surdo\Config', 'id_finger_collide2', 'id_fingercollide');
    }

    /**
     * Возвращает все записи таблицы "srd_surd_conf", где в столбце "id_finger_collide3" содержится данный объект
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function configsWithFingerCollide3(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Surdo\Config', 'id_finger_collide3', 'id_fingercollide');
    }
}
