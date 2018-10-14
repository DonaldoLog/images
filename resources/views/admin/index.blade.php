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



            {{--  M O D A L --}}
            <div class="modal fade" id="modalAddUser" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">AGREGAR USUARIO</h4>
                        </div>
                        <div class="modal-body">
                            {!!Form::open(['route'=>'store.usuario','method'=>'post','id'=>'formUser'])!!}
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
                                    <div class="form-group" id="newPass" style="display:none;">
                                        {!!Form::label('password','NUEVA CONTRASEÑA:')!!}
                                        {!! Form::checkbox('password',1,false,['id'=>'checkNewPassword']) !!}
                                        {!! Form::password('newPassword', ['class' => 'form-control','id'=>'newPassword','disabled']) !!}
                                    </div>
                                    <div class="form-group" id="currentPass" style="display:show;">
                                        {!!Form::label('password','CONTRASEÑA:')!!}
                                        {!! Form::password('password', ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!!Form::label('idComponente','COMPONENTES:')!!}
                                        {!! Form::select('idComponente[]', $componentes,null, ['id'=>'idComponente','class' => "form-control",'style'=>'width:100%;','multiple','required']) !!}
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">CERRAR</button>
                            <button id="submit" class="btn btn-primary">GUARDAR</button>
                            {!!Form::close()!!}

                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

    @stop
    {{-- @include('auditoria.scripts') --}}


    @push('js')
        <script type="text/javascript">
        $(document).ready(function() {
            $('select').select2();
            var id = "";
            var tipo = "";
            $('#users-table').on('click', '.editUser', function(event) {
                id=this.value;
                tipo="editar";
                $('#idUsuario').val(id);
                $('#currentPass').hide();
                $('#newPass').show();
                $('#password').prop('required',false);
                $('#modalAddUser').modal('toggle');
                $.getJSON(route('edit.usuario',id), function(response) {
                    $("#idComponente").val('').trigger('change');
                    console.log(response.usuario);
                    var values=response.permisos;
                    $.each(values.split(","), function(i,e){
                        $("#idComponente option[value='" + e + "']").prop("selected", true);
                        console.log(e);
                    });
                    $('#idComponente').select2();
                    $('#name').val(response.usuario['name']);
                    $('#primerAp').val(response.usuario['primerAp']);
                    $('#segundoAp').val(response.usuario['segundoAp']);
                    $('#email').val(response.usuario['email']);
                    $('#password').val('');

                });
            });

            $('#botonAgregar').on('click',function(event) {
                $('#currentPass').show();
                $('#newPass').hide();
                $('#name').val('');
                $('#primerAp').val('');
                $('#segundoAp').val('');
                $('#email').val('');
                $('#password').val('');
                $('#password').prop('required',true);
                $("#idComponente").val('').trigger('change');
                $('#idComponente').select2("val", "");
                tipo="agregar";
                $('#modalAddUser').modal('toggle');
            });

            $('#submit').on('click', function() {
                this.preventDefault;
                if(tipo=="editar"){
                    $('#formUser').attr('action', route('update.usuario',id));
                    $('#formUser').submit();
                }else if(tipo=="agregar") {
                    $('#formUser').attr('action', route('store.usuario'));
                    $('#formUser').submit();
                }
            });

            $('#checkNewPassword').on('click', function(event) {
                if($('#checkNewPassword').prop('checked')) {
                    $('#newPassword').prop('disabled', false);
                    $('#newPassword').prop('required',true);
                } else {
                    $('#newPassword').prop('disabled', true);
                    $('#newPassword').prop('required',false);

                }
            });


        });
        </script>
    @endpush
