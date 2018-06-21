<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control mayus','required']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('programa', 'Programa:') !!}
    {!!Form::label('programa',$programa->nombre,['class'=>'form-control mayus','readOnly','required'])!!}
    {!!Form::hidden('idPrograma',$programa->id)!!}
</div>
