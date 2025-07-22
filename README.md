<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

Que a força esteja com você!

# 📖 Blog

Projeto em laravel de uma API para gerenciar requisições HTTP de um blog.

## ⚙️ Tecnologias Utilizadas

- PHP 8.3
- Laravel 12
- Composer
- Git
- Docker
- SQL

## 💡 Funcionalidades
- []
- [] 

## 🏗️ Estrutura do Projeto

Abaixo está a organização das principais pastas e arquivos deste projeto Laravel:

### 📂 Diretórios Principais

- **app/**  
  Contém a lógica de negócio da aplicação:
  - `Http/`: Classes de controladores e middlewares.
  - `Models/`: Classes de modelos.

- **bootstrap/**  
  Inicialização do framework e configuração do autoload.

- **config/**  
  Arquivos de configuração de serviços e do sistema.

- **database/**  
  Estrutura de banco de dados:
  - `factories/`: Criação de dados para testes.
  - `migrations/`: Definições de estrutura das tabelas.
  - `seeders/`: Popular o banco com dados iniciais.

- **public/**  
  Pasta pública acessível pela web. Contém o `index.php` e os assets públicos.

- **resources/**  
  Recursos da aplicação:
  - `views/`: Templates Blade.
    - `password/`: Contem o corpo de texto do email enviado para recuperação de senha.
  - `css/`: Arquivos CSS que contém o tailwind e algumas classes CSS já configuradas.
  - `js/`: Arquivos JavaScript.
    - `Components/`: Arquivos de componentes vue.
    - `Layout/`: Arquivos de layouts das páginas.
    - `Pages/`: Arquivos das páginas da aplicação.
    - `app.js`: Ponto principal de entrada para o javascript.
- **routes/**  
  Definições de rotas:
  - `web.php`: Rotas para o ambiente web.

- **storage/**  
  Arquivos gerados ou manipulados pela aplicação (logs, cache, uploads).

- **tests/**  
  Testes automatizados.

- **vendor/**  
  Dependências instaladas via Composer (não edite arquivos aqui).

---

> Essa estrutura facilita a manutenção, escalabilidade e organização do projeto conforme boas práticas do Laravel.


## 🛠️ Pré-requisitos
Antes de começar, certifique-se de ter instalado: 
- Docker

## 🚀 Executando o projeto
Para executar este projeto Laravel, certifique-se de ter instalado o PHP 8.3 ou superior, Composer.

Siga as etapas abaixo para executar este projeto Laravel em sua máquina local:

1. **Clone o repositório**  
   ```bash
   git clone https://github.com/seu-usuario/blog.git

2. **Acesse o diretório do projeto**
   ```bash
   cd blog


3. **Configure as variáveis de ambiente**
    Copie o arquivo `.env.example` para `.env` e configure as variáveis de ambiente conforme o seu ambiente local (como configurações de banco de dados).

4. **Suba os containers com Docker Compose**
   ```bash
   docker-compose up -d --build

5. **Instale as dependências do Laravel(dentro do container)**
   ```bash
   docker exec -it blog_laravel-api_1 composer install

6. **Gere a chave da aplicação**
   ```bash
   docker exec -it blog_laravel-api_1 php artisan key:generate

7. **Execute as migrações do banco de dados**
    ```bash
    docker exec -it blog_laravel-api_1 php artisan migrate

8. **Execute os seeders para alimentar o banco de dados**
    ```bash
    docker exec -it blog_laravel-api_1 php artisan db:seed

Agora você pode acessar o projeto em `http://localhost:8000`.

## 🛡️ License

The Laravel framework is open-sourced software licensed under the. Este projeto está licenciado sob a [MIT license](https://opensource.org/licenses/MIT).