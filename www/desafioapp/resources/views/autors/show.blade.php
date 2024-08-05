@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">        
            <div class="form-group">
                <label for="name">Nome do Autor</label>
                <input type="text" class="form-control" id="Nome" name="Nome" value="{{ $autor->Nome }}" readonly>
            </div>                              
            <div class="row mt-2">
                <div class="col-md-6">                
                    <button type="button" id="voltar" class="btn btn-success">Voltar</button>                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>


    $(document).ready(function() {        

        $('#voltar').on('click',function() {
            window.location.href = "{{ route('autors.index') }}";
        });

    });
    </script>
@endsection