@extends('adminlte::page')

@section('title', 'Editar Lugar de Interes')

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
						<h3>Editar Lugar de Interes</h3>
					</div>
					<div class="box-body">
						{!! Form::open(['route' => ['places.update',$place->id], 'method' => 'PUT', 'files' => true]) !!}
						<div class="form-group">
							<label for="name">Nombre: </label>
							<input type="text" name="name" value="{{ $place->name }}" id="name" class="form-control">
						</div>
						<div class="form-group">
							<label for="isactive">Activo: </label>
							<select class="form-control" name="isactive" id="isactive">
								<option value="1" @if($place->isactive) selected='selected' @endif>Si</option>
								<option value="0" @if(!$place->isactive) selected='selected' @endif>No</option>
							</select>
						</div>
						<div class="form-group">
							<label for="entry_id">Rubro: </label>
							<select class="form-control" name="entry_id" id="entry_id">
								@foreach($entries as $entry)
									@if($entry->id == $place->entry_id)
										<option value="{{ $entry->id }}" selected="selected">{{ $entry->name }}</option>
									@else
										<option value="{{ $entry->id }}">{{ $entry->name }}</option>
									@endif
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="phone">Telefono: </label>
							<input type="text" name="phone" value="{{ $place->phone }}" id="phone" class="form-control">
						</div>
						<div class="form-group">
							<label for="location_id">Localidad: </label>
							<select class="form-control" name="location_id" id="location_id">
								@foreach($locations as $location)
									@if($location->id == $place->location_id)
										<option value="{{ $location->id }}" selected="selected">{{ $location->name }}</option>
									@else
										<option value="{{ $location->id }}">{{ $location->name }}</option>
									@endif
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="direction">Direccion: </label>
							<input type="text" name="direction" value="{{ $place->direction }}" id="direction" class="form-control">
						</div>
						<div class="form-group">
							<label for="country">Pais: </label>
							<input type="text" name="country" value="{{ $place->country }}" id="country" class="form-control">
						</div>
						<div class="form-group">
							<label for="city">Ciudad: </label>
							<input type="text" name="city" value="{{ $place->city }}" id="city" class="form-control">
						</div>
						@if(isset($place->image) and !empty($place->image))
							<div id="image-content">
								<img src="{{ asset('application/storage/app/'.$place->image) }}" class="img-thumbnail" style="width: 200px; height: 200px;">
								<button class="btn btn-danger" id="delete-image" type="button"><i class="fa fa-times"></i> Eliminar Imagen</button>
							</div>
							<div class="form-group" style="display:none;" id="file_hidden">
							<label for="image">Imagen: </label>
							<input type="file" name="image" id="image" class="form-control">
						</div>
						@else
							<div class="form-group">
							<label for="image">Imagen: </label>
							<input type="file" name="image" id="image" class="form-control">
						</div>
						@endif
						<div class="form-group">
							<label for="description">Descripcion: </label>
							<textarea class="form-control" name="description" id="description">{{ $place->description }}</textarea>
						</div>
						<button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Guardar</button>
						<a class="btn btn-danger" href="{{ route('places.index') }}"><i class="fa fa-times"></i> Cancelar</a>
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
		$("#delete-image").click(function(){
			var url = "{{ route('places.show',['id' => $place->id]) }}";

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

		$("#description").summernote({
            height: 200
        });
	});
</script>
@stop