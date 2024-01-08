<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Api\Endereco;

class Paciente extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'foto_src',
        'nome',
        'nome_mae',
        'data_nascimento',
        'cpf',
        'cns',
        'endereco_id'
    ];

    public function endereco()
    {
        return $this->hasOne(Endereco::class);
    }
}
