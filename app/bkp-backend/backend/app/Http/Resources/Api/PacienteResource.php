<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\EnderecoResource;
use App\Models\Api\Endereco;

class PacienteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $dataEnd = Endereco::find($this->endereco_id);
        $endereco = new EnderecoResource($dataEnd);
        return [
            "id" => $this->id,
            "foto_src" => $this->foto_src,
            "nome" => mb_convert_case($this->nome, MB_CASE_UPPER, 'UTF-8'),
            "nome_mae" => strtoupper($this->nome_mae),
            "data_nascimento" => $this->data_nascimento,
            "cpf" => $this->cpf,
            "cns" => $this->cns,
            "endereco" => $endereco,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}
