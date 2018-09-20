@extends('adminlte::page') @section('title', 'SAGARPA') @section('content_header')
<h1>{!!$componente->nombre!!}</h1> @stop @section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <!--box-header -->
            <div class="box-header with-border">
                <h3 class="box-title">ORGANIZACIONES</h3>
            </div>

            <!--box-body -->
            <div class="box-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        <a href="{!!route('programa.componentes',$idPrograma)!!}" class="btn btn-default"> <i class="fa fa-mail-reply"> </i> </a>

                        <div class="pull-right">
                            <a type="button" href="{{route('organizacion.create',[$idPrograma,$idComponente])}}" class="btn btn-default">AGREGAR ORGANIZACION</a>
                        </div>
                    </div>
                    @include('organizacion.table')
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
@include('organizacion.scripts')
