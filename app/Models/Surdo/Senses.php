<?php


namespace App\Models\Surdo;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Surdo\Senses
 *
 * @property int $sense_id
 * @property string $sense_name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Senses newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Senses newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Senses query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Senses whereSense($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Senses whereIdSense($value)
 * @mixin \Eloquent
 */

class Senses extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tez_senses';
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'sense_id';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';
    /**
     * @var array
     */
    protected $fillable = ['synset_id','sense_name'];
    /**
     * Отключает timestamp для Eloquent моделей
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * Возвращает понятие
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function synsets()
    {
        return $this->belongsTo('App\Models\Surdo\Synsets', 'tez_synsets', 'synset_id', 'synset_id');
    }

    public function scopeSearch($query, $value)
    {
        return ($value === null) ? $query : $query->where('sense_name', 'like', "$value");
    }

}
