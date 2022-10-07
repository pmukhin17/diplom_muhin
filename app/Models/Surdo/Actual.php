<?php

namespace App\Models\Surdo;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Surdo\Actual
 *
 * @property int $id_actual
 * @property string $actual
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\Jest[] $jests
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Actual newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Actual newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Actual query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Actual whereActual($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Actual whereIdActual($value)
 * @mixin \Eloquent
 */
class Actual extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'srd_surd_actual';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_actual';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['actual'];

    /**
     * Отключает timestamp для Eloquent моделей
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Возвращает все жесты с текущим объектом данных
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Surdo\Jest', 'id_actual', 'id_actual');
    }
}
