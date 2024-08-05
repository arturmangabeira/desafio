@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
        <form id="formAutor" action="{{ route('autors.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nome do Autor</label>
                <input type="text" class="form-control" id="Nome" name="Nome" maxlength="40">
            </div>                      
        </form>
        <div class="row mt-2">
            <div class="col-md-6">
                <button type="button" id="cadastrar" class="btn btn-success">Cadastrar</button>
                <button type="button" id="voltar" class="btn btn-success">Voltar</button>                    
            </div>
        </div>
        </div>
    </div>
</div>
<script>

    function validar() 
    {
        if($('#Nome').val() == '') {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Favor informar o campo Nome!",
                footer: ''
            }).then((result) => {  
                $('#Nome').focus();    
            });
            return false;
        }

        return true;
    }

    $(document).ready(function() {        

        $('#voltar').on('click',function() {
            window.location.href = "{{ route('autors.index') }}";
        });

        $('#cadastrar').on('click',function() {
            if(validar()) {                
                $('#formAutor').submit();
            }
        });
    });
    </script>
@endsection