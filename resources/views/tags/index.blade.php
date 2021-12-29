@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card row justify-content-center">
        <div class="card-header row">
            <h3 class="col-2">Tags</h3>
            <a class="col-2 btn btn-primary" href="{{ route('tags.create') }}">Cadastrar tag</a>
            <div class="col-2"></div>
            <a class="col-2 btn btn-primary" href="{{ route('products.index') }}">Ver produtos</a>
            <div class="col-2"></div>
            <a class="col-2 btn btn-primary" href="{{ route('products.create') }}">Cadastrar produtos</a>
        </div>
        @forelse($tags as $tag)
        <div class="row card-body">

            <div class="col-lg-8 col-md-8 col-sm-12">
                {{ $tag->name }}
            </div>
            
            <div class="col-lg-4 col-md-4 col-sm-12">    
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-warning">Editar</a>
                    </div>
                    <form class="col-lg-6 col-md-6 col-sm-6" method="POST" action="{{route('tags.destroy', $tag->id)}}">
                        {!! method_field('DELETE') !!}
                        @csrf
                        <input class="btn btn-danger" id="btn" type="submit" value="Deletar">
                    </form>
                </div>
            </div>
        </div>
        @empty
            <p>Não existe tags cadastradas</p>
        @endforelse
    </div>
</div>
@stop

