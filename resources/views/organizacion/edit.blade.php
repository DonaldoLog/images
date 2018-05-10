@extends('adminlte::page') @section('title', 'SAGARPA') @section('content_header')
<h1>AGREGAR ORGANIZACION</h1> @stop @section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <!--box-header -->
            <div class="box-header with-border">
                <h3 class="box-title">ORGANIZACION</h3>
            </div>

            <!--box-body -->
            <div class="box-body">
                <div class="row">
                    {{Form::model($organizacion,['route' => ['organizacion.update',$organizacion->id],'enctype'=>'multipart/form-data','method'=>'PUT'])}}
                    @include('organizacion.fields')
                    <div class="form-group col-md-12">
                        {{Form::submit('Guardar',['class'=>'btn btn-success'])}}
                    </div>
                    {{Form::close()}}
                </div>
            </div>
            <!--box-footer -->
            <div class="box-footer">
                <div class="row">

                </div>
            </div>
        </div>
    </div>
</div>
@stop
