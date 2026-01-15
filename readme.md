# LivrariaWeb-CRUD - Livraria Online com PHP 📚

![PHP](https://img.shields.io/badge/PHP-7.4%2B-purple)
![MySQL](https://img.shields.io/badge/MySQL-Database-orange)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-blue)

## 💻 Sobre o Projeto

O **LivrariaWeb-CRUD** é uma aplicação web completa desenvolvida em **PHP** para gerenciamento de uma livraria online. O sistema possui uma interface para o cliente final (vitrine de livros) e um painel administrativo para gerenciamento do acervo.

O projeto foi criado para demonstrar habilidades em desenvolvimento web Full Stack, incluindo:
* Autenticação de usuários (Login/Cadastro com hash de senha).
* Operações de CRUD (Criar, Ler, Atualizar, Deletar) para os livros.
* Conexão segura com banco de dados MySQL.

## ⚙️ Funcionalidades

### 👤 Área do Usuário
- [x] **Vitrine de Livros:** Exibição de destaques e novidades com layout responsivo.
- [x] **Autenticação:** Sistema seguro de Login e Cadastro de usuários.
- [x] **Interface Visual:** Design moderno utilizando CSS3 e Bootstrap Icons.

### 🛠️ Área Administrativa (CRUD)
- [x] **Adicionar Livros:** Cadastro de título, preço, imagem, avaliação e quantidade de reviews.
- [x] **Listagem:** Visualização de todos os livros cadastrados em tabela.
- [x] **Edição:** Atualização de dados dos livros existentes.
- [x] **Exclusão:** Remoção de livros do banco de dados.

## 🚀 Tecnologias Utilizadas

* **Backend:** PHP (Procedural)
* **Banco de Dados:** MySQL (MariaDB)
* **Frontend:** HTML5, CSS3, Bootstrap 5 (para o painel administrativo)
* **Ícones:** Bootstrap Icons

## 📂 Estrutura de Arquivos

```
site-grupo-main/
├── index.php          # Página inicial (Vitrine)
├── login.php          # Tela de login
├── cadastro.php       # Tela de registro de usuários
├── crud.php           # Painel de gerenciamento de livros (Admin)
├── conexao.php        # Conexão com banco de dados de Usuários
├── conexao2.php       # Conexão com banco de dados de Livros
├── css/
│   ├── style.css      # Estilos da Home
│   └── login.css      # Estilos do Login/Cadastro
└── img/               # Imagens das capas dos livros
```

## 🔧 Como Executar

### Pré-requisitos
Você precisará de um servidor local como **XAMPP**, **WAMP** ou **Laragon** que inclua PHP e MySQL.

### 1. Configuração do Banco de Dados
O sistema utiliza dois bancos de dados (ou tabelas) conforme os arquivos de conexão. Execute o seguinte script SQL no seu **PHPMyAdmin** ou terminal MySQL:

```sql
-- Criação do Banco de Dados Principal
CREATE DATABASE livros;
USE livros;

-- Tabela de Livros (Para o CRUD)
CREATE TABLE livros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    imagem_url VARCHAR(255),
    avaliacao DECIMAL(2, 1),
    quantidade_avaliacoes INT
);

-- Criação do Banco de Dados de Login (ou use o mesmo banco acima e ajuste o conexao.php)
CREATE DATABASE login;
USE login;

-- Tabela de Usuários
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL
);
```

### 2. Configuração da Conexão
Certifique-se de que os arquivos `conexao.php` e `conexao2.php` estão com a senha do seu banco de dados correta (por padrão no XAMPP a senha é vazia):

```php
$usuario = 'root';
$senha = ''; // Coloque sua senha do MySQL aqui se houver
```

### 3. Rodando o Projeto
Coloque a pasta do projeto dentro do diretório do servidor (ex: `htdocs` no XAMPP).

Inicie o Apache e o MySQL no painel de controle.

Acesse no navegador:

- **Home:** [http://localhost/NomeDaPasta/index.php](http://localhost/NomeDaPasta/index.php)
- **Admin:** [http://localhost/NomeDaPasta/crud.php](http://localhost/NomeDaPasta/crud.php)