<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Producto
 *
 * @property $id_producto
 * @property $descripcion
 * @property $precio
 * @property $stock
 * @property $id_categoria
 * @property $id_proveedor
 *
 * @property Categoria $categoria
 * @property Proveedore $proveedore
 * @property Venta[] $ventas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Producto extends Model
{
    protected $primaryKey = 'id_producto';
    public $timestamps = false;

    static $rules = [
		'descripcion' => 'required',
		'precio' => 'required',
		'stock' => 'required',
		'id_categoria' => 'required',
		'id_proveedor' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['descripcion','precio','stock','id_categoria','id_proveedor'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function categoria()
    {
        return $this->hasOne('App\Models\Categoria', 'id_categoria', 'id_categoria');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function proveedore()
    {
        return $this->hasOne('App\Models\Proveedore', 'id_proveedor', 'id_proveedor');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ventas()
    {
        return $this->hasMany('App\Models\Venta', 'id_producto', 'id_producto');
    }
    

}
