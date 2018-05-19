<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Anime extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       return [
                  'id' => $this->id,
                    'titolo' => $this->title,
                   'trama'=> $this->body,
                   'autore' => $this->stagioni,
            'img' => $this->img,
                    
            ]; 
    }
}
