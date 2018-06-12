@extends('adminlte::page') @section('title', 'SAGARPA') @section('content_header')
<h1>INICIO</h1> @stop @section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <!--box-header -->
            <div class="box-header with-border">
                <h3 class="box-title">COMPONENTES</h3>
            </div>

            <!--box-body -->
            <div class="box-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        <div class="pull-right">
                            <a type="button" href="{{route('programa.create.componente',$idPrograma)}}" class="btn btn-default">AGREGAR COMPONENTE</a>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        @foreach ($componentes as $componente)
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h4 align="center">{!!$componente->nombre!!}</h4>
                                </div>
                                <div class="form-group">
                                    <a href="{{ url('programa') }}/{!!$idPrograma!!}/componente/{!!$componente->id!!}/organizaciones" >
                                        <img  class="img" src='../../storage/componenteImagen/{!!$componente->imagen!!}' height="200" width="300">
                                    </a>
                                </div>

                            </div>
                        @endforeach

                    {{-- @include('componente.table') --}}
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
{{-- @include('componente.scripts') --}}
