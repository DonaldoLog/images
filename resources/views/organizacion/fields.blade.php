
<div class="col-md-5">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control mayus','required']) !!}
</div>

<div class="col-md-5">
    {!! Form::label('componente', 'Componente:') !!}
    {!!Form::label('componente',$componente->nombre, ['class'=>'form-control'])!!}
    {!!Form::hidden('idComponente',$idComponente)!!}
    {!!Form::hidden('idPrograma',$idPrograma)!!}
</div>
<div class="col-md-1">
    {{Form::submit('Guardar',['class'=>'btn btn-success','style'=>'margin-top:25px;'])}}
</div>

@push('js')
    <script type="text/javascript">
    $(document).ready(function() {
        //--------------------------------------------------------------------------
        $('select').select2();
    });
    </script>
@endpush
