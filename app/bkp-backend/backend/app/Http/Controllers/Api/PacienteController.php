<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\Paciente;
use App\Models\Api\Endereco;
use App\Http\Resources\Api\PacienteResource;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function index()
    {
        $Pacientes = Paciente::paginate();

        return PacienteResource::collection($Pacientes);
    }

    public function store(Request $request)
    {
        $data = $request->all();


        $dataEnd = $data["endereco"];
        $endereco = Endereco::create($dataEnd);


        $Paciente = Paciente::create([
            "foto_src" => $data['foto_src'],
            "nome" => $data['nome'],
            "nome_mae" => $data['nome_mae'],
            "data_nascimento" => $data['data_nascimento'],
            "cpf" => $data['cpf'],
            "cns" => $data['cns'],
            "endereco_id" => $endereco->id
        ]);

        return new PacienteResource($Paciente);
    }
}
