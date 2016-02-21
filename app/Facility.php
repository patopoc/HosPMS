<?php

namespace Hotpms;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $table= "facilities";
    
    public $timestamps= false;
    
    protected $fillable= ['name','description'];
}
