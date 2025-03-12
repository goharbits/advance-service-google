<?php

namespace App\Http\Resources\Task;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskCollection extends ResourceCollection
{

    public function toArray($request)
    {

      return  $this->collection->map(function ($row) {
           $small_title = initials($row->project->title);

            return [
                'id' => @$row->id,
                'title' => @$row->title,
                'color' => @$row->color,
                'description' => @$row->description,
                'priority'=> @$row->priority,
                'small_title'=> @$small_title,
                  ];
        })->all();
    }
}