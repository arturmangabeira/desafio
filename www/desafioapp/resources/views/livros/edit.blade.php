@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
        <form id="formLivro" action="{{ route('livros.update', ['livro' => $livro->Codl]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Titulo</label>
                <input type="text" class="form-control" id="Titulo" name="Titulo" value="{{ $livro->Titulo }}" maxlength="40">
            </div>
            <div class="form-group">
                <label for="name">Editora</label>
                <input type="text" class="form-control" id="Editora" name="Editora" value="{{ $livro->Editora }}" maxlength="40">
            </div>
            <div class="form-group">
                <label for="name">Edicao</label>
                <input type="text" class="form-control" id="Edicao" name="Edicao" value="{{ $livro->Edicao }}" maxlength="11">
            </div>
            <div class="form-group">
                <label for="name">Ano Publicação</label>
                <input type="text" class="form-control" id="AnoPublicacao" name="AnoPublicacao" value="{{ $livro->AnoPublicacao }}" maxlength="4">
            </div>
            <div class="form-group">
                <label for="name">Valor</label>
                <input type="text" class="form-control" id="Valor" name="Valor" value="{{ $livro->Valor }}" maxlength="10">
            </div>            
            <div class="row">
                <label for="autores[]">Autores</label>
                <select id="autores" name="autores[]" multiple="multiple">
                @foreach($autores as $autor)
                    <option value="{{ $autor->CodAu }}" {{ in_array($autor->CodAu , $livro->autores->pluck('CodAu')->toArray()) ? 'selected' : '' }}>{{ $autor->Nome }}</option>
                @endforeach                    
                 </select>
            </div>
            <div class="row">
                <label for="assuntos[]">Assuntos</label>
                <select id="assuntos" name="assuntos[]" multiple="multiple">
                @foreach($assuntos as $assunto)
                    <option value="{{ $assunto->CodAs }}" {{ in_array($assunto->CodAs , $livro->assuntos->pluck('CodAs')->toArray()) ? 'selected' : '' }}>{{ $assunto->Descricao }}</option>
                @endforeach   
                 </select>
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

    function validar() {
        if($('#Titulo').val() == '') {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Favor informar o campo Titulo!",
                footer: ''
            }).then((result) => {  
                $('#Titulo').focus();    
            });
            return false;
        }

        if($('#Editora').val() == '') {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Favor informar o campo Editora!",
                footer: ''
            }).then((result) => {  
                $('#Editora').focus();    
            });
            return false;
        }

        if($('#Edicao').val() == '') {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Favor informar o campo Edicao!",
                footer: ''
            }).then((result) => {  
                $('#Edicao').focus();    
            });
            return false;
        }

        if($('#AnoPublicacao').val() == '') {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Favor informar o campo Ano Publicação!",
                footer: ''
            }).then((result) => {  
                $('#AnoPublicacao').focus();    
            });
            return false;
        }

        if($('#Valor').val() == '') {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Favor informar o campo Valor!",
                footer: ''
            }).then((result) => {  
                $('#Valor').focus();    
            });
            return false;
        }
        
        if($('#autores').find(':selected').length == 0) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Favor informar pelo menos um Autor!",
                footer: ''
            }).then((result) => {  
                $('.js-example-basic-multiple').focus();    
            });
            return false;
        }

        if($('#assuntos').find(':selected').length == 0) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Favor informar pelo menos um Assunto!",
                footer: ''
            }).then((result) => {  
                $('.js-example-basic-multiple').focus();    
            });
            return false;
        }

        return true;
    }

    $(document).ready(function() {
        //toastr.success('Are you the 6 fingered man?')
        $('#autores').select2();
        $('#assuntos').select2();

        $('#Edicao').mask("00000000000");
        $('#AnoPublicacao').mask("0000");
        $('#Valor').mask("#.##0,00", {reverse: true});

        $('#voltar').on('click',function() {
            window.location.href = "{{ route('livros.index') }}";
        });

        $('#cadastrar').on('click',function() {
            if(validar()) {                
                $('#formLivro').submit();
            }
        });
    });
    </script>
@endsection