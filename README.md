<h4 align="center">
  🚀 Sudeste Online - Teste técnico
</h4>

<p align="center">
 <img src="https://img.shields.io/static/v1?label=PRs&message=welcome&color=7159c1&labelColor=000000" alt="PRs welcome!" />

  <img alt="License" src="https://img.shields.io/static/v1?label=license&message=MIT&color=7159c1&labelColor=000000">
</p>

<p align="center">
  <a href="#rocket-tecnologias">Tecnologias</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-projeto">Projeto</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-funcionalidades">Funcionalidades</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-requisitos">Requisitos</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-instalação">Instalação</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
</p>

<br>

## :rocket: Tecnologias

Esse projeto foi desenvolvido com as seguintes tecnologias:

- [Laravel 7](https://laravel.com)
- [MySQL 5.7](https://mysql.com)
- [Docker](https://docker.com)


## 💻 Projeto

Esse projeto é uma API Restful desenvolvida como teste técnico para o processo seletivo de Desenvolvedor Fullstack na Sudeste Online.
O sistema possui **testes automatizados** para todos os recursos criados.


## 💻 Funcionalidades

O sistema possui cadastros de produtos, culturas, pragas, dosagens assim como relatório de dosagens em PDF e sistema de autenticação usando JWT

## 📄 Requisitos

* PHP 7.2+, Laravel 7+, MySQL 5.7+ e Docker


## ⚙️ Instalação e execução

**Windows, OS X & Linux:**

Baixe o arquivo zip e o descompacte ou baixe o projeto para sua máquina através do git clone [https://github.com/randercarlos/lotus-sales-frontend.git](https://github.com/randercarlos/lotus-sales-frontend.git)


- Entre no prompt de comando e vá até a pasta do projeto:

```sh
cd ir-ate-a-pasta-do-projeto
```

- Crie o arquivo .env a partir do arquivo .env.example. As variáveis de ambiente relacionadas ao banco já estão configuradas.

```sh
copy .env.example .env
```

- Assumindo que tenha o docker instalado na máquina, execute o comando:

```sh
docker-compose up
```

- Aguarde até que toda os serviços estejam ativos e as dependências do laravel estejam instaladas e as migrações instaladas. 
No final, o Docker mostrará uma mensagem de que o Laravel estará rodando em [http://localhost:3000](http://localhost:3000).

- Se não tiver usando o Docker, basta rodar: 
  
```sh
php artisan serve
```
e o projeto está rodando em [http://localhost:8000](http://localhost:8000). 

- Após o comando acima, abra um novo terminal, vá até a pasta do projeto e rode o comando abaixo para popular o banco:

```sh
docker-compose exec laravel php artisan db:seed
```

- (opcional) Para executar os testes automatizados, rode o comando:
```sh
docker-compose exec laravel php artisan test
```

## 📝 Documentação

- [HTML Estático (contém somente os endpoints. Não contém detalhes de parâmetros, campos e corpo de requisições) - Swagger(OpenApi v2)](sudeste-online.swagger.html)
- [Formato Yaml - Swagger(OpenApi v2)](sudeste-online.swagger.yml)
- [Insomnia Endpoints Collection](sudeste-online.insomnia.json) (Para importar, clique no menu "Application" => Preferences => Data => Clique em "Import Data" => "From File" => selecione o arquivo e clique em "Import")
- [Postman Endpoints Collection](sudeste-online.postman_collection.json)

Desenvolvido por Rander Carlos :wave: [Linkedin!](https://www.linkedin.com/in/rander-carlos-caetano-freitas-308a63a8/)
