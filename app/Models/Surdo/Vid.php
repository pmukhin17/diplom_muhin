<?php

namespace App\Models\Surdo;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Surdo\Vid
 *
 * @property int $id_vid
 * @property string $vid
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\Jest[] $jests
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Vid newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Vid newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Vid query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Vid whereIdVid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Vid whereVid($value)
 * @mixin \Eloquent
 */
class Vid extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'srd_surd_vid';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_vid';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['vid'];

    /**
     * Отключает timestamp для Eloquent моделей
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Возвращает все жесты этого вида (модель Vid)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Surdo\Jest', 'id_vid', 'id_vid');
    }
}
