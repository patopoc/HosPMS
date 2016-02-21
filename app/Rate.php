<?php

namespace Hotpms;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $table= "rates";
    
    public $timestamps= false;
    
    protected $fillable= ['name','weekday_price','weekend_price'];
}
