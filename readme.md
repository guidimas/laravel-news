# Laravel News (Claiton News)

Sistema de notícias com upload de imagem e arquivos, utilizando o framework PHP [Laravel](https://laravel.com/), HTML, CSS e um pouquinho de JS.

Demo: [https://claitonnews.azurewebsites.net/](https://claitonnews.azurewebsites.net/) (upload de imagem/arquivo desabilitado por segurança).

## Primeiros Passos

Siga as instruções a seguir para informações sobre download, configuração e teste da aplicação em um ambiente local.

### Pré-requisitos

* [Composer](https://getcomposer.org/) instalado.

* Um servidor local, com PHP na versão 7.1.3 ou superior.

* Banco de dados¹ acessível.

* Um navegador! (com JS habilitado) :P

* 3 polichinelos (opcional).

*¹ A versão do Laravel utilizada no projeto (5.7), suporta os seguintes bancos de dados: MySQL, PostgreSQL, SQLite e SQL Server. [Clique aqui para mais detalhes e configuração.](https://laravel.com/docs/5.7/database)*

### Instalação

Inicie um terminal (CMD, prompt de comando) na pasta do projeto e execute o seguinte comando: `composer install`

### Configuração

Renomeie o arquivo *.env.example* para apenas *.env*

Altere o conteúdo deste arquivo, atualizando as informações de conexão, conforme exemplo:

    ...
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=NOME_DO_BANCO
    DB_USERNAME=USUARIO_DO_BANCO
    DB_PASSWORD=SENHA_DO_BANCO
    ...

Crie o banco de dados definido no endereço acima.

Com o SGBD no ar, pelo terminal, na pasta do projeto:

* Execute `php artisan key:generate` para dicionar uma hash de segurança no arquivo *.env*

* Execute  `php artisan migrate` para efetivar as migrações (cria as tabelas no banco)

* Execute  `php artisan storage:link` para criar um link simbólico da pasta `public/storage` para `storage/app/public` ([mais informações](https://laravel.com/docs/5.7/filesystem#introduction)).

## Iniciar a aplicação

Para iniciar a aplicação, execute o comando `php artisan serve` pelo terminal, na pasa do projeto.

A aplicação estará disponível no endereço indicado (por padrão, o endereço 
[http://127.0.0.1:8000](http://127.0.0.1:8000) é utilizado).

## Autor

**Guilherme Dimas** - *Desenvolvimento* - [GuiDimas](https://github.com/GuiDimas)

## Notas

Projeto desenvolvido como forma de estudo e utilização do framework PHP [Laravel](https://laravel.com/), em Aplicações Web que necessitam de um sistema de upload de imagens e arquivos com um sistema de armazenamento e download seguro.