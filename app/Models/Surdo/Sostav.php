<?php

namespace App\Models\Surdo;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Surdo\Sostav
 *
 * @property int $id_jest_master
 * @property int $id_jest_child
 * @property int $order_id
 * @property-read \App\Models\Surdo\Jest $jestChild
 * @property-read \App\Models\Surdo\Jest $jestMaster
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Sostav newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Sostav newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Sostav query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Sostav whereIdJestChild($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Sostav whereIdJestMaster($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Sostav whereOrderId($value)
 * @mixin \Eloquent
 */
class Sostav extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'srd_surd_cross_sostav';

    protected $primaryKey = 'id_jest_child';

    /**
     * @var array
     */
    protected $fillable = ['id_jest_master', 'id_jest_child', 'order_id'];

    /**
     * Отключает timestamp для Eloquent моделей
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Возвращает дочерний жест
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jestChild(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Surdo\Jest', 'id_jest_child', 'id_jest');
    }

    /**
     * Возвращает главный жест
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jestMaster(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Surdo\Jest', 'id_jest_master', 'id_jest');
    }
}
