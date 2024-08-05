@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">        
            <div class="form-group">
                <label for="name">Titulo</label>
                <input type="text" class="form-control" id="Titulo" name="Titulo" value="{{ $livro->Titulo }}" readonly>
            </div>
            <div class="form-group">
                <label for="name">Editora</label>
                <input type="text" class="form-control" id="Editora" name="Editora" value="{{ $livro->Editora }}" readonly>
            </div>
            <div class="form-group">
                <label for="name">Edicao</label>
                <input type="text" class="form-control" id="Edicao" name="Edicao" value="{{ $livro->Edicao }}" readonly>
            </div>
            <div class="form-group">
                <label for="name">Ano Publicação</label>
                <input type="text" class="form-control" id="AnoPublicacao" name="AnoPublicacao" value="{{ $livro->AnoPublicacao }}" readonly>
            </div>
            <div class="form-group">
                <label for="name">Valor</label>
                <input type="text" class="form-control" id="Valor" name="Valor" value="{{ $livro->Valor }}" readonly>
            </div>            
            <div class="row col-md-1">
                <label for="autores[]">Autores</label>                
                @foreach($livro->autores as $autor)
                    <span class="badge bg-primary">{{ $autor->Nome }}</span>
                @endforeach                                    
            </div>
            <div class="row col-md-1">
                <label for="assuntos[]">Assuntos</label>                
                @foreach($livro->assuntos as $assunto)
                <span class="badge bg-primary">{{ $assunto->Descricao }}</span>    
                @endforeach                    
            </div>        
            <div class="row mt-2">
                <div class="col-md-1">                
                    <button type="button" id="voltar" class="btn btn-success">Voltar</button>                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    

    $(document).ready(function() {
        //toastr.success('Are you the 6 fingered man?')    
        $('#voltar').on('click',function() {
            window.location.href = "{{ route('livros.index') }}";
        });
    });
    </script>
@endsection