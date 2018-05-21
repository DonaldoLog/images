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
                <div class="form-group col-md-12">

                <div class="pull-right">
                        <button id="addFile" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">AGREGAR ARCHIVO</button>
                    </div>
                </div>

                <div class="row">
                    {{Form::model($organizacion,['route' => ['organizacion.update',$organizacion->id],'enctype'=>'multipart/form-data','method'=>'PUT'])}}
                    @include('organizacion.fields')
                    <div class="form-group col-md-12">

                    {{-- I  M  A  G E  N  E  S  --}}
                    <div class="row">
                    	<div class="col-md-12">
                    		<div id="organizacionTable" class="table-editable">
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
                                                <button type="button" value='{!!$documento->id!!}'  data-toggle="modal" data-target="#myModal" class="btn btn-warning editar">EDITAR</button>
                                                <a type="button" class="btn btn-danger">ELIMINAR</a>
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
                <div class="row">

                </div>
            </div>
        </div>
    </div>
</div>
@include('organizacion.scriptsTable')


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
              {!! Form::label('nombreArhivo', 'NOMBRE:') !!}
              {!! Form::text('nombreArhivo', null, ['class' => 'form-control mayus','required','id'=>'nombreArhivo']) !!}
              {!! Form::hidden('idFile', '') !!}
              {!! Form::hidden('idEmpresa', $organizacion->id) !!}
              {!! Form::label('file', 'ARCHIVO:') !!}
              <input type="file"  class="archivo" id="file" name="file">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
        {{Form::submit('Guardar',['class'=>'btn btn-success'])}}
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
    $('#organizacionTable').on('click', '.editar', function(){
        var id=this.value;
        $( "input[name='idFile']" ).val(id);
        $.get(route('file.get',id), function(res) {
            console.log(res[0]['nombre']);
            $('#nombreArhivo').val(res[0]['nombre']);
            ///-------
            $('#file').fileinput('destroy');
            $("#file").fileinput({
                language: 'es',
                theme: 'fa',
                allowedFileExtensions: ['jpg', 'jpeg', 'png', 'pdf'],
                overwriteInitial: false,
                showUpload: false,
                showRemove: false,
                initialPreviewConfig: [
                    {downloadUrl:("../../storage/archivos/" + res[0]['archivo']),key: res[0]['archivo']},
                ],
                initialPreviewAsData: true,
                initialPreview: [
                    "../../storage/archivos/" + res[0]['archivo']
                ]
            });



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
              allowedFileExtensions: ['jpg', 'jpeg', 'png','xdoc','ppt']
          });
    });

    </script>
@endpush
