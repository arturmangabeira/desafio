<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Desafio com Laravel 8</title>
    <!-- Fonts -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Styles -->
   
</head>
<body class="bg-light">
    <main role="main" class="container">
      <div class="d-flex align-items-center p-3 my-3 rounded box-shadow">        
        <div class="lh-100">          
          <h1>Relatório Livros</h2>
        </div>
      </div>
      @foreach($dadosRelatorio as $dados)
      
        <div class="my-3 p-3 bg-white rounded box-shadow">
            <h3 class="border-bottom border-gray pb-2 mb-0"><strong>Autor: {{$dados["Autor"]}} </strong></h3>
            <div class="media text-muted pt-3">          
                <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                    <strong class="d-block text-gray-dark">Livro(s) do Autor ({{count($dados["Livros"])}})</strong>                        
                </p>
            </div>
            <div class="container text-center">
            @foreach($dados["Livros"] as $livro)
                    <div class="row mt-2">
                      <div class="col"><strong>Titulo: {{$livro->Titulo}} </strong></div>
                      <div class="col">Editora: {{$livro->Editora}}</div>
                      <div class="col">Edição: {{$livro->Edicao}}</div>
                      <div class="col">Ano de publicação: {{$livro->AnoPublicacao}}</div>
                      <div class="col">Valor: R$ @convert($livro->Valor)</div>
                    </div>
                    <div class="media text-muted pt-3">          
                        <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                            @php $countAss = 0; @endphp
                            @foreach($dados["Assuntos"] as $assunto)                            
                            @if($assunto["Codl"] == $livro->Codl)                                
                            @php $countAss++; @endphp
                            @endif
                        @endforeach
                            <strong class="d-block text-gray-dark">Assunto(s) do Livro ({{ $countAss }})</strong>                        
                        </p>
                    </div>                    
                    <div class="row">                        
                        @foreach($dados["Assuntos"] as $assunto)                            
                            @if($assunto["Codl"] == $livro->Codl)                                
                                <div class="col">{{ $assunto["Descricao"] }}</div>                        
                            @endif
                        @endforeach
                    </div>
                    <div class="media text-muted pt-3">          
                        <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">                           
                        </p>
                    </div>                    
                    @endforeach
                </div>
        </div>
      @endforeach
    </main>

<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" preserveAspectRatio="none" style="display: none; visibility: hidden; position: absolute; top: -100%; left: -100%;"><defs><style type="text/css"></style></defs><text x="0" y="2" style="font-weight:bold;font-size:2pt;font-family:Arial, Helvetica, Open Sans, sans-serif">32x32</text></svg></body>
</html>