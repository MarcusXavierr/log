## Backend

O projeto é um backend de um mini BI de vendas.

Foi utilizado php 8.2 e Laravel 9 para criar esse projeto

A estrutura do banco de dados é composta por uma tabela de vendas, outra tabela de produtos, e uma "tabela intermédiaria" que não guarda só quais produtos estão em quais vendas, mas também materializa o preço dos produtos no momento da venda

Boa parte dos serviços (tanto usados pelos controllers como usados para gerar dados aleatorios) foram desenvolvidos com o workflow do TDD, onde testes e código de produção vão evoluindo juntos

Existe um endpoint para buscar todos os dados para montar os graficos na dashboard, e outros dois endpoints de detalhamento, um para produtos e outro para vendas.

Todos os endpoints aceitam os mesmos filtros de `Data da venda`, `Região da venda`, `Range de preço do produto` e `Nome do produto`.

