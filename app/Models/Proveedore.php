<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class Proveedore
 *
 * @property $id_proveedor
 * @property $razonsocial
 * @property $direccion
 * @property $telefono
 *
 * @property Producto[] $productos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Proveedore extends Model
{
    protected $primaryKey = 'id_proveedor';
    public $timestamps = false;

    static $rules = [
		'razonsocial' => ['required', 'regex:/^[A-Za-z\s]+$/'],
		'direccion' => ['required', 'regex:/^[A-Za-z0-9\s]+$/'],
		'telefono' => 'required|digits:9|numeric',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['razonsocial','direccion','telefono'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productos()
    {
        return $this->hasMany('App\Models\Producto', 'id_proveedor', 'id_proveedor');
    }
    

}
