<?php

namespace App\Models\Surdo;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Surdo\ConfigNotation
 *
 * @property int $id_config_notation
 * @property string $config_notation
 * @property string|null $pic
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\Config[] $configs
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\ConfigNotation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\ConfigNotation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\ConfigNotation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\ConfigNotation whereConfigNotation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\ConfigNotation whereIdConfigNotation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\ConfigNotation wherePic($value)
 * @mixin \Eloquent
 */
class ConfigNotation extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'srd_hns_config_notation';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_config_notation';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['config_notation', 'pic'];

    /**
     * Отключает timestamp для Eloquent моделей
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Возвращает все строки из таблицы "srd_surd_conf", где содержиться данный объект
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function configs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Surdo\Config', 'id_config_notation', 'id_config_notation');
    }
}
