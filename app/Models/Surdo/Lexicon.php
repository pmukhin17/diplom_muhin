<?php

namespace App\Models\Surdo;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Surdo\Lexicon
 *
 * @property integer $id_lexicon
 * @property string $lexicon
 * @property SrdSurdJest[] $srdSurdJests
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\Jest[] $jests
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Lexicon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Lexicon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Lexicon query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Lexicon whereIdLexicon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Lexicon whereLexicon($value)
 * @mixin \Eloquent
 */
class Lexicon extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'srd_surd_lexicon';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_lexicon';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['lexicon'];

    /**
     * Отключает timestamp для Eloquent моделей
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Возвращает все жесты, привязанные к этому лексикону
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function jests(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany('App\Models\Surdo\Jest', 'srd_surd_cross_lexicon', 'id_lexicon', 'id_jest');
    }
}
