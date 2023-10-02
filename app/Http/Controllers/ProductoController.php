<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Proveedore;
use Illuminate\Http\Request;

/**
 * Class ProductoController
 * @package App\Http\Controllers
 */
class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $productos = Producto::paginate();

        return view('producto.index', compact('productos'))
            ->with('i', (request()->input('page', 1) - 1) * $productos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $producto = new Producto();
        $proveedores = Proveedore::pluck('razonsocial', 'id_proveedor');
        $categorias = Categoria::pluck('descripcion', 'id_categoria');
        return view('producto.create', compact('producto', 'categorias', 'proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $request->validate([
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Reglas de validación para la imagen
            // Otras reglas de validación para otros campos definidas en Producto::$rules
        ]);

        // Procesar la carga de la imagen
        if ($request->hasFile('imagen') && $request->file('imagen')->isValid()) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '.' . $imagen->extension();
            $imagen->move(public_path('img'), $nombreImagen);
            
            // Crear el producto con los datos del formulario y la ruta de la imagen
            $producto = Producto::create([
                // Otras columnas del modelo Producto
                'descripcion' => $request->input('descripcion'),
                'precio' => $request->input('precio'),
                'stock' => $request->input('stock'),
                'imagen' => 'img/' . $nombreImagen,
                'id_categoria' => $request->input('id_categoria'),
                'id_proveedor' => $request->input('id_proveedor'),
            ]);

            return redirect()->route('productos.index')
                ->with('success', 'Producto creado exitosamente.');
        }

        // Manejar errores si la carga de la imagen falla
        return back()->withInput()->withErrors(['imagen' => 'Error al cargar la imagen']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Producto::find($id);

        return view('producto.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::find($id);
        $proveedores = Proveedore::pluck('razonsocial', 'id_proveedor');
        $categorias = Categoria::pluck('descripcion', 'id_categoria');
        return view('producto.edit', compact('producto', 'proveedores', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Producto $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        // Valida los campos, incluyendo la posible carga de una nueva imagen.
        $request->validate([
            'descripcion' => 'required',
            'precio' => 'required',
            'stock' => 'required',
            'id_categoria' => 'required',
            'id_proveedor' => 'required',
            'nueva_imagen' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Nueva imagen
        ]);

        // Actualiza los campos del producto con la información del formulario
        $producto->descripcion = $request->input('descripcion');
        $producto->precio = $request->input('precio');
        $producto->stock = $request->input('stock');
        $producto->id_categoria = $request->input('id_categoria');
        $producto->id_proveedor = $request->input('id_proveedor');

        // Procesa la carga de la nueva imagen si se proporciona
        if ($request->hasFile('imagen') && $request->file('imagen')->isValid()) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '.' . $imagen->extension();
            $imagen->move(public_path('img'), $nombreImagen);
            $producto->imagen = 'img/' . $nombreImagen;
        }

        // Guarda los cambios en el producto
        $producto->save();

        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado exitosamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $producto = Producto::find($id)->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto deleted successfully');
    }
}
