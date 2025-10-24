# 💰 Cash Flow Statement System (Sistema de Demonstração de Fluxo de Caixa)

Este é um projeto de aplicação web para registrar movimentos de caixa e gerar a Demonstração do Fluxo de Caixa (DFC) utilizando o **Método Direto**, com uma arquitetura robusta baseada em **Programação Orientada a Objetos (POO)** e no padrão **MVC estendido**.

---

## 🇧🇷 Arquitetura e Conceitos (Português)

O projeto foi construído sobre o **Framework Laravel**, com ênfase na separação de responsabilidades (**Clean Architecture/DDD lite**) para isolar a lógica contábil.

### 🧩 Pilares Tecnológicos

- **Backend:** PHP (v7.4+) com Laravel (v8.x)  
- **Banco de Dados:** MySQL  
- **Frontend:** Blade, HTML/CSS (com Mix/Webpack para assets)  
- **Arquitetura:** MVC com Camada de Serviço e Domínio POO  

---

### 🧠 Estrutura POO e Fluxo de Dados

O princípio central é usar o **Polimorfismo** para classificar as transações, garantindo que o núcleo contábil seja modular.

| Camada | Diretório | Responsabilidade |
|--------|------------|------------------|
| Domínio POO | `app/Classes/Contabilidade` | Contém as classes puras (`Operacional`, `Investimento`, `Financiamento`) que herdam de `MovimentoCaixaBase`. Define as regras de classificação da DFC. |
| Serviços (Lógica) | `app/Services` | Contém `MovimentoCaixaService` (salvar no DB) e `DFCService` (realizar cálculos, agrupar transações e gerar o relatório). |
| Model (Persistência) | `app/Models` | Mapeia a tabela `movimento_caixas` (Eloquent ORM). |
| Controller (Ação) | `app/Http/Controllers` | Recebe a requisição, instancia a classe POO correta e delega ao Service. |

---

### ⚙️ Configuração Inicial (Setup)

Siga estes passos no terminal para configurar o projeto (assumindo PHP, Composer e MySQL instalados):

#### 1️⃣ Instalar Dependências PHP:
```bash
composer install
```

#### 2️⃣ Configurar o Banco de Dados:
Crie um banco de dados MySQL chamado **cashflow** (ou o nome que preferir).

Copie o arquivo de ambiente:
```bash
cp .env.example .env
```

Edite o arquivo `.env` com suas credenciais do MySQL (exemplo):
```
DB_DATABASE=cashflow
DB_USERNAME=root
DB_PASSWORD=
```

#### 3️⃣ Gerar Chave e Rodar Migrações:
```bash
php artisan key:generate
php artisan migrate
```

#### 4️⃣ Instalar Dependências Frontend (Opcional, mas Recomendado):
```bash
npm install
npm run dev
```

#### 5️⃣ Iniciar o Servidor:
```bash
php artisan serve
```

Acesse a aplicação em: **http://127.0.0.1:8000**

---

## 🇬🇧 Architecture and Concepts (English)

This is a **web application project** designed to record cash movements and generate the **Statement of Cash Flows (SCF/DFC)** using the **Direct Method**, structured with a strong **Object-Oriented Programming (OOP)** foundation and an **extended MVC pattern**.

### 🧩 Technology Stack

- **Backend:** PHP (v7.4+) with Laravel (v8.x)  
- **Database:** MySQL  
- **Frontend:** Blade, HTML/CSS (with Mix/Webpack for assets)  
- **Architecture:** MVC with dedicated Service and OOP Domain layers  

---

### 🧠 OOP Structure and Data Flow

The core principle involves using **Polymorphism** to classify transactions, ensuring the accounting core is modular and decoupled from the framework.

| Layer | Directory | Responsibility |
|-------|------------|----------------|
| OOP Domain | `app/Classes/Contabilidade` | Holds the pure OOP classes (`Operacional`, `Investimento`, `Financiamento`) inheriting from `MovimentoCaixaBase`. Defines the DFC classification rules. |
| Services (Logic) | `app/Services` | Contains `MovimentoCaixaService` (DB saving logic) and `DFCService` (calculates, aggregates, and generates the final report). |
| Model (Persistence) | `app/Models` | Maps the `movimento_caixas` database table (Eloquent ORM). |
| Controller (Action) | `app/Http/Controllers` | Receives HTTP requests, instantiates the correct OOP class, and delegates tasks to the Service layer. |

---

### ⚙️ Initial Configuration (Setup)

Follow these steps in your terminal to set up the project (assuming PHP, Composer, and MySQL are installed):

#### 1️⃣ Install PHP Dependencies:
```bash
composer install
```

#### 2️⃣ Configure the Database:
Create a MySQL database named **cashflow** (or a name of your choice).

Copy the environment file:
```bash
cp .env.example .env
```

Edit the `.env` file with your MySQL credentials (e.g.):
```
DB_DATABASE=cashflow
DB_USERNAME=root
DB_PASSWORD=
```

#### 3️⃣ Generate Key and Run Migrations:
```bash
php artisan key:generate
php artisan migrate
```

#### 4️⃣ Install Frontend Dependencies (Optional, but Recommended):
```bash
npm install
npm run dev
```

#### 5️⃣ Start the Server:
```bash
php artisan serve
```

Access the application at: **http://127.0.0.1:8000**
