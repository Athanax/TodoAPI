<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $fillable=[
        'name','user_id','description','complete'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
