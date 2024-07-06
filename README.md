# Projeto Gestão de Vendas

[Requisitos](#requisitos-necessários-para-utilizar-a-aplicação) |
[Lista de Rotas](#lista-de-rotas) |
[Preparando o Ambiente](#preparando-o-ambiente) |
[Token de autenticação](#gerando-o-token-de-autenticação) |
[Vendedores](#vendedores) |
[Vendas](#vendas) |
[Testes](#testes)

O “Projeto Gestão de Vendas” é uma aplicação backend de API REST que permite o cadastro de venda para vendedores calculando sua comissão de 8,5% sobre cada venda e o envio diário de um relatório por e-mail com as vendas do dia.

A aplicação possui rotas protegidas, sendo necessário que o usuário administrador faça o login para gerar o Json Web Token(JWT) para ter acesso às demais rotas de cadastro, visualização de vendas, edição e remoção de vendedores.

## Requisitos necessários para utilizar a aplicação

**PHP**: Versão utilizada para o projeto: 7.4.3. Laravel Framework 8.83.27. Importante conferir se o PHP está instalado em sua máquina. Caso já o tenha instalado, poderá verificar a versão com o comando `php -v` ou `php –version`. Para verificar a versão do laravel, utilize o comando `php artisan --version`

**Composer**: É recomendado a utilização do composer na versão 2.7.3. Para instalar o composer, rode o comando `composer install
`.

**Apache**: É importante ter o Apache instalado para que consiga inicializar o servidor local para o projeto. Para mais informações sobre como instalá-lo em sua máquina de acordo com sistema operacional que utiliza, acesse o site https://www.ibm.com/docs/pt-br/rational-build-forge/8.0?topic=components-apache-http-server-installation-configuration.

Você também poderá optar pelo XAMPP para inicializar o servidor web e banco de dados local. Para mais informações sobre como instalá-lo em sua máquina de acordo com sistema operacional que utiliza, acesse o site https://www.apachefriends.org/pt_br/download.html.

Importante que tenha o **Postman** instalado em sua máquina. Caso não tenha, clique no link a seguir para realizar o download: https://www.postman.com/downloads/ 

## Lista de rotas:

Lista das rotas para utilizar no postman(com o método http entre parênteses):

* **Login(Post)**: /api/login
* **Visualizar vendas(Get)**: /api/vendas
* **Cadastrar Vendas(Post)**: /api/app/vendas 
* **Visualizar venda específica(Get)**: /api/app/vendas/{id}

* **Lista de vendedores(Get)**: /api/app/vendedores
* **Cadastrar Vendedor(Post)**: /api/app/vendedores
* **Visualizar vendedor específico(Get):** /api/app/vendedores/{id}
* **Alterar cadastro completo do vendedor(Put)**: /api/app/vendedores/{id}
* **Alterar cadastro parcialmente do vendedor(Patch)**: localhost:8000/api/app/vendedores/{id}
* **Excluir vendedor(Delete)**: /api/app/vendedores/{id}


## Fluxo da aplicação

### Preparando o ambiente:

Crie o arquivo .env na pasta raiz. Você poderá utilizar o arquivo .env.example como base. 

- Para configurar o banco de dados siga o exemplo abaixo(Os campos devem ser preenchidos de acordo com as informações do banco de dados que irá utilizar):

```php
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=Nome_do_banco_de_dados
DB_USERNAME=root
DB_PASSWORD='Senha do Banco de Dados'
```

Rode o comando `php artisan migrate` para criar as tabelas no Banco de dados.

Rode o comando `php artisan db:seed --class=UserSeeder` para criar o usuário administrador na tabela "users".

***
- Para configurar o e-mail, certifique-se de que seu arquivo .env contenha as seguintes configurações para o envio de e-mails através do SMTP do Outlook (ou qualquer outro provedor que você esteja usando):

```php
MAIL_MAILER=smtp
MAIL_HOST=smtp-mail.outlook.com
MAIL_PORT=587
MAIL_USERNAME=teste@outlook.com
MAIL_PASSWORD=SuaSenhaAqui
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=teste@outlook.com
MAIL_FROM_NAME="${APP_NAME}"
```

***

No arquivo app/Console/Commands/SendDailySalesReport.php, insira o e-mail de recebimento do relatório na linha de código conforme demonostrado abaixo:

`Mail::to('teste@teste.com')->send(new DailySalesReport($vendas_do_dia, $totalVendas));`

No arquivo app/Console/Kernel.php defina a rotina de e-mail na linha de código conforme demonstrado abaixo:

```$schedule->command('sales:send-report')->dailyAt('05:18')```

Após estas configurações, rodar o comando `php artisan sales:send-report` para configurar o disparo automático do e-mail como relatório de vendas.

***

## Instalando o Json Web Token

- Para instalar o Json Web Token(JWT), rode o comando `composer require tymon/jwt-auth "1.0.2"`

Após isso, rode o comando `php artisan jwt:secret` para gerar uma chave secreta no arquivo .env.


## **Gerando o token de autenticação**:
***

1. Abra o postman e abra uma nova aba de request.
2. Utilize o endpoint: /api/login e selecione o método “POST”.
3. Na aba “Headers” em “Key” selecione a opção “Accept”. Em value, selecione a opção “application/json”.
4. Na aba “Body” selecione a opção “x-www-form-urlencoded”.
5. Em “key” digite “email” e "password". Em “value” insira o email “adm@adm.com.br” e a senha “123456”.
6. Clique em "Send".
7. Será gerado o token para utilizar nas rotas protegidas.


## Vendedores
**Cadastro de vendedor:**
1. Selecione o método “Post” e utilize o endpoint: /api/app/vendedores
2. Na aba “Authorization”, selecione a opção “Bearer Token” no campo Type e insira o token no campo "Token".
3. Na aba “Headers” em “Key” selecione a opção “Accept”. Em value, selecione a opção “application/json”.
4. Na aba “Body” selecione a opção “x-www-form-urlencoded”.
5. Em “key” digite “nome_vendedor”, “email” e “senha”. Em “value” insira o nome do novo vendedor, o e-mail e a senha.
6. Clique em "Send".



**Lista de vendedores:**
1. Selecione o método “GET” e utilize o endpoint: /api/app/vendedores
2. Na aba “Authorization”, selecione a opção “Bearer Token” no campo "Type" e insira o token no campo "Token".
3. Clique em “Send”.


**Pesquisa por Vendedor Específico:**

1. Selecione o método “GET” e utilize o endpoint: /api/app/vendedores/{id} (Substitua o “{id}” pelo Id do vendedor que deseja consultar, por exemplo “1”).
2. Na aba “Authorization”, selecione a opção “Bearer Token” no campo "Type" e insira o token no campo "Token".
3. Clique em “Send”.

**Alteração de cadastro de vendedor:**

- Atualização completa do cadastro:

1. Selecione o método “POST” e utilize o endpoint: /api/app/vendedores/{id} (Substitua o “{id}” pelo Id do vendedor que deseja consultar, por exemplo “1”).
2. Na aba “Authorization”, selecione a opção “Bearer Token” no campo Type e insira o token no campo "Token".
3. Na aba “Body” selecione a opção “x-www-form-urlencoded”.
4. Em “key” digite “nome_vendedor”, “email”, “senha” e “_method”. Em “value” insira o novo nome do vendedor, o novo e-mail, a nova senha e o método, que neste caso será "put” .
5. Clique em “Send”.

- Atualização parcial do cadastro:

1. A atualização parcial seguirá o mesmo passo a passo descrito acima, exceto pelo método, que deverá ser substituído na key “_method” por “patch” e pela possibilidade de alterar somente uma das informaações do cadastro do vendedor.

**Excluir Vendedor:**

1. Selecione o método “DELETE” e utilize o endpoint: /api/app/vendedores/{id} (Substitua o “{id}” pelo Id do vendedor que deseja consultar, por exemplo “1”).
2. Na aba “Authorization”, selecione a opção “Bearer Token” no campo Type e insira o token no campo "Token".
3. Clique em “Send”.


## Vendas

**Lista de Vendas:**

1. Selecione o método “GET” e utilize o endpoint: /api/app/vendas
2. Na aba “Authorization”, selecione a opção “Bearer Token” no campo "Type" e insira o token no campo "Token".
3. Clique em “Send”.

**Inserir nova Venda:**

1. Selecione o método "POST" e utilize o endpoint: /api/app/vendas.
2. Na aba “Authorization”, selecione a opção “Bearer Token” no campo "Type" e insira o token no campo "Token".
3. Na aba “Headers” em “Key” selecione a opção “Accept”. Em "value", selecione a opção “application/json”.
4. Na aba “Body” selecione a opção “x-www-form-urlencoded”.
5. Em “key” digite “vendedor_id”, “valor_total”, “data_venda”. Em “value” insira o Id do o vendedor, o valor da venda e a data no formato YYYY-MM-DD.
6. Clique em “Send”.


**Consultar Venda específica:**

1. Selecione o método “GET” e utilize o endpoint: /api/app/vendas/{id} (Substitua o “{id}” pelo Id da venda que deseja consultar, por exemplo “1”).
2. Na aba “Authorization”, selecione a opção “Bearer Token” no campo Type e insira o token no campo Token.
3. Clique em “Send”.


## Testes

Com o objetivo de colocar em prática o conhecimento que estou adquirindo estudando testes unitários, foi adicionado o arquivo tests/Feature/UpdateTest.php.

Basicamente este teste consiste em consultar a execução da atualização do cadastro de um vendedor através do verbo PUT no seguinte fluxo:

* Criação de um vendedor;
* Autenticação do usuário;
* Dados para a requisição PUT;
* Requisição PUT autenticada;
* Verificações da resposta;
* Verificação da senha.

 Para executar o teste configurado, utilize o comando `php artisan test --filter=test_update`.



**Desenvolvido por Maicon Cesário** - [Linkedin](https://www.linkedin.com/in/maicon-cesario/)