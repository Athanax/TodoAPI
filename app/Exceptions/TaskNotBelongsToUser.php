<?php

namespace App\Exceptions;

use Exception;

class TaskNotBelongsToUser extends Exception
{
    //
    public function render(){
        return response()->json([
            'errors'=>'Task does not belong to this user'
        ]);
    }
}
