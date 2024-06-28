# Projeto Gestão de Vendas

O “Projeto Vendas” é uma aplicação backend de API REST que permite o cadastro de venda para vendedores calculando sua comissão de 8,5% sobre cada venda.

A aplicação possui rotas protegidas, sendo necessário que o usuário administrador faça o login para gerar o Json Web Token(JWT) para ter acesso às demais rotas de cadastro, visualização de vendas, edição e remoção de vendedores.

Requisitos necessários para utilizar a aplicação
PHP: Versão utilizada para o projeto: 7.4.3. Importante conferir se o PHP está instalado em sua máquina. Caso já o tenha instalado, poderá verificar a versão com o comando “php -v” ou “php –version”.

Composer: É recomendado a utilização do composer na versão 2.7.3. Para mais informações sobre como instalá-lo em sua máquina de acordo com sistema operacional que utiliza, acesse o site https://getcomposer.org/.

Apache: É importante ter o Apache instalado para que consiga inicializar o servidor local para o projeto. Para mais informações sobre como instalá-lo em sua máquina de acordo com sistema operacional que utiliza, acesse o sitehttps://www.ibm.com/docs/pt-br/rational-build-forge/8.0?topic=components-apache-http-server-installation-configuration.

Você também poderá optar pelo XAMPP para inicializar o servidor web e banco de dados local. Para mais informações sobre como instalá-lo em sua máquina de acordo com sistema operacional que utiliza, acesse o site https://www.apachefriends.org/pt_br/download.html.

Importante que tenha o Postman instalado em sua máquina. Caso não tenha, clique no link a seguir para realizar o download: https://www.postman.com/downloads/ 

## Lista de rotas:

Lista das rotas para utilizar no postamn(com o método http entre parênteses):

* **Login(Post)**: localhost:8000/api/login
* **Visualizar vendas(Get)**: localhost:8000/api/vendas
* **Cadastrar Vendas(Post)**: localhost:8000/api/app/vendas 
* **Visualizar venda específica(Get)**: localhost:8000/api/app/vendas/{venda}

* **Lista de vendedores(Get)**: localhost:8000/api/app/vendedores
* **Cadastrar Vendedor(Post)**: localhost:8000/api/app/vendedores
* **Visualizar vendedor específico:** localhost:8000/api/app/vendedores/{id}
* **Alterar cadastro completo do vendedor(Put)**: localhost:8000/api/app/vendedores/{id}
* **Alterar cadastro parcialmente do vendedor(Patch)**: localhost:8000/api/app/vendedores/{id}
* **Excluir vendedor(Delete)**: localhost:8000/api/app/vendedores/{id}

**Obs.: É importante verificar a porta ao inicializar o servidor. Por exemplo, caso ao inicializar o servidor na porta 3000 a URL será “localhost:3000”.**




## Fluxo da aplicação
Gerando o token de autenticação:

Abra o postman e abra uma nova aba de request.
Insira a URL: localhost:8000/api/login e selecione o método “POST”.
Na aba “Headers” em “Key” selecione a opção “Accept”. Em value, selecione a opção “application/json”.
Na aba “Body” selecione a opção “x-www-form-urlencoded”.
Em “key” digite “email” e “senha”. Em “value” insira o email “adm@adm.com.br” e a senha “123456”.
Será gerado o token para utilizar nas rotas protegidas.


## Vendedores
**Cadastro de vendedor:**
Selecione o método “Post” e insira a URL: localhost:8000/api/app/vendedores
Na aba “Authorization”, selecione a opção “Bearer Token” no campo Type e insira o token no campo Token.
Na aba “Headers” em “Key” selecione a opção “Accept”. Em value, selecione a opção “application/json”.
Na aba “Body” selecione a opção “x-www-form-urlencoded”.
Em “key” digite “nome_vendedor”, “email” e “senha”. Em “value” insira o nome do novo vendedor, o e-mail e a senha.



**Lista de vendedores:**
Selecione o método “GET” e insira a URL: localhost:8000/api/app/vendedores
Na aba “Authorization”, selecione a opção “Bearer Token” no campo Type e insira o token no campo Token.
Clique em “Send”.


**Pesquisa por Vendedor Específico:**

Selecione o método “GET” e insira a URL: localhost:8000/api/app/vendedores/{id} (Substitua o “{id}” pelo Id do vendedor que deseja consultar, por exemplo “1”).
Na aba “Authorization”, selecione a opção “Bearer Token” no campo Type e insira o token no campo Token.
Clique em “Send”.

**Alteração de cadastro de vendedor:**

- Atualização completa do cadastro:

Selecione o método “POST” e insira a URL: localhost:8000/api/app/vendedores/{id} (Substitua o “{id}” pelo Id do vendedor que deseja consultar, por exemplo “1”).
Na aba “Authorization”, selecione a opção “Bearer Token” no campo Type e insira o token no campo Token.
Na aba “Body” selecione a opção “x-www-form-urlencoded”.
Em “key” digite “nome_vendedor”, “email”, “senha” e “_method”. Em “value” insira o novo nome do vendedor, o novo e-mail, a nova senha e o método que neste caso será "put” .
Clique em “Send”.

- Atualização parcial do cadastro:

A atualização parcial seguirá o mesmo passo a passo descrito acima, exceto pelo método, que deverá ser substituído na key “_method” por “patch”.

**Excluir Vendedor:**

Selecione o método “DELETE” e insira a URL: localhost:8000/api/app/vendedores/{id} (Substitua o “{id}” pelo Id do vendedor que deseja consultar, por exemplo “1”).
Na aba “Authorization”, selecione a opção “Bearer Token” no campo Type e insira o token no campo Token.
Clique em “Send”.
—----------------------------------------------------------------------------------------------------------------------


## Vendas

**Lista de Vendas:**

Selecione o método “GET” e insira a URL: localhost:8000/api/app/vendas
Na aba “Authorization”, selecione a opção “Bearer Token” no campo Type e insira o token no campo Token.
Clique em “Send”.

**Inserir nova Venda:**

- Selecione o método “Post” e insira a URL: localhost:8000/api/app/vendas.
Na aba “Authorization”, selecione a opção “Bearer Token” no campo Type e insira o token no campo Token.
Na aba “Headers” em “Key” selecione a opção “Accept”. Em value, selecione a opção “application/json”.
Na aba “Body” selecione a opção “x-www-form-urlencoded”.
Em “key” digite “vendedor_id”, “valor_total”, “data_venda”. Em “value” insira o Id do o vendedor, o valor da venda e a data no formato YYYY-MM-DD.
Clique em “Send”.


**Consultar Venda específica:**

Selecione o método “GET” e insira a URL: localhost:8000/api/app/vendas/{id} (Substitua o “{id}” pelo Id da venda que deseja consultar, por exemplo “1”).
Na aba “Authorization”, selecione a opção “Bearer Token” no campo Type e insira o token no campo Token.
Clique em “Send”.


