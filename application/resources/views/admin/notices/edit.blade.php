@extends('adminlte::page')

@section('title', 'Editar Noticia')

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
						<h3>Esitar Noticia</h3>
					</div>
					<div class="box-body">
						{!! Form::open(['route' => ['notices.update',$notice->id], 'method' => 'PUT', 'files' => true]) !!}
						<div class="form-group">
							<label for="title">Titulo: </label>
							<input type="text" name="title" value="{{ $notice->title }}" id="title" class="form-control">
						</div>
						<div class="form-group">
							<label for="description">Descripcion: </label>
							<textarea class="form-control" name="description" id="description">{{ $notice->description }}</textarea>
						</div>
						<div class="form-group">
							<label for="category_id">Categoria: </label>
							<select class="form-control" name="category_id" id="category_id">
								@foreach($categories as $category)
									@if($category->id == $notice->category_id)
										<option value="{{ $category->id }}" selected="selected">{{ $category->name }}</option>
									@else
										<option value="{{ $category->id }}">{{ $category->name }}</option>
									@endif
									
								@endforeach
							</select>
						</div>
						@if(isset($notice->image) and !empty($notice->image))
							<div id="image-content">
								<img src="{{ asset('application/storage/app/'.$notice->image) }}" class="img-thumnail" style="width:120px; height: 120px;" />
								<button type="button" class="btn btn-danger" id="delete-image">Eliminar Imagen</button>
							</div>
							<br />
							<div class="form-group" id="file_hidden" style="display:none;">
								<label for="image">Imagen: </label>
								<input type="file" class="form-control" name="image" id="image" />
							</div>
						@else
							<div class="form-group">
								<label for="image">Imagen: </label>
								<input type="file" class="form-control" name="image" id="image" />
							</div>
						@endif
						<div class="form-group">
							<label for="content">Contenido: </label>
							<textarea class="form-control" name="content" id="content">{{ $notice->content }}</textarea>
						</div>
						<button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Guardar</button>
						<a class="btn btn-danger" href="{{ route('notices.index') }}"><i class="fa fa-times"></i> Cancelar</a>
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
			var url = "{{ route('notices.show',['id' => $notice->id]) }}";

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