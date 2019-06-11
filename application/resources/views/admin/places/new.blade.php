@extends('adminlte::page')

@section('title', 'Nuevo Lugar de Interes')

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
						<h3>Nuevo Lugar de Interes</h3>
					</div>
					<div class="box-body">
						{!! Form::open(['route' => 'places.store', 'method' => 'POST', 'files' => true]) !!}
						<div class="form-group">
							<label for="name">Nombre: </label>
							<input type="text" name="name" id="name" class="form-control">
						</div>
						<div class="form-group">
							<label for="isactive">Activo: </label>
							<select class="form-control" name="isactive" id="isactive">
								<option value="1">Si</option>
								<option value="0">No</option>
							</select>
						</div>
						<div class="form-group">
							<label for="entry_id">Rubro: </label>
							<select class="form-control" name="entry_id" id="entry_id">
								@foreach($entries as $entry)
									<option value="{{ $entry->id }}">{{ $entry->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="phone">Telefono: </label>
							<input type="text" name="phone" id="phone" class="form-control">
						</div>
						<div class="form-group">
							<label for="location_id">Localidad: </label>
							<select class="form-control" name="location_id" id="location_id">
								@foreach($locations as $location)
									<option value="{{ $location->id }}">{{ $location->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="direction">Direccion: </label>
							<input type="text" name="direction" id="direction" class="form-control">
						</div>
						<div class="form-group">
							<label for="country">Pais: </label>
							<input type="text" name="country" id="country" class="form-control">
						</div>
						<div class="form-group">
							<label for="city">Ciudad: </label>
							<input type="text" name="city" id="city" class="form-control">
						</div>
						<div class="form-group">
							<label for="image">Imagen: </label>
							<input type="file" name="image" id="image" class="form-control">
						</div>
						<div class="form-group">
							<label for="description">Descripcion: </label>
							<textarea class="form-control" name="description" id="description"></textarea>
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
		$("#description").summernote({
            height: 200
        });
	});
</script>
@stop