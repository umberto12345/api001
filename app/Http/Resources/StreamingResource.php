<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StreamingResource extends JsonResource
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
            'titolo' => $this->titolo,
            'episodi' => $this->episodi,
            'autore' => $this->autore,
            'img' => $this->img,
        ];
    }
}
