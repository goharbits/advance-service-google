<?php

namespace App\Http\Resources\Project;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProjectCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {

        return $this->collection->map(function ($row) {
            return [
                'id' => $row->id,
                'title' => $row->title,
                'description' => $row->description,
                  ];
        })->all();
    }
}