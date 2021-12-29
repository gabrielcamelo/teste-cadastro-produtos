@extends('layouts.app')

@section('content')
<div class="container">
	@if( count($errors) > 0 )
		<div class="alert alert-danger">
			@foreach( $errors->all() as $error )
				<p>{{ $error }}</p>
			@endforeach
		</div>
	@endif

    <div class="card row justify-content-center">
		@if(isset($tag))
			<div class="card-header row">
	            <h3 class="col-2">Editar</h3>
	            <a class="col-2 btn btn-primary" href="{{ route('tags.index') }}">Ver tags</a>
	            <div class="col-2"></div>
	            <a class="col-2 btn btn-primary" href="{{ route('products.index') }}">Ver produtos</a>
	            <div class="col-2"></div>
	            <a class="col-2 btn btn-primary" href="{{ route('products.create') }}">Cadastrar produtos</a>
        	</div>
		@else
			<div class="card-header row">
	            <h3 class="col-2">Cadastrar</h3>
	            <a class="col-2 btn btn-primary" href="{{ route('tags.index') }}">Ver tags</a>
	            <div class="col-2"></div>
	            <a class="col-2 btn btn-primary" href="{{ route('products.index') }}">Ver produtos</a>
	            <div class="col-2"></div>
	            <a class="col-2 btn btn-primary" href="{{ route('products.create') }}">Cadastrar produtos</a>
        	</div>
		@endif

		<div class="row card-body">
			@if(isset($tag))
				<form class="" method="POST" action="{{route('tags.update', $tag->id)}}" >
					{!! method_field('PUT') !!}
			@else
				<form class="" method="POST" action="{{route('tags.store')}}" >
			@endif

				@csrf
			
				<div class="row">
					<label class="col-lg-12 col-md-12" for="name">Nome da categoria: *
						<input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $tag->name?? old('name') }}" />
					</label>
				</div>
				
				<div class="row">
					<button class="col-lg-12 col-md-12 btn btn-primary mt-3" >Cadastrar categoria </button>
				</div>

			</form>
		</div>
	</div>
</div>
@stop

