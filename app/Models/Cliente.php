<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class Cliente
 *
 * @property $id_cliente
 * @property $nombres
 * @property $apellidos
 * @property $direccion
 * @property $telefono
 *
 * @property Factura[] $facturas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Cliente extends Model
{
    protected $primaryKey = 'id_cliente';
    public $timestamps = false;

    static $rules = [
		'nombres' => ['required', 'regex:/^[A-Za-z\s]+$/'],
		'apellidos' => ['required', 'regex:/^[A-Za-z\s]+$/'],
		'direccion' => ['required', 'regex:/^[A-Za-z0-9\s]+$/'],
		'telefono' => 'required|numeric|digits:9',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombres','apellidos','direccion','telefono'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function facturas()
    {
        return $this->hasMany('App\Models\Factura', 'id_cliente', 'id_cliente');
    }
    

}
