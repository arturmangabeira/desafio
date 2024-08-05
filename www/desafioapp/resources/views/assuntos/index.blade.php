@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2>Listagem de Assuntos <a href="{{ route('assuntos.create') }}" class="btn btn-sm btn-primary">Novo Assunto</a></h2>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Assunto</th>
                        <th scope="col">Livros</th>                        
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($assuntos as $assunto)
                        <tr>
                            <th scope="row">{{ $assunto->CodAs }}</th>
                            <td>{{ $assunto->Descricao }}</td>                            
                            <td>
                            @if($assunto->livros->count() > 0)                                                                     
                                    
                                @foreach($assunto->livros as $livro)
                                    <span class="badge bg-primary">{{ $livro->Titulo }}</span>
                                @endforeach
                                                                                        
                            @endif
                            </td>
                            <td>
                                <a href="{{ route('assuntos.show', ['assunto' => $assunto->CodAs]) }}" class="btn btn-sm btn-primary">Ver</a>
                                <a
                                    href="{{ route('assuntos.edit', ['assunto' => $assunto->CodAs]) }}"
                                    class="btn btn-sm btn-primary">
                                    Editar
                                </a>
                                
                                <button type="submit" class="btn btn-sm btn-danger btnExcluir" codl="{{ $assunto->CodAs }}" rota="{{route('assuntos.destroy',$assunto->CodAs)}}" rotaValidar="{{route('assuntos.validar',$assunto->CodAs)}}">Excluir</button>
                                
                            </td>
                        </tr>                                                
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-md-12">
            {{ $assuntos->links() }}
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
                    validarExcluirAssuntos(url, urlValidar);
                }
            });
    }

    function validarExcluirAssuntos(url, urlValidar)
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
                    excluirAssunto(url);
                } else {
                    toastr.error(response.message);
                }                
            }
        });
    }

    function excluirAssunto(url)
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
            window.location="{{ route('assuntos.index') }}";
            }
        });
    }

    $(document).ready(function() {
        //toastr.success('Are you the 6 fingered man?')
        
        $('#voltar').on('click',function() {
            window.location.href = "{{ route('assuntos.index') }}";
        });

        $('.btnExcluir').on('click',function(e) {
            e.preventDefault();
            validarExcluir($(this).attr('rota'), $(this).attr('codl'), $(this).attr('rotaValidar'));
        });
    });
    </script>
@endsection