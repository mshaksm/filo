<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Post extends Model
{

    //Table Name
    protected $table = 'posts';
    //Primary key
    public $primaryKey = 'id';
    //TimeStamps
    public $timestamps = true;

    public function user(){
        return $this->belongsto('App\User');
    }
}
