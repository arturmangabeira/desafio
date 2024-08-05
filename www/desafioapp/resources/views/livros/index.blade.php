@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Listagem de Livros <a href="{{ route('livros.create') }}" class="btn btn-sm btn-primary">Novo</a> <a href="{{ route('livros.relatorio') }}" target="_blank" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-danger">Gerar Relatorio <i class="fa-regular fa-file-pdf"></i></a></h2>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Editora</th>
                        <th scope="col">Edição</th>
                        <th scope="col">Ano Publicação</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Autores</th>
                        <th scope="col">Assuntos</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($livros as $livro)
                        <tr>
                            <th scope="row">{{ $livro->Codl }}</th>
                            <td>{{ $livro->Titulo }}</td>
                            <td>{{ $livro->Editora}}</td>
                            <td>{{ $livro->Edicao}}</td>
                            <td>{{ $livro->AnoPublicacao}}</td>
                            <td>R$ @convert($livro->Valor)</td>
                            <td>
                                @if($livro->autores->count() > 0)                                                                     
                                    
                                    @foreach($livro->autores as $autor)
                                        <span class="badge bg-primary">{{ $autor->Nome }}</span>
                                    @endforeach
                                                                                        
                                @endif
                            </td>
                            <td>
                                @if($livro->assuntos->count() > 0)                             
                                    
                                    @foreach($livro->assuntos as $assunto)
                                        <span class="badge bg-primary">{{ $assunto->Descricao }}</span>    
                                    @endforeach
                                                                                
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('livros.show', ['livro' => $livro->Codl]) }}" class="btn btn-sm btn-primary">Ver</a>
                                <a
                                    href="{{ route('livros.edit', ['livro' => $livro->Codl]) }}"
                                    class="btn btn-sm btn-primary">
                                    Editar
                                </a>
                                
                                <button type="submit" class="btn btn-sm btn-danger btnExcluir" codl="{{ $livro->Codl }}" rota="{{route('livros.destroy',$livro->Codl)}}">Excluir</button>
                                
                            </td>
                        </tr>                        
                        
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-md-12">
            {{ $livros->links() }}
        </div>
        
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                <iframe src="{{ route('livros.relatorio') }}" width="100%" height="380" frameborder="0" sandbox="allow-same-origin allow-scripts allow-popups allow-forms allow-top-navigation"
                        allowtransparency="true"></iframe>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script>

    function validarExcluirLivro(url, codl)
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
                    excluirLivro(url);
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
            window.location="{{ route('livros.index') }}?sucessdestroy=true";
            }
        });
    }

    $(document).ready(function() {

        toastr.options.onHidden = function() { window.location="{{ route('livros.index') }}"; }

        //toastr.success('Are you the 6 fingered man?')
        
        $('#voltar').on('click',function() {
            window.location.href = "{{ route('livros.index') }}";
        });

        $('.btnExcluir').on('click',function(e) {
            e.preventDefault();
            validarExcluirLivro($(this).attr('rota'), $(this).attr('codl'));
        });
    });
    
    </script>
@endsection