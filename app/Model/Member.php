<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class member extends Model
{
    //
    protected $primaryKey='uid';
    protected $table='member';
    public $timestamps=false;
    protected $guarded=[];


    public function demands()
    {
        return $this->hasMany(Demand_list::Class,'uid');
    }
}
