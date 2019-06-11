@extends('adminlte::page')

@section('title', 'Editar Producto')

@section('css')
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
@stop

@section('content')
<div class="container-fluid">
	<section class="content">
		@if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif

		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3>Esitar Producto</h3>
					</div>
					<div class="box-body">
						{!! Form::open(['route' => ['products.update',$product->id], 'method' => 'PUT', 'files' => true]) !!}
						<div class="form-group">
							<label for="name">Nombre: </label>
							<input type="text" name="name" value="{{ $product->name }}" id="name" class="form-control">
						</div>
						<div class="form-group">
							<label for="price">Precio: </label>
							<input type="text" name="price" id="price" value="{{ $product->price }}" class="form-control">
						</div>
						<div class="form-group">
							<label for="description">Descripcion: </label>
							<textarea class="form-control" name="description" id="description">{{ $product->description }}</textarea>
						</div>
						<div class="form-group">
							<label for="entry_id">Rubros: </label>
							<select class="form-control" name="entry_id" id="entry_id">
								@foreach($entries as $entry)
									@if($entry->id == $product->entry_id)
										<option value="{{ $entry->id }}" selected="selected">{{ $entry->name }}</option>
									@else
										<option value="{{ $entry->id }}">{{ $entry->name }}</option>
									@endif
									
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="phone">Telefono: </label>
							<input type="text" name="phone" value="{{ $product->phone }}" id="phone" class="form-control">
						</div>
						<div class="form-group">
							<label for="whatsapp">Whatsapp: </label>
							<input type="text" name="whatsapp" value="{{ $product->whatsapp }}" id="whatsapp" class="form-control">
						</div>
						<div class="form-group">
							<label for="email">Email: </label>
							<input type="text" name="email" value="{{ $product->email }}" id="email" class="form-control">
						</div>
						<div class="form-group">
							<label for="direction">Direccion: </label>
							<input type="text" name="direction" value="{{ $product->direction }}" id="direction" class="form-control">
						</div>
						@if(isset($product->cover) and !empty($product->cover))
							<div id="image-content">
								<img src="{{ asset('application/storage/app/'.$product->cover) }}" class="img-thumnail" style="width:120px; height: 120px;" />
								<button type="button" class="btn btn-danger" id="delete-image">Eliminar Imagen</button>
							</div>
							<br />
							<div class="form-group" id="file_hidden" style="display:none;">
								<label for="cover">Imagen: </label>
								<input type="file" class="form-control" name="cover" id="cover" />
							</div>
						@else
							<div class="form-group">
								<label for="cover">Imagen: </label>
								<input type="file" class="form-control" name="cover" id="cover" />
							</div>
						@endif
						<div class="form-group">
							<label for="content">Contenido: </label>
							<textarea class="form-control" name="content" id="content">{{ $product->content }}</textarea>
						</div>
						<button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Guardar</button>
						<a class="btn btn-danger" href="{{ route('products.index') }}"><i class="fa fa-times"></i> Cancelar</a>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection
@section('js')
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
<script type="text/javascript">
	$(document).ready(function(){

		$("#content").summernote({
            height: 200
        });

		$("#delete-image").click(function(){
			var url = "{{ route('products.show',['id' => $product->id]) }}";

			if(confirm('Estas seguro de eliminar la Imagen?')){

				$.get(url, function( response ){	

					var data = JSON.parse(response);

					if(data.deleted == 'yes'){
						alert("Imagen Eliminada con Exito!!");
						$("#file_hidden").show();
						$("#image-content").hide();
					}

				});
			}

		});
	});
</script>
@stop