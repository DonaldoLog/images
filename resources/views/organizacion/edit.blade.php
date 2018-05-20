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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">AGREGAR ARCHIVO</button>
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
                                                <a type="button" class="btn btn-info">VER</a>
                                                <a type="button" class="btn btn-warning">EDITAR</a>
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


<!-- Modal -->
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
              {!! Form::text('nombreArhivo', null, ['class' => 'form-control mayus','required']) !!}
              {!! Form::hidden('id', $organizacion->id) !!}
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
