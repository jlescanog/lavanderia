<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $primaryKey = 'IdCliente';
    protected $fillable = ['Nombre', 'CorreoElectronico', 'Telefono', 'Direccion'];
    public $timestamps = true;
}
