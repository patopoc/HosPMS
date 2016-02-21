<?php

namespace Hospms;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table= "services";
    
    public $timestamps= false;
    
    protected $fillable= ['name','price'];
}
