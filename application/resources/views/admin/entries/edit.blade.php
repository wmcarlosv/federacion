@extends('adminlte::page')

@section('title', 'Editar Rubro')

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
						<h3>Editar Rubro</h3>
					</div>
					<div class="box-body">
						{!! Form::open(['route' => ['entries.update',$entry->id], 'method' => 'PUT', 'files' => true]) !!}
						<div class="form-group">
							<label for="name">Nombre: </label>
							<input type="text" name="name" value="{{ $entry->name }}" id="name" class="form-control">
						</div>
						<div class="form-group">
							<label for="description">Descripcion: </label>
							<textarea class="form-control" name="description" id="description">{{ $entry->description }}</textarea>
						</div>
						@if(isset($entry->image) and !empty($entry->image))
							<div id="image-content">
								<img src="{{ asset('application/storage/app/'.$entry->image) }}" class="img-thumbnail" style="width: 200px; height: 200px;">
							</div>
							<button class="btn btn-danger" id="delete-image" type="button"><i class="fa fa-times"></i> Eliminar Imagen</button>
							<br />
							<br />
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
						<button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Guardar</button>
						<a class="btn btn-danger" href="{{ route('entries.index') }}"><i class="fa fa-times"></i> Cancelar</a>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection
@section('js')
<script type="text/javascript">
	$(document).ready(function(){
		$("#delete-image").click(function(){
			var url = "{{ route('entries.show',['id' => $entry->id]) }}";

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