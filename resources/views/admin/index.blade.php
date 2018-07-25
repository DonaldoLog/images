@extends('adminlte::page') @section('title', 'SAGARPA') @section('content_header')
<h1>ADMINISTRADOR</h1> @stop @section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <!--box-header -->
            <div class="box-header with-border">
                <h3 class="box-title">USUARIOS</h3>
            </div>

            <!--box-body -->
            <div class="box-body">
                <div class="form-group">
                    <div class="form-group col-md-12">
                        <div class="pull-right">
                            <a type="button" id="botonAgregar" class="btn btn-default">AGREGAR USUARIO</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                            @include('admin.table')
                        </div>
                    </div>
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
{{-- @include('auditoria.scripts') --}}


{{--  M O D A L --}}
<div class="modal fade" id="modalAddUser" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">AGREGAR USUARIO</h4>
      </div>
      <div class="modal-body">
        {!!Form::open(['route'=>'store.usuario','method'=>'post'])!!}
        <div class="row">
            <div class="col-md-12">
                    {!!Form::hidden('idUsuario',"",['id'=>'idUsuario'])!!}
                <div class="form-group">
                    {!!Form::label('name','NOMBRE:')!!}
                    {!! Form::text('name', null, ['class' => 'form-control mayus','required']) !!}
                </div>
                <div class="form-group">
                    {!!Form::label('primerAp','PRIMER APELLIDO:')!!}
                    {!! Form::text('primerAp', null, ['class' => 'form-control mayus','required']) !!}
                </div>
                <div class="form-group">
                    {!!Form::label('segundoAp','SEGUNDO APELLIDO:')!!}
                    {!! Form::text('segundoAp', null, ['class' => 'form-control mayus','required']) !!}
                </div>
                <div class="form-group">
                    {!!Form::label('email','CORREO:')!!}
                    {!! Form::text('email', null, ['class' => 'form-control mayus','required']) !!}
                </div>
                <div class="form-group">
                    {!!Form::label('password','CONTRASEÑA:')!!}
                    {!! Form::password('password', ['class' => 'form-control','required']) !!}
                </div>
                <div class="form-group">
                    {!!Form::label('idComponente','COMPONENTES:')!!}
                    {!! Form::select('idComponente[]', $componentes,null, ['class' => "form-control",'style'=>'width:100%;','multiple','required']) !!}
                </div>
            </div>

        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="submit" class="btn btn-primary">CREAR</button>
        {!!Form::close()!!}

      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@push('js')
<script type="text/javascript">
$(document).ready(function() {
    $('select').select2();
    $('#users-table').on('click', '.editUser', function(event) {
        var id=this.value;
        $('#idUsuario').val(id);
        $.getJSON(route('edit.usuario',id), function(response) {
            $('#modalUser').modal('toggle');
            console.log(response);
        });
        console.log(id);
    });

    $('#botonAgregar').on('click',function(event) {
        var id=this.value;
        tipo="agregar";
        $('#modalAddUser').modal('toggle');

        $.getJSON(route('edit.usuario',id), function(response) {
            $('#modalAddUser').modal('toggle');
        });
        console.log(id);
    });

    $('#submit').on('click', function(event) {
        if(tipo=="editar"){

        }else if(tipo=="agregar") {

        }
    });


});
</script>
@endpush
