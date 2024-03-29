<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
// use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'complete'=>$this->complete,
            'href'=>[
                'link'=>route('tasks.show', $this->id)
            ]
        ];
    }
}
