<?php

namespace App\Models\Surdo;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Surdo\Config
 *
 * @property int $id_conf
 * @property string $base_conf
 * @property int|null $id_config_notation
 * @property int|null $id_thumbmode
 * @property int|null $id_fingersmode
 * @property int|null $id_finger_collide1
 * @property int|null $id_finger_collide2
 * @property int|null $id_finger_collide3
 * @property string|null $pic
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\Jest[] $configBeginJests
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\Jest[] $configEndJests
 * @property-read \App\Models\Surdo\ConfigNotation|null $configNotation
 * @property-read \App\Models\Surdo\FingerCollide|null $fingerCollide1
 * @property-read \App\Models\Surdo\FingerCollide|null $fingerCollide2
 * @property-read \App\Models\Surdo\FingerCollide|null $fingerCollide3
 * @property-read \App\Models\Surdo\Fingersmode|null $fingersmode
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\Jest[] $offhandBeginJests
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\Jest[] $offhandEndJests
 * @property-read \App\Models\Surdo\Thumbmode|null $thumbmode
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Config newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Config newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Config query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Config whereBaseConf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Config whereIdConf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Config whereIdConfigNotation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Config whereIdFingerCollide1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Config whereIdFingerCollide2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Config whereIdFingerCollide3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Config whereIdFingersmode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Config whereIdThumbmode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Config wherePic($value)
 * @mixin \Eloquent
 */
class Config extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'srd_surd_conf';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_conf';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['id_config_notation', 'id_thumbmode', 'id_fingersmode', 'id_finger_collide1', 'id_finger_collide2', 'id_finger_collide3', 'base_conf', 'pic'];

    /**
     * Отключает timestamp для Eloquent моделей
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Возвращает привязанный объект из таблицы "srd_hns_config_notation"
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function configNotation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Surdo\ConfigNotation', 'id_config_notation', 'id_config_notation');
    }

    /**
     * Возвращает привязанный объект из таблицы "srd_hns_fingercollide"
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fingerCollide1(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Surdo\FingerCollide', 'id_finger_collide1', 'id_fingercollide');
    }

    /**
     * Возвращает привязанный объект из таблицы "srd_hns_fingercollide"
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fingerCollide2(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Surdo\FingerCollide', 'id_finger_collide2', 'id_fingercollide');
    }

    /**
     * Возвращает привязанный объект из таблицы "srd_hns_fingercollide"
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fingerCollide3(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Surdo\FingerCollide', 'id_finger_collide3', 'id_fingercollide');
    }

    /**
     * Возвращает привязанный объект из таблицы "srd_hns_fingersmode"
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fingersmode(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Surdo\Fingersmode', 'id_fingersmode', 'id_fingersmode');
    }

    /**
     * Возвращает привязанный объект из таблицы "srd_hns_thumbmode"
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thumbmode(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Surdo\Thumbmode', 'id_thumbmode', 'id_thumbmode');
    }

    /**
     * Возвращает все жесты с такими же полями "id_conf_begin" в "srd_surd_jest"
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function configBeginJests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Surdo\Jest', 'id_conf_begin', 'id_conf');
    }

    /**
     * Возвращает все жесты с такими же полями "id_conf_end" в "srd_surd_jest"
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function configEndJests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Surdo\Jest', 'id_conf_end', 'id_conf');
    }

    /**
     * Возвращает все жесты с такими же полями "id_conf_offhand_begin" в "srd_surd_jest"
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function offhandBeginJests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Surdo\Jest', 'id_conf_offhand_begin', 'id_conf');
    }

    /**
     * Возвращает все жесты с такими же полями "id_conf_offhand_end" в "srd_surd_jest"
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function offhandEndJests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Surdo\Jest', 'id_conf_offhand_end', 'id_conf');
    }
}
