# API SIMPLES DE FORNECEDOR #

Esta é uma simples aplicação de cadastro e gerenciamento de fornecedores. Tem como principal função, a demonstração da comunicação via REQUEST's HTTP de uma API Rest;
Possui um sistema de autenticação de rota Oauth Básico através de e-mail e senha. Testes automatizados Utiliza Repository Pattern para abstração de Models com os Controllers, permitindo maior flexibilidade ao interagir com a camada de Dados. 

# TECNOLOGIAS #
- PHP 8.3;
- LARAVEL 11;
- PHPUNIT;
- AMBIENTE DOCKERIZADO VIA SAIL;
- MYSQL;
- PHPMYADMIN;

## COMO UTILIZAR ##

A instalação segue passos simples que todo dev conhece, a unica adição é o ambiente conteinerizado via SAIL, que depende da instalação e configuração do docker para o funcionamento do projeto.
Certifique-se de que ele está rodando antes de executar os passos à seguir;

1. Clone este repositório:

   ```
   git clone https://github.com/thomazjb/teste-dev-php.git
   ```

2. entre no repositório:

   ```
   cd teste-dev-php
   ```

3. Faça o build da aplicação:
    *para esta parte, talvez seja necessário a instalação e configuração do docker no seu computador*
   ```
   ./vendor/bin/sail composer install
   ```

4. Levante o conteiner da aplicação:

   ```
   ./vendor/bin/sail up -d
   ```

5. Copie o arquivo de ambiente de exemplo:

   ```
   cp .env.example .env
   ```
   
6. Execute as migrações do banco de dados para criar as tabelas necessárias:

   ```
   sail artisan migrate
   ```

7. Acesse a aplicação utilizando o navegador para verificar a disponibilidade:

   ```
   https://localhost
   ```

8. Execute os testes automatizados para validar a integridade da aplicação:

   ```
   ./vendor/bin/sail artisan test
   ```
   
9. A aplicação está pronta:
    Se os testes e disponibilidade estiverem ok, utilize PostMAN ou qualquer outra ferramenta que possibilite o envio de requisições HTTP.
   
10. Seja Feliz

   ```
   Talvez o passo mais importante que você irá dar.
   ```

## Já Feito ##
- Inclusão de Testes Automatizados
- Inclusão de API externa
- Repository Pattern
- CRUD Básico de Fornecedor
- Funcionalidade de API REST BÁSICA interna
