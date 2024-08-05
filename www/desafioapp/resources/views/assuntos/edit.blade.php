@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
        <form id="formAssunto" action="{{ route('assuntos.update', ['assunto' => $assunto->CodAs]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nome do Assunto</label>
                <input type="text" class="form-control" id="Descricao" name="Descricao" value="{{ $assunto->Descricao }}" maxlength="20">
            </div>                      
        </form>
        <div class="row mt-2">
            <div class="col-md-6">
                <button type="button" id="cadastrar" class="btn btn-success">Editar</button>
                <button type="button" id="voltar" class="btn btn-success">Voltar</button>                    
            </div>
        </div>
        </div>
    </div>
</div>
<script>

    function validar() 
    {
        if($('#Descricao').val() == '') {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Favor informar o campo Nome do Assunto!",
                footer: ''
            }).then((result) => {  
                $('#Descricao').focus();    
            });
            return false;
        }

        return true;
    }

    $(document).ready(function() {        

        $('#voltar').on('click',function() {
            window.location.href = "{{ route('assuntos.index') }}";
        });

        $('#cadastrar').on('click',function() {
            if(validar()) {                
                $('#formAssunto').submit();
            }
        });
    });
    </script>
@endsection