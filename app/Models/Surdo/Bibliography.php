<?php

namespace App\Models\Surdo;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Surdo\Bibliography
 *
 * @property int $id_bibliography
 * @property string $bibliography
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Surdo\Jest[] $jests
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Bibliography newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Bibliography newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Bibliography query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Bibliography whereBibliography($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Surdo\Bibliography whereIdBibliography($value)
 * @mixin \Eloquent
 */
class Bibliography extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'srd_surd_bibliography';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_bibliography';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['bibliography', 'id_bibliography_type'];

    /**
     * Отключает timestamp для Eloquent моделей
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Возвращает список жестов, где используется данный объект данных
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function jests(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany('App\Models\Surdo\Jest', 'srd_surd_cross_bibliography', 'id_bibliography', 'id_jest');
    }

    /**
     * Возвращает тип библиографии
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bibliography_type()
    {
        return $this->belongsTo('App\Models\Surdo\BibliographyType', 'srd_surd_bibliography_type', 'id_bibliography_type', 'id_bibliography_type');
    }

    public function scopeSearch($query, $value)
    {
        return ($value === null) ? $query : $query->where('bibliography', 'like', "%$value%");
    }
}
