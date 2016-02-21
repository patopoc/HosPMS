<?php

namespace Hotpms;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class RoleDetail extends Model
{    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'role_detail';
    
    public $timestamps= false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','id_role','id_module','mod_show', 'mod_insert', 'mod_update','mod_delete'];
    
    public function module(){
    	return $this->hasOne('Hotpms\Module','id','id_module');
    }

}
