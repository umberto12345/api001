<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AnimeLike extends ResourceCollection
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
                   'id' => $this->id,
        'id_users' => $this->user,
        'id_anime' => $this->anime,
      
                    
            ]; 
    }
}
