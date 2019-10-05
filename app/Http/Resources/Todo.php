<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Todo extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return[
          'id' => $this->id,
          'titulo' => $this->titulo,
          'descripcion' => $this->descripcion,
          'estado' => $this->estado
        ];
    }

    public function with($request)
    {
      return[
        'version' => '1.0.0',
        'author_url'=> url('https://linkedin.com/in/humberto-gonzalez-5a1b39aa/')
      ];
    }
}
