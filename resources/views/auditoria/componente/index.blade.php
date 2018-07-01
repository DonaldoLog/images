@extends('adminlte::page') @section('title', 'SAGARPA') @section('content_header')
<h1>{!!$componente->nombre!!}</h1> @stop @section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <!--box-header -->
            <div class="box-header with-border">
                <h3 class="box-title">CARPETAS</h3>
            </div>

            <!--box-body -->
            <div class="box-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        <div class="pull-right">
                            <a data-toggle="modal" href="#myModal" class="btn btn-primary btn-lg" class="btn btn-default">AGREGAR CARPETA</a>
                        </div>
                    </div>
                    @include('auditoria.componente.table')
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

<div class="modal fade" id="">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">title</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group col">
                    {!! Form::label('label', 'label:') !!}
                    {!! Form::text('text', null, ['class' => 'form-control', 'required']) !!}
                </div>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
            </div>
        </div>

    </div>
</div>
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">NUEVA CARPETA</h4>
      </div>
      <div class="modal-body">
        {!!Form::open(['route'=>'nueva.carpeta','method'=>'post'])!!}
        {!!Form::hidden('idCatComponente',$componente->id)!!}
        {!!Form::label('nombre','NOMBRE:')!!}
        {!! Form::text('nombre', null, ['class' => 'form-control mayus','required']) !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">CREAR</button>
        {!!Form::close()!!}
        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


@stop
{{-- @include('auditoria.scripts') --}}
