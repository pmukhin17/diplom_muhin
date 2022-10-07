<?php

namespace App\Models\Surdo;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Surdo\Style
 *
 * @property int $id_style
 * @property string $style
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\Jest[] $jests
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Style newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Style newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Style query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Style whereIdStyle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Style whereStyle($value)
 * @mixin \Eloquent
 */
class Style extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'srd_surd_style';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_style';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['style'];

    /**
     * Отключает timestamp для Eloquent моделей
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Возвращает все жесты с этим стилем (модель Style)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Surdo\Jest', 'id_style', 'id_style');
    }
}
