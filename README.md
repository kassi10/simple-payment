
## Como executar
O composer deve estar instalado e php 7.4.3
1- Alterar o .env apontando para sua database do seu banco de dados
2- composer install
3- php artisan migrate
4- php artisan serve
A aplicação rodará na porta 8000

## Endpoints funcionais

GET USER:
GET http://localhost:8000/api/users/2

CREATE USER:
POST http://localhost:8000/api/users
{
	"name" : "JOAO",
  "cpf_cnpj":"2937328f38",
	"email":"JOAO@sod.com",
  "password":"123",
  "type":"seller",
	"balance":500
}

REALIZA TRANSAÇÃO
POST http://localhost:8000/api/transaction
{
	"receiver_id":2,
	"sender_id":1,
	"amount":1
}

## Testes -> apenas 1 teste realizado
php artisan test
