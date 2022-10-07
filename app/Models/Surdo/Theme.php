<?php

namespace App\Models\Surdo;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Surdo\Theme
 *
 * @property int $id_tema
 * @property int|null $asset_id
 * @property int|null $access_id
 * @property int $state
 * @property string $value
 * @property int $parent_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\Jest[] $jests
 * @property-read \App\Models\Surdo\Theme $parentTheme
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Theme newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Theme newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Theme query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Theme whereAccessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Theme whereAssetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Theme whereIdTema($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Theme whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Theme whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Theme whereValue($value)
 * @mixin \Eloquent
 */
class Theme extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'srd_surd_tema';
    protected $casts = [
    'asset_id'   => 'int',
    'access_id'   => 'int',
    'state'   => 'int',
    'parent_id'   => 'int',
    'nedooformleno'   => 'int',
    'admin_checked'   => 'int',
    'id_jest_paradigm'   => 'int',
    'id_jest_obraz'   => 'int',
    'id_vid'   => 'int',
    'id_dialect'   => 'int',
    'id_actual'   => 'int',
    'id_move'   => 'int',
    'id_tema'   => 'int',
    'id_conf_begin'   => 'int',
    'id_conf_end'   => 'int',
    'id_conf_offhand_begin'   => 'int',
    'id_conf_offhand_end'   => 'int',
    'id_location'   => 'int',
    'id_orient'   => 'int',
    'id_sym_marker'   => 'int',
];

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_tema';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['parent_id', 'asset_id', 'access_id', 'state', 'value'];

    /**
     * Отключает timestamp для Eloquent моделей
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Возвращает родительскую тему
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parentTheme(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Surdo\Theme', 'parent_id', 'id_tema');
    }

    /**
     * Возвращает все жесты с этой темой (модель Theme)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Surdo\Jest', 'id_tema', 'id_tema');
    }
}
