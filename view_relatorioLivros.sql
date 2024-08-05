reate view relatorioLivros AS
select l.Codl,l.Titulo,l.Editora ,l.Edicao ,l.AnoPublicacao ,l.Valor ,
	   a.CodAu , a.Nome ,
	   ass.CodAs , ass.Descricao 
from Livro l
inner join Livro_Autor la on la.Livro_Codl = l.Codl
inner join Livro_Assunto las on las.Livro_Codl  = l.Codl 
inner join Autor a on a.CodAu = la.Autor_CodAu
inner join Assunto ass on ass.CodAs = las.Assunto_CodAs 
group by l.Codl,l.Titulo,l.Editora ,l.Edicao ,l.AnoPublicacao ,l.Valor ,a.CodAu , a.Nome ,ass.CodAs , ass.Descricao 
order by a.Nome ASC
