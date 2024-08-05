<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Relatorio Livros - Desafio</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        table{
            font-size: x-small;
        }
        tfoot tr td{
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }
    </style>
</head>
<body>

  <table width="100%">
    <tr>
        <td valign="top"></td>        
    </tr>

  </table>

  <table width="100%">
    <tr>        
        <td align="center"><strong> <h2>Relatório de Livros</h2> </strong></td>
    </tr>
  </table>

  <br/>

  <table width="100%">
    <tr>        
        <td align="center"><strong><h3>({{count($dadosRelatorio)}}) Autores</strong></h3></td>
    </tr>
  </table>

  <br />
  @foreach($dadosRelatorio as $dados)
  <table width="100%">
    <tr>        
        <td align="center"><strong>Autor: {{$dados["Autor"]}} - ({{count($dados["Livros"])}}) Livro</strong></td>
    </tr>
    @foreach($dados["Livros"] as $livro)
    <tr style="margin-top: 10%;">
        <td>
            <table width="100%">
                <thead style="background-color: lightgray;">
                  <tr>
                    <th>#</th>
                    <th>Titulo</th>
                    <th>Editora</th>
                    <th>Edição</th>
                    <th>Ano de publicação</th>
                    <th>Valor</th>
                  </tr>
                </thead>
                <tbody>                  
                  <tr>
                    <th scope="row">{{$livro->Codl}}</th>
                    <td><strong>{{$livro->Titulo}}</strong></td>
                    <td>{{$livro->Editora}}</td>
                    <td>{{$livro->Edicao}}</td>
                    <td>{{$livro->AnoPublicacao}}</td>
                    <td align="right">@convert($livro->Valor)</td>
                  </tr>
                    @php $countAss = 0; @endphp
                    @foreach($dados["Assuntos"] as $assunto)                            
                        @if($assunto["Codl"] == $livro->Codl)                                
                            @php $countAss++; @endphp
                        @endif
                    @endforeach                    
                  <tr>
                    <td colspan="6">
                        <table width="100%">
                            <thead style="background-color: lightgray;">
                              <tr>                    
                                <th>Assunto ({{ $countAss }})</th>                    
                              </tr>
                            </thead>
                            @foreach($dados["Assuntos"] as $assunto)                            
                            @if($assunto["Codl"] == $livro->Codl)  
                            <tbody>
                              <tr>                    
                                <td>{{ $assunto["Descricao"] }}</td>                    
                              </tr>                              
                            </tbody>
                            @endif           
                            @endforeach
                          </table>
                    </td>
                  </tr>                  
                  
                </tbody>
              </table>
        </td>
    </tr>
    @endforeach    
  </table>
  <br /><br />
 @endforeach 
</body>
</html>