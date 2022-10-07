<?php

namespace App\Models\Surdo;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Surdo\SymMarker
 *
 * @property int $id_sym_marker
 * @property string $sym_marker
 * @property string|null $pic
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\Jest[] $jests
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\SymMarker newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\SymMarker newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\SymMarker query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\SymMarker whereIdSymMarker($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\SymMarker wherePic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\SymMarker whereSymMarker($value)
 * @mixin \Eloquent
 */
class SymMarker extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'srd_hns_sym_marker';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_sym_marker';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['sym_marker', 'pic'];

    /**
     * Отключает timestamp для Eloquent моделей
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Возвращает все жесты с этим объектом (модель SymMarker)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Surdo\Jest', 'id_sym_marker', 'id_sym_marker');
    }
}
