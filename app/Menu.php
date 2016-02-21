<?php

namespace Hotpms;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model 
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'menu';
    
    protected $fillable = ['name','description','icon','route','type','id_module','action','id_section'];    
    
    public $timestamps= false;
}
