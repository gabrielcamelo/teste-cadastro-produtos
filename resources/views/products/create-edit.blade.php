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
		@if(isset($product))
			<div class="card-header row">
                <h3 class="col-2">Editar</h3>
                <a class="col-2 btn btn-primary" href="{{ route('products.index') }}">Ver produtos</a>
                <div class="col-2"></div>
                <a class="col-2 btn btn-primary" href="{{ route('tags.index') }}">Ver tags</a>
                <div class="col-2"></div>
                <a class="col-2 btn btn-primary" href="{{ route('tags.create') }}">Cadastrar tags</a>
            </div>
		@else
			<div class="card-header row">
                <h3 class="col-2">Cadastrar</h3>
                <a class="col-2 btn btn-primary" href="{{ route('products.index') }}">Ver produtos</a>
                <div class="col-2"></div>
                <a class="col-2 btn btn-primary" href="{{ route('tags.index') }}">Ver tags</a>
                <div class="col-2"></div>
                <a class="col-2 btn btn-primary" href="{{ route('tags.create') }}">Cadastrar tags</a>
            </div>
		@endif

		<div class="row card-body">
			@if(isset($product))
				<form class="" method="POST" action="{{route('products.update', $product->id)}}" enctype="multipart/form-data" >
					{!! method_field('PUT') !!}
			@else
				<form class="" method="POST" action="{{route('products.store')}}" enctype="multipart/form-data" >
			@endif
			
				@csrf
				<span class="alert-warning p-1">
					Tipos de imagens aceitos jpg, jpeg, png; largura e altura mínima 300px; tamanho máximo de 100kb
				</span>

				<div class="">
					<label for="image">Imagem do produto: * </label>
					<input type="file" id="image" name="image" class="form-control p-1 @error('image') is-invalid @enderror" value="{{ $product->image?? old('image') }}" />
				</div>

				<div class="row">
					
					<label class="col-lg-12 col-md-12" for="nome">Nome do produto: *
						<input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $product->name?? old('name') }}" />
					</label>

				</div>

				<br>
				
				@forelse($tags as $tag)
					<div class="form-check form-check-inline">
						@if(isset($product))
							<input type="checkbox" name="tags[]" value="{{ $tag->id?? old('tag') }}" class="form-check-input" {{ $product->tags->contains($tag->id) ? 'checked' : '' }}>
							<label for=""> {{ $tag->name?? old('name') }} </label>
						@else
							<input type="checkbox" name="tags[]" value="{{ $tag->id?? old('tag') }}" class="form-check-input" >
							<label for=""> {{ $tag->name?? old('name') }} </label>
						@endif
					</div>
				@empty
		            <p>Não existe tags</p>
		        @endforelse
						
				<button class="w-100 btn btn-primary mt-3" >Cadastrar produto</button>

			</form>
		</div>
	</div>
</div>
@stop

