<?php

namespace App\Models\Surdo;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Surdo\Dialect
 *
 * @property int $id_dialect
 * @property string $dialect
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\Jest[] $jests
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Dialect newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Dialect newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Dialect query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Dialect whereDialect($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Dialect whereIdDialect($value)
 * @mixin \Eloquent
 */
class Dialect extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'srd_surd_dialect';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_dialect';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['dialect'];

    /**
     * Отключает timestamp для Eloquent моделей
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Возвращает все жесты с данным диалектом
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Surdo\Jest', 'id_dialect', 'id_dialect');
    }
}
