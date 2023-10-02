@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Productos en Venta</h1>
    <div class="row">
        @foreach ($productos as $producto)
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="{{ asset($producto->imagen) }}" class="card-img-top" alt="{{ $producto->nombre }}" width="100px" height="280px">
                    <div class="card-body">
                        <h5 class="card-title">{{ $producto->descripcion }}</h5>
                        <p class="card-text">${{ $producto->precio }}</p>
                        <button class="btn btn-primary">Agregar al Carrito</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection