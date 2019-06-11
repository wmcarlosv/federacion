@extends('adminlte::page')

@section('title', 'Editar Localizacion')

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
						<h3>Editar Localizacion</h3>
					</div>
					<div class="box-body">
						{!! Form::open(['route' => ['locations.update',$location->id], 'method' => 'PUT']) !!}
						<div class="form-group">
							<label for="name">Nombre: </label>
							<input type="text" name="name" value="{{ $location->name }}" id="name" class="form-control">
						</div>
						<button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Guardar</button>
						<a class="btn btn-danger" href="{{ route('locations.index') }}"><i class="fa fa-times"></i> Cancelar</a>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection