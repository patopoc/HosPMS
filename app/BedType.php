<?php

namespace Hotpms;

use Illuminate\Database\Eloquent\Model;

class BedType extends Model
{
    protected $table= "bed_types";
    
    public $timestamps= false;
    
    protected $fillable= ['type'];
}
