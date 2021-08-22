# Teste Técnico 123 milhas

**Postman Collection:** <https://www.getpostman.com/collections/10a3b9ca381ec5f3d84d>
<br>
*Nota: Link para ambiente local*

# Visão geral
A API retorna voos agrupados em voos de ida e volta, tarifa e preços, após uma consulta a outra API externa.

# Descrição
A API foi construída utilizando o framework Laravel `8.55`.

# Requisitos

- PHP maior ou igual 7.3.0
- composer

## Laravel
- PHP >= 7.3
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

# Instalação
Clonar o projeto

```bash
git clone git@github.com:wandsdev/avaliacao_123milhas.git
```

Instalar as dependências através do composer
```bash
composer install
```
Criar o arquivo `.env`
```bash
cp .env.example .env
```
Gerar chave da applicação Laravel
```bash
php artisan key:generate
```

Iniciar o servidor local
```bash
php artisan serve
```
# Autenticação
Não é necessário autenticação
# Rotas
A API disponibiliza apenas uma rota

path: **"/flights-grouping"**

Ambiente local

Tipo: **GET**
```
http://127.0.0.1:8000/api/flights-grouping
```

Ambiente de produção

Tipo: **GET**
```
https://www.wandsdev.tech/api/flights-grouping
```

Exemplo de response
```json
{
    "flights": [...],
    "groups": [
        {
            "uniqueId": "MTIzRzMtMTcwMUFELTExMTFMQS0yMjIyOTEwTEEtNTU1NUFELTY2MDY=",
            "totalPrice": 200,
            "outbound": [
                {
                    "id": 1,
                    "cia": "GOL"
                }
            ],
            "inbound": [
                {
                    "id": 9,
                    "cia": "LATAM"
                }
            ]
        }
    ],
    "totalGroups": 10,
    "totalFlights": 15,
    "cheapestPrice": 200,
    "cheapestGroup": "MTIzRzMtMTcwMUFELTExMTFMQS0yMjIyOTEwTEEtNTU1NUFELTY2MDY="
}
```
