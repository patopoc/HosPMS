<?php

namespace Hotpms;

use Illuminate\Database\Eloquent\Model;

class RoomPicture extends Model
{
    protected $table= "room_pictures";
    
    public $timestamps= false;
    
    protected $fillable= ['url','id_room_types'];
}
