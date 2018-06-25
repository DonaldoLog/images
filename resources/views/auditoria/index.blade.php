@extends('adminlte::page') @section('title', 'SAGARPA') @section('content_header')
<h1>AUDITORIAS</h1> @stop @section('content')
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
                            {{-- <a type="button" href="{{route('organizacion.create',[$idPrograma,$idComponente])}}" class="btn btn-default">AGREGAR ORGANIZACION</a> --}}
                        </div>
                    </div>
                    @include('auditoria.table')
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
@include('auditoria.scripts')
