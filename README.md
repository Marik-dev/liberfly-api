# Projeto API RESTful com Laravel 11

O projeto trata-se de uma API desenvolvida em Laravel 11 que recebe informações de um banco de dados MySQL, além do cadastro e autenticação para o acesso à API. A API está utilizando autenticação JWT e foi documentada com Swagger. 

## Pré-requisitos

Para o funcionamento correto do projeto é necessário:

- Laravel 8.2 - 8.3
- Composer
- MySQL

## Instalação

Agora o passo a passo de como executar o projeto.

### 1. Clone o Repositório
`git clone https://github.com/Marik-dev/liberfly-api.git`
`cd liberfly-api`
### 2. Instale as dependências do projeto
`composer install`
### 3. Configure o .env
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=banco
DB_USERNAME=usuario
DB_PASSWORD=senha

JWT_SECRET=chave_jwt
```
### 4. Gere a chave da aplicação
```
php artisan key:generate
php artisan jwt:secret
```
### 5. Execute as migrações
`php artisan migrate`
### 6. Execute o projeto
`php artisan serve`

# Uso

## Cadastro de usuário

Para registrar um novo usuário, envie uma requisição POST para /api/register com os seguintes campos:
- name: Nome do usuário
- email: Email do usuário
- password: Senha do usuário

Se quiser, você pode testar tanto no Postman ou outra plataforma. Segue exemplo em CURL:
`curl -X POST http://127.0.0.1:8000/api/register -d "name=Rafael Liberfly&email=rafaelliberfly@teste.com&password=senha123"`
### Imagem exemplo
![Imagem exemplo do Cadastro](https://github.com/user-attachments/assets/271fd55b-7ee4-4fac-899b-3f5f60645bba)

## Login de usuário

Assim como no cadastro, é necessário realizar um POST indicando o login e senha. Nesse projeto estou utilizando o e-mail como login mesmo:
- email: Email do usuário
- password: Senha do usuário

Nas funções do UserController devolvo o token no cadastro ou login do usuário. Dito isso, após autenticado você receberá uma `response` em JSON com o JWT Token.
### Imagem exemplo
![Imagem exemplo de Login](https://github.com/user-attachments/assets/405e5ded-61a3-4e4b-8606-d595f907aac6)

## Listar registros

Para listar os registros, basta enviar um GET para a rota `/api/registros/` passando o token no header.
Exemplo em CURL:

`curl -H "Authorization: Bearer TOKEN_AQUI" http://127.0.0.1:8000/api/registros`
### Imagem exemplo
![Imagem exemplo dos registros listados](https://github.com/user-attachments/assets/ff753fd8-ad66-4854-9e79-6397ee539991)

### Obter um registro específico

A mesma coisa do passo anterior, mas passando um parâmetro na URL.
Exemplo em CURL:

`curl -H "Authorization: Bearer TOKEN_AQUI" http://127.0.0.1:8000/api/registros/1`

# Documentação da API

A documentação Swagger está disponível em http://127.0.0.1:8000/api/documentation
