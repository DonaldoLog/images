@extends('adminlte::page')
@section('title',  'SAGARPA')
@section('content_header')
<h1>EDITAR {!!$programa->nombre!!}</h1>
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <!--box-header -->
            <div class="box-header with-border">
                <h3 class="box-title">PROGRAMA</h3>
            </div>

            <!--box-body -->
            <div class="box-body">
                <a href="{!!route('programa.index')!!}" class="btn btn-default"> <i class="fa fa-mail-reply"> </i> </a>

                <div class="row">
                    {{Form::open(['route' =>['programa.update',$programa->id],'method'=>'put','enctype'=>'multipart/form-data'])}}
                    @include('programa.fields')
                    <div class="form-group col-md-12">
                        {{Form::submit('Guardar',['class'=>'btn btn-success'])}}
                        <a class="btn btn-danger" href="{!!route('programa.index')!!}"> Cancelar</a>
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
