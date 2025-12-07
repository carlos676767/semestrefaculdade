

# 🛒 Sistema de Compras com Pagamentos, CRUD e Painel Administrativo

![Laravel](https://img.shields.io/badge/Laravel-11.x-red?logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.8-777BB4?logo=php&logoColor=white)
![Node.js](https://img.shields.io/badge/Node.js-22.14-339933?logo=node.js&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-latest-005C84?logo=mysql&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-latest-38B2AC?logo=tailwindcss&logoColor=white)
![Stripe](https://img.shields.io/badge/Stripe-API-626CD9?logo=stripe&logoColor=white)
![MercadoPago](https://img.shields.io/badge/Mercado%20Pago-API-009EE3?logo=mercadopago&logoColor=white)
![Socket.IO](https://img.shields.io/badge/Socket.IO-latest-black?logo=socketdotio)
![Express](https://img.shields.io/badge/Express.js-latest-000000?logo=express&logoColor=white)

Projeto completo desenvolvido com Laravel, Node.js e MySQL, incluindo fluxo de compras, integração com meios de pagamento, painel administrativo, histórico de pedidos e arquitetura sólida seguindo padrões modernos.

---

# 🚀 Funcionalidades Principais

## 🖥 *Frontend*
### Página Inicial (Home)
- Tela de *histórico* com todas as compras do usuário.
- *Carrinho de compras* com seleção de método de pagamento e finalização do pedido.
- *Dark Mode* ativado em toda a interface.
- *Botão do WhatsApp* para contato direto.
- *Página do Usuário* com edição de informações pessoais.
- *Página do Item*, levando o usuário ao carrinho após selecionar.
- *Tela de Login e Registro* estilizada e funcional.
- Histórico de compras integrado ao perfil.

### Landing Page de FAQ
- Página dedicada com perguntas e respostas.

### Footer
- Informações gerais
- Links úteis
- Contatos

---

## 🛠 *Backend / Painel Administrativo (CRUD)*

### Funcionalidades do Admin
- Cadastro e gerenciamento de itens/produtos.
- Tela com listagem completa dos itens cadastrados.
- Área de *Pedidos*, permitindo:
  - Visualizar todos os pedidos realizados.
  - Acessar informações completas dos usuários.
  - *Alterar status do pedido* (entregue / pendente).
- Histórico de compras de *todos os usuários* acessível ao admin.

---

# 🧩 Tecnologias Utilizadas

## ⚙ Backend
- *Laravel 11.x*
- *PHP 8.8*
- *Node.js 22.14*
- *MySQL (versão atual)*

## 🎨 Frontend
- *Tailwind CSS*
- *Blade Templates*
- *Axios.js*

---

# 📚 Bibliotecas e Ferramentas

- *Stripe (pagamentos)*
- *Mercado Pago (pagamentos)*
- *Socket.IO (comunicação em tempo real)*
- *Laravel Breeze (auth)*
- *Express.js*
- *Axios.js*

---

# 🏗 Arquitetura e Padrões

- *MVC (Model-View-Controller)*
- *Princípios SOLID*
- *DTO (Data Transfer Object)*
- *Repository Pattern*

---

# 📦 Instalação

## Backend (Laravel)

```bash
composer install
npm install
php artisan migrate
npm run dev
php artisan serve

Servidor Node

npm install
node server.js


---

📜 Licença

Este projeto é livre para ser utilizado como estudo e portfólio.


---

✨ Autor

Desenvolvido por cs

---
