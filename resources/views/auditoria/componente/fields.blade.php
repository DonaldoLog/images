<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control mayus','required']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('componente', 'Componente:') !!}
    {!!Form::label('componente',$componente->nombre, ['class'=>'form-control'])!!}
    {!!Form::hidden('idComponente',$idComponente)!!}
    {!!Form::hidden('idPrograma',$idPrograma)!!}
</div>





@push('js')
    <script type="text/javascript">
    $(document).ready(function() {
        //--------------------------------------------------------------------------
        $('select').select2();
    });
    </script>
@endpush
