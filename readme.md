
## Sobre o Sistema Caixa Livre

O Sistema Caixa Livre foi criado utilizando a Framework Laravel. Com ele é possível fazer um pequeno controle de lançamentos de um caixa, tanto para os pagamentos quanto os recebimentos.

## Como utilizar?

Copie para o seu diretório, dentro de um servidor web. Caso esteja utilizando o Xampp, siga os passos:
1o) Copie e cole a sua pasta dentro da subpasta htdocs.
2o) Execute o Xampp
3o) Abre o cmd do windows e navegue até a que foi criada.
4o) Digite: php artisan serve

Pronto! Seu sistema deve estar executando. Para testá-lo abre o seu navegador e digite: http://localhost:8000/

## API

O sistema também possui uma API que retorna um resumo das movimentações do dia.

Primeiro é necessário fazer login via API.
Usando o método POST para o endereço http://localhost:8000/api/login
Não esqueça de passar os parâmetros:
- email: informando o seu email de login
- password: senha de login
<img src="http://projetodaminhavida.com.br/images/login.png" alt="Como fazer login via API">

O sistema irá retornar um token. Guarde esse token para poder usar a próxima rota.

Para saber o resumo da movimentação diária, deverá ser usado o método GET para a rota http://localhost:8000/api/caixa
Passando os parâmetros dentro do Headers:
- Accept : application/json
- Authorization: Bearer + o token retornado do login
<img src="http://projetodaminhavida.com.br/images/caixa.png" alt="Retornando o resumo da movimentação via API">




