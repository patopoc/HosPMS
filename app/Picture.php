<?php

namespace Hotpms;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $table= "pictures";
    
    public $timestamps= false;
    
    protected $fillable= ['url','id_module','type'];
}
