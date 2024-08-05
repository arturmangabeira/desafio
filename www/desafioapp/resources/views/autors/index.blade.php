@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2>Listagem de Autores <a href="{{ route('autors.create') }}" class="btn btn-sm btn-primary">Novo Autor</a></h2>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Livros</th>                        
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($autores as $autor)
                        <tr>
                            <th scope="row">{{ $autor->CodAu }}</th>
                            <td>{{ $autor->Nome }}</td>                            
                            <td>
                            @if($autor->livros->count() > 0)                                                                     
                                    
                                @foreach($autor->livros as $livro)
                                    <span class="badge bg-primary">{{ $livro->Titulo }}</span>
                                @endforeach
                                                                                        
                            @endif
                            </td>
                            <td>
                                <a href="{{ route('autors.show', ['autor' => $autor->CodAu]) }}" class="btn btn-sm btn-primary">Ver</a>
                                <a
                                    href="{{ route('autors.edit', ['autor' => $autor->CodAu]) }}"
                                    class="btn btn-sm btn-primary">
                                    Editar
                                </a>
                                
                                <button type="submit" class="btn btn-sm btn-danger btnExcluir" codl="{{ $autor->CodAu }}" rota="{{route('autors.destroy',$autor->CodAu)}}" rotaValidar="{{route('autors.validar',$autor->CodAu)}}">Excluir</button>
                                
                            </td>
                        </tr>                                                
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-md-12">
            {{ $autores->links() }}
        </div>
        
    </div>
</div>
<script>

    function validarExcluir(url, codl, urlValidar)
    {
        Swal.fire({
            title: "Desaja realmente excluir esse registro ("+codl+") ?",
            text: "",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sim",
            confirmButtonCancel: "Não",
            }).then((result) => {
                if (result.isConfirmed) {
                    validarExcluirAutor(url, urlValidar);
                }
            });
    }

    function validarExcluirAutor(url, urlValidar)
    {
        $.ajax({
            type: 'get',     
            url: urlValidar,
            data: {
            '_method': 'get',
            "_token": "{{ csrf_token() }}",
            },
            success: function (response, textStatus, xhr) {                
                if(response.sucess) {
                    excluirLivro(url);
                } else {
                    toastr.error(response.message);
                }                
            }
        });
    }

    function excluirLivro(url)
    {        
        $.ajax({
            type: 'delete',     
            url: url,
            data: {
            '_method': 'delete',
            "_token": "{{ csrf_token() }}",
            },
            success: function (response, textStatus, xhr) {
            toastr.success('Registro excluído com sucesso !!');
            window.location="{{ route('autors.index') }}";
            }
        });
    }

    $(document).ready(function() {
        
        $('#voltar').on('click',function() {
            window.location.href = "{{ route('autors.index') }}";
        });

        $('.btnExcluir').on('click',function(e) {
            e.preventDefault();
            validarExcluir($(this).attr('rota'), $(this).attr('codl'), $(this).attr('rotaValidar'));
        });
    });
    </script>
@endsection