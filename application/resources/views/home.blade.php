@extends('adminlte::page')

@section('title', 'Resumen')

@section('content')
<div class="container-fluid">
    <section class="content-header">
        <h1>Resumen</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-file"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Noticias</span>
                      <span class="info-box-number">0</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-tasks"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Productos</span>
                      <span class="info-box-number">0</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-eye"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Contactos</span>
                      <span class="info-box-number">0</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-support"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Documentos</span>
                      <span class="info-box-number">0</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection