<?php

namespace Hotpms;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    
    protected $fillable = ['id_person', 'id_role', 'default_property', 'auth_key', 'username', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    
    public $timestamps= false;
    
    public function person(){
    	return $this->hasOne('Hotpms\Person', 'id', 'id_person');
    }
    
    public function role(){
    	return $this->hasOne('Hotpms\Role', 'id', 'id_role');
    }
    
    public function properties(){
    	return $this->belongsToMany('Hotpms\Property', 'user_assigned_properties', 'id_user', 'id_property');
    }
    
    public function setPasswordAttribute($value){
    	if( ! empty($value) ){
    		$this->attributes['password']= bcrypt($value);
    	}
    }
    
    public function isAdmin(){
    	return $this->role->name === 'admin';
    }
    
    public function isUser(){
    	return $this->role->name === 'user';
    }
    
    
}
