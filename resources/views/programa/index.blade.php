@extends('adminlte::page') @section('title', 'SAGARPA') @section('content_header')
    <h1>INICIO</h1> @stop @section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <!--box-header -->
                    <div class="box-header with-border">
                        <h3 class="box-title">PROGRAMAS</h3>
                    </div>
                    <style media="screen">

                    .text-block  {
                        position: absolute;
                        bottom: 10px;
                        right: 10px;
                        padding-left: 10px;
                        padding-right: 10px;
                    }


                    .img-container{
                        border-radius: 8px;
                        overflow: hidden;
                        display: flex;

                        -webkit-box-shadow: 0px 2px 7px 0px rgba(0,0,0,0.75);
                        -moz-box-shadow: 0px 2px 7px 0px rgba(0,0,0,0.75);
                        box-shadow: 0px 2px 7px 0px rgba(0,0,0,0.75);
                    }

                </style>
                <!--box-body -->
                <div class="box-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            @role('admin')
                            <div class="pull-right">
                                <a type="button" href="{{route('programa.create')}}" class="btn btn-default">AGREGAR PROGRAMA</a>

                            </div>
                            @endrole
                        </div>
                        <div class="form-group col-md-12">
                            <br>
                            <br>
                            <br>
                            @foreach ($data as $dato)
                                <div class="col-md-4">
                                    <div class="text-block">

                                        <h3 class="texto" align="center">{!!$dato->nombre!!}</h3>
                                    </div>

                                    <div class="img-container" style="height:200px;">
                                        <a style="width:100%;" href="{{ url('programa') }}/{!!$dato->id!!}/componentes" >
                                            @if ($dato->imagen == null || $dato->imagen == "")
                                                <img  class="img"src='../public/images/default.png' style='width:100%; height:100%;' border="0" alt="Null">
                                            @else
                                                <img  class="img"src='../public/storage/programasImagenes/{!!$dato->imagen!!}' style='width:100%; height:100%;' border="0" alt="Null">
                                            @endif
                                        </a>

                                        @hasrole('admin')
                                        <div class="text-block">
                                            <a href="{!!route('programa.edit',$dato->id)!!}" class="fa fa-edit"></a>
                                            <a id='borrarProgramaBoton' href="#" name='{{$dato->nombre}}' value='{{$dato->id}}' class="fa fa-remove" ></a>
                                            {{-- <a id="borrarProgramaBoton"  class="fa fa-remove"></a> --}}
                                        </div>
                                        @endhasrole

                                    </div>
                                </div>

                            @endforeach

                        </div>
                    </div>
                </div>
                {!!Form::open(['route' => ['programa.destroy',null],'method'=>'delete','id'=>'borrarPrograma'])!!}
                {!!Form::close()!!}
                <div class="box-footer">
                    <div class="row">

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@include('programa.scripts')
