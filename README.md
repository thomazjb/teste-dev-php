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

# ROTAS DA API #

*Algumas rotas existem apenas para gerenciamento da própria aplicação.*

Para ver a documentação completa, acesse a rota `http://localhost/api/documentation` após subir a aplicação!

### Rotas Públicas (Sem Necessidade de Autenticação)

| Método | Endpoint                 | Descrição                 |
|--------|--------------------------|---------------------------|
| GET    | `/`                      | Página inicial            |
| POST   | `api/forgot-password`    | Recuperar senha           |
| POST   | `api/login`              | Login do usuário          |
| POST   | `api/reset-password`     | Redefinir senha           |
| POST   | `api/register`           | Registrar novo usuário    |

---

### Rotas Privadas (Requer Autenticação)

Para acesso à rotas privadas, você pode se registrar atavés da rota `api/register`, passando os parâmetros form-data:
- name: `Um nome legal`
- email: `seu@email.com`
- password: `senhadificil`
- password_confirmation: `senhadificil`

Ou utilizar o usuário padrão na autenticação da rota via Basic Auth:

Username: `admin@admin.com`
Password: `123456`

#### Fornecedores

| Método     | Endpoint                            | Descrição                          |
|------------|-------------------------------------|------------------------------------|
| GET        | `api/fornecedores`                 | Listar todos os fornecedores      |
| POST       | `api/fornecedores`                 | Criar um novo fornecedor          |
| GET        | `api/fornecedores/{fornecedores}`  | Detalhar um fornecedor específico |
| PUT/PATCH  | `api/fornecedores/{fornecedores}`  | Atualizar um fornecedor específico |
| DELETE     | `api/fornecedores/{fornecedores}`  | Excluir um fornecedor específico  |
| GET        | `api/fornecedores/buscar/{cnpj}`   | Buscar fornecedor pelo CNPJ       |



## COMO UTILIZAR ##

A instalação segue passos simples que todo dev conhece, a unica adição é o ambiente conteinerizado via SAIL, que depende da instalação e configuração do docker para o funcionamento do projeto.
Certifique-se de que ele está rodando antes de executar os passos à seguir; 
<a href="https://docs.docker.com/desktop/setup/install/windows-install/">Instalação Docker</a>

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
- Inclusão de Testes Automatizados;
- Inclusão de API externa;
- Repository Pattern;
- CRUD Básico de Fornecedor;
- Funcionalidade de API REST BÁSICA interna;
- Auth basico para rotas protegidas;
