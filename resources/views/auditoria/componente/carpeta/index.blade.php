@extends('adminlte::page') @section('title', 'SAGARPA') @section('content_header')
<h1>{!!$programa->nombre."-".$componente->nombre!!}</h1> @stop @section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <!--box-header -->
            <div class="box-header with-border">
                <h3 class="box-title">{!!$auditoria->nombre!!}</h3>

            </div>

            <!--box-body -->
            <div class="box-body">
                <div class="form-group col-md-12">

                <div class="pull-right">
                        <button id="addFile" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">AGREGAR ARCHIVO</button>
                    </div>
                </div>

                <div class="row">
                    {{Form::model($auditoria,['route' => ['auditoria.update',$auditoria->id],'enctype'=>'multipart/form-data','method'=>'PUT'])}}
                    {{-- @include('organizacion.fields') --}}
                    <div class="form-group col-md-12">

                    {{-- I  M  A  G E  N  E  S  --}}
                    <div class="row">
                    	<div class="col-md-12">
                    		<div id="archivosAudioria" class="table-editable">
                    			<table class="table table-striped table-bordered" width="100%" >
                    				<thead>
                    					<tr>
                    						<th>NO.</th>
                    						<th>NOMBRE</th>
                    						<th>ACCIONES</th>
                    					</tr>
                    				</thead>
                    				<tbody>
                                        @foreach ($documentos as $documento)
                                        <tr>
                                            <td>{!!$documento->id!!}</td>
                                            <td>{!!$documento->nombre!!}</td>
                                            <td>
                                                <button type="button" value='{!!$documento->id!!}'  data-toggle="modal" data-target="#myModal" class="btn btn-info ver">VER</button>
                                                <button type="button" value='{!!$documento->id!!}'  data-toggle="modal" data-target="#myModal" class="btn btn-warning editar">EDITAR</button>
                                                <a  href="{{ asset('storage/auditoria/archivos/'.$documento->documento) }}" download class="btn btn-success">DESCARGAR</a>
                                                <button type="button" name='{!!$documento->nombre!!}' value='{!!$documento->id!!}' class="btn btn-danger eliminar">ELIMINAR</button>
                                            </td>
                                        </tr>

                                        @endforeach
                    				</tbody>
                    			</table>
                    		</div>
                    	</div>
                    </div>


                        {{Form::submit('Guardar',['class'=>'btn btn-success'])}}
                    </div>
                    {{Form::close()}}
                </div>
            </div>
            <!--box-footer -->
            <div class="box-footer">
                <div class="col">
                    {{-- <a class="btn btn-default" href="{!!route('zip',$organizacion->id)!!}"> DESCARGAR TODO</a> --}}
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @include('organizacion.scriptsTable') --}}


<!-- Modal CREAR -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">AGREGAR ARCHIVO</h4>
      </div>
      <div class="modal-body">
          {!!Form::open(['route'=>'save.file','enctype'=>'multipart/form-data'])!!}
              {!! Form::label('nombre', 'NOMBRE:') !!}
              {!! Form::text('nombre', null, ['class' => 'form-control mayus','required','id'=>'nombre']) !!}
              {!! Form::hidden('idFile', '') !!}
              {!! Form::hidden('idAuditora', $auditoria->id) !!}
              {{-- {!! Form::hidden('idComponente', $idComponente) !!} --}}
              {{-- {!! Form::hidden('idPrograma', $idPrograma) !!} --}}
              {!! Form::label('file', 'ARCHIVO:') !!}
              <input type="file"  class="archivo" id="file" name="file">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="cancelarModal" data-dismiss="modal">CANCELAR</button>
        {{Form::submit('Guardar',['class'=>'btn btn-success','id'=>'submitModal'])}}
      </div>
      {!!Form::close()!!}

    </div>
  </div>
</div>

@stop
@push('js')
    <script type="text/javascript">
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

    $('#archivosAudioria').on('click', '.eliminar', function(event) {
        row=$(this);
        nombre=this.name;
        numero=this.value;
        console.log(numero);
        swal({
                title: "¿Seguro que desea eliminar el documento "+nombre+"?",
                text: "No podrá deshacer este paso.",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Confirmar",
                closeOnConfirm: true
        }, function(isConfirm){
            if (isConfirm) {
                $.ajax({
                  type: "POST",
                  url: route('doc.destroy',numero),
                  success: function (response) {
                      if(response.success){
                           row.closest('tr').remove()
                      }else {
                          swal("Error", "Intentente de nuevo o refresque la pagina", "error");
                          console.log('error');
                      }
                }
                });


            }

        });
    });

    $('#archivosAudioria').on('click', '.editar', function(){
        $('#file').show();
        $('#submitModal').show();
        $('#nombre').prop('readonly', false);
        var id=this.value;
        $( "input[name='idFile']" ).val(id);
        $("#cancelarModal").html('Cancelar');

        $.get(route('file.get',id), function(res) {
            console.log(res[0]['nombre']);
            $('#nombre').val(res[0]['nombre']);
            ///-------
            $('#file').fileinput('destroy');
            $("#file").fileinput({
                language: 'es',
                theme: 'fa',
                allowedFileExtensions: ['jpg', 'jpeg', 'png', 'pdf'],
                overwriteInitial: true,
                showUpload: false,
                showRemove: false,
                initialPreviewConfig: [
                    {downloadUrl:("{{ asset('storage/auditoria/archivos/') }}"+ "/"+res[0]['archivo']),key: res[0]['archivo']},
                ],
                initialPreviewAsData: true,
                initialPreview: [
                        "{{ asset('storage/auditoria/archivos/') }}"+ "/"+res[0]['archivo']
                ]
            });

            $('.kv-file-remove').hide();


        });
        console.log(id);
    });

    $('#archivosAudioria').on('click', '.ver', function(){

        $('#nombre').prop('readonly', true);
        $('#file').hide();
        $('#submitModal').hide();
         $("#cancelarModal").html('Atras');
        var id=this.value;
        $.get(route('file.get',id), function(res) {
            console.log(res[0]['nombre']);
            $('#nombre').val(res[0]['nombre']);
            ///-------
            $('#file').fileinput('destroy');
            $("#file").fileinput({
                language: 'es',
                theme: 'fa',
                overwriteInitial: false,
                showClose: false,
                showCaption: false,
                layoutTemplates: {main2: '{preview}{remove}'},
                initialPreviewConfig: [
                    {downloadUrl:("{{ asset('storage/auditoria/archivos') }}"+ "/"+res[0]['archivo']),key: res[0]['archivo']},
                ],
                initialPreviewAsData: true,
                initialPreview: [
                    "{{ asset('storage/auditoria/archivos') }}"+  "/"+res[0]['archivo']

                ]
            });
            $('.kv-file-remove').hide();



        });
        console.log(id);
    });

    $('#addFile').on('click', function(event) {
        $('#file').fileinput('destroy');
        $("#file").fileinput({
              language: 'es',
              theme: 'fa',
              showPreview: true,
              showRemove: false,
              showUpload:false,
              allowedFileExtensions: ['jpg', 'jpeg', 'png','xdoc','ppt','pdf']
          });
    });

    </script>
@endpush