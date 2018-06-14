<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Users extends ResourceCollection
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
        'name' => $this->name,
        'remember_token' => $this->remember_token,
        'email' => $this->email,
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at,
        'role' => $this->role,
                    
        ]; 
    }
}

