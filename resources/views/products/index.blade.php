@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-lg-2 col-md-2 col-sm-12">
            <h3> Tags </h3>
            @forelse($tags as $tag)
                <a href="{{ route('filtroTag', $tag->id) }}" class="btn btn-sm btn-light m-1"> {{ $tag->name }} </a> <br>
            @empty
                <p>Não existe tags</p>
            @endforelse
        </div>

        <div class="col-lg-10 col-md-10 col-sm-12 card">
            <div class="card-header row">
                <h3 class="col-2">Produtos</h3>
                <a class="col-2 btn btn-primary" href="{{ route('products.create') }}">Cadastrar produtos</a>
                <div class="col-2"></div>
                <a class="col-2 btn btn-primary" href="{{ route('tags.index') }}">Ver tags</a>
                <div class="col-2"></div>
                <a class="col-2 btn btn-primary" href="{{ route('tags.create') }}">Cadastrar tags</a>
            </div>
            @forelse($products as $product)
            <div class="row card-body">
                <div class="col-lg-2 col-md-2 col-sm-12">
                    <img src="{{ url("storage/{$product->image}") }}" class="mx-auto d-block" width="60" />
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    {{ $product->name }}
                </div>
                
                <div class="col-lg-4 col-md-4 col-sm-12">    
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Editar</a>
                        </div>
                        <form class="col-lg-6 col-md-6 col-sm-6" method="POST" action="{{route('products.destroy', $product->id)}}">
                            {!! method_field('DELETE') !!}
                            @csrf
                            <input class="btn btn-danger" id="btn" type="submit" value="Deletar">
                        </form>
                    </div>
                </div>
            </div>
            @empty
                <p>Não existe produtos cadastrada</p>
            @endforelse
        </div>
    </div>
</div>
@stop

