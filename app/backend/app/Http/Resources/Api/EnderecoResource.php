<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class EnderecoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "cep" => $this->cep,
            "logradouro" => $this->logradouro,
            "numero" => $this->numero,
            "complemento" => $this->complemento,
            "bairro" => $this->bairro,
            "cidade" => $this->cidade,
            "uf" => $this->uf,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}
