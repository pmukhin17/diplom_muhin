<?php


namespace App\Models\Surdo;


use Illuminate\Database\Eloquent\Model;

class HnsMove extends Model
{
    protected $table = 'srd_hns_move';

    protected $primaryKey = 'id_move';

    protected $fillable = ['name_move', 'pic'];

    public $timestamps = false;

}
