@extends('adminlte::page')

@section('title', 'Editar Documento')

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
						<h3>Esitar Documento</h3>
					</div>
					<div class="box-body">
						{!! Form::open(['route' => ['documents.update',$document->id], 'method' => 'PUT', 'files' => true]) !!}
						<div class="form-group">
							<label for="title">Titulo: </label>
							<input type="text" name="title" value="{{ $document->title }}" id="title" class="form-control">
						</div>
						<div class="form-group">
							<label for="description">Descripcion: </label>
							<textarea class="form-control" name="description" id="description">{{ $document->description }}</textarea>
						</div>
						<div class="form-group">
							<label for="category_id">Categoria: </label>
							<select class="form-control" name="category_id" id="category_id">
								@foreach($categories as $category)
									@if($category->id == $document->category_id)
										<option value="{{ $category->id }}" selected="selected">{{ $category->name }}</option>
									@else
										<option value="{{ $category->id }}">{{ $category->name }}</option>
									@endif
									
								@endforeach
							</select>
						</div>

						@if(isset($document->image) and !empty($document->image))
							<div id="image-content">
								<img src="{{ asset('application/storage/app/'.$document->image) }}" class="img-thumnail" style="width:120px; height: 120px;" />
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

						@if(isset($document->file) and !empty($document->file))
							<div id="document-content">
								<a href="{{ asset('application/storage/app/'.$document->file) }}" class="btn btn-success" target="_blank"><i class="fa fa-download"></i> Descargar</a>
								<br />
								<br />
								<button type="button" class="btn btn-danger" id="delete-document">Eliminar Documento</button>
							</div>
							<br />
							<div class="form-group" id="document_hidden" style="display:none;">
								<label for="file">Documento: </label>
								<input type="file" class="form-control" name="file" id="file" />
							</div>
						@else
							<div class="form-group">
								<label for="file">Documento: </label>
								<input type="file" class="form-control" name="file" id="file" />
							</div>
						@endif


						<div class="form-group">
							<label for="content">Contenido: </label>
							<textarea class="form-control" name="content" id="content">{{ $document->content }}</textarea>
						</div>
						<button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Guardar</button>
						<a class="btn btn-danger" href="{{ route('documents.index') }}"><i class="fa fa-times"></i> Cancelar</a>
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
			var url = "{{ route('documents.show',['id' => $document->id]) }}";

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

		$("#delete-document").click(function(){
			var url = "{{ route('delete.document',['id' => $document->id]) }}";

			if(confirm('Estas seguro de eliminar el Documento?')){

				$.get(url, function( response ){	

					var data = JSON.parse(response);

					if(data.deleted == 'yes'){
						alert("Imagen Eliminada con Exito!!");
						$("#document_hidden").show();
						$("#document-content").hide();
					}

				});
			}

		});
	});
</script>
@stop