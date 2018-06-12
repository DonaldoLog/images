@extends('adminlte::page') @section('title', 'SAGARPA') @section('content_header')
<h1>INICIO</h1> @stop @section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <!--box-header -->
            <div class="box-header with-border">
                <h3 class="box-title">PROGRAMAS</h3>
            </div>

            <!--box-body -->
            <div class="box-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        <div class="pull-right">
                            <a type="button" href="{{route('programa.create')}}" class="btn btn-default">AGREGAR PROGRAMA</a>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        @foreach ($data as $dato)
                            <div class="col-md-4 ">
                                <h3 align="center">{!!$dato->nombre!!}</h3>
                                <center>
                                    <a href="{{ url('programa') }}/{!!$dato->id!!}/componentes" >
                                        <img  class="img"src='../public/storage/programasImagenes/{!!$dato->imagen!!}' height="300" width="400">
                                    </a>
                                </center>
                            </div>
                        @endforeach
                    </div>
                    {{-- @include('programa.table') --}}
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
{{-- @include('programa.scripts') --}}
