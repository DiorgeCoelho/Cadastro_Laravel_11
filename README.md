# SCP - Sistema de Cadastro de Produtos

## Descrição

O **Sistema de Cadastro** é um Sistema de cadastro de produtos online desenvolvido em Laravel 11. Com uma interface intuitiva, utilizando modais Bootstrap para Cadastrar, Editar, e visualizar produtos. No desenvolvimeto foi utilizado codigo Simplificado para um maior entedimento. O sistema utiliza requisições AJAX para enviar as informações para as modais.

## Imagem do Projeto 📸

**Home Produtos**
![Home Produtos](public/images/HomeProduto.png)

**Cadastrar Produto**
![Cadastrar Produto](public/images/CadastoModal.png)

**Editar Produto**
![Editar Produto](public/images/EditarModal.png)

**Visualizar Produto**
![Visualizar Produto](public/images/VisualizarProduto.png)

## Pré-requisitos

Antes de começar, certifique-se de ter os seguintes pré-requisitos instalados em sua máquina:

<!-- - **PHP** (versão 7.4 ou superior) - [Download PHP](https://www.php.net/downloads) Esse projeto foi feito utilizando a versão 8.2.24 -->

- **Composer** (para gerenciar dependências do PHP) - [Download Composer](https://getcomposer.org/download/)  Não há necessidade de nenhuma alteração na configuração padrão 

- **PostgreSQL** - [Download PostgreSQL](https://www.postgresql.org/) 

- **Laravel Herd** (para ambiente local. Vem com o php instalado e o servidor web NGINX) - [Laravel Herd](https://herd.laravel.com/windows) Não há necessidade de nenhuma alteração na configuração padrão 


## Instalação

Siga os passos abaixo para configurar o projeto em sua máquina local:

1. **Clone o repositório**

   - Abra o terminal e execute:
     ```bash
     https://github.com/DiorgeCoelho/SistemaDeCadastro.git
     cd notes
     ```

2. **Instale as dependências com Composer**

   - Execute o seguinte comando na pasta do projeto:
     ```bash
     composer install
     ```

3. **Configuração do Ambiente**

   - Renomeie o arquivo `.env.example` para `.env`:
     ```bash
     cp .env.example .env
     ```
   - Abra o arquivo `.env` e configure as informações do banco de dados, como:
     ```env
     DB_CONNECTION=pgsql
     DB_HOST=127.0.0.1
     DB_PORT=5432
     DB_DATABASE=SistemaCadastro (o nome e de sua escolha, mais tanto aqui como no banco tem que ser o mesmo)
     DB_USERNAME=postgres (Por padrão o banco de dados cria esse usuários )
     DB_PASSWORD= (a senha vc cria na hora da instalação)
     ```

4. **Crie o banco de dados**

   - Use o PostgreSQ para criar um banco de dados com o nome especificado em `DB_DATABASE`.

5. **Gere a chave de aplicativo**

   - Execute o comando a seguir para gerar uma chave única para o aplicativo:
     ```bash
     php artisan key:generate
     ```

6. **Executar as migrações**

   - Para criar as tabelas necessárias no banco de dados, execute:
     ```bash
     php artisan migrate
     ```

7. **Inicie o servidor**

   - Você pode iniciar o servidor integrado do Laravel com o seguinte comando:
     ```bash
     php artisan serve
     ```
   - O aplicativo estará disponível em `http://localhost:8000`.

<!-- ## Utilização

1. **Acessando o Aplicativo**

   - Abra o navegador e vá para `http://localhost:8000`.

2. **Login**

   - Para logar na aplicação você pode usar um dos três usuários já criados.

   - Eles são:

   - user1@gmail.com
   - user2@gmail.com
   - user3@gmail.com

   - Todos os usuários possuem uma senha padrão (abc123456)

3. **Criando Anotações**

   - Após o login, você verá a interface principal.
   - Clique em "Nova Nota" para criar uma nova anotação.
   - Preencha o título e o conteúdo da nota e clique em "Salvar".

4. **Editando e Excluindo Anotações**

   - Para editar uma nota, clique no ícone de edição ao lado da nota.
   - Para excluir, clique no ícone de exclusão. -->

## Contribuição

Se você deseja contribuir para o projeto, sinta-se à vontade para abrir uma issue ou enviar um pull request.
