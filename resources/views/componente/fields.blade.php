<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control mayus','required']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('idPrograma', 'Programa:') !!}
    {!!Form::select('idPrograma',$programas,null, ['class'=>'form-control mayus','readOnly','required'])!!}
</div>
