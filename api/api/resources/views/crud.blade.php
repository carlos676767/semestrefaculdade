<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Premium</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://unpkg.com/lucide@latest"></script>

  <style>
    body {
      background: radial-gradient(circle at top left, #f8faff, #eef2ff);
      font-family: 'Inter', sans-serif;
    }
    .glass {
      backdrop-filter: blur(16px) saturate(180%);
      -webkit-backdrop-filter: blur(16px) saturate(180%);
      background-color: rgba(255, 255, 255, 0.6);
      border: 1px solid rgba(209, 213, 219, 0.3);
    }
    .transition-fast {
      transition: all 0.3s ease;
    }
    .sidebar-btn:hover {
      background-color: rgba(99, 102, 241, 0.1);
    }
  </style>
</head>

<body class="flex min-h-screen text-gray-900">

  <!-- Sidebar -->
  <aside class="w-72 bg-white/70 backdrop-blur-xl border-r border-gray-200 shadow-xl p-6 flex flex-col justify-between">
    <div>
      <h1 class="text-2xl font-bold text-indigo-700 mb-8 flex items-center gap-2">
        <i data-lucide="layout-dashboard" class="w-6 h-6"></i> Painel
      </h1>
      <nav class="space-y-3">
        <button onclick="showSection('crud')" class="sidebar-btn w-full flex items-center gap-3 px-4 py-2 rounded-lg text-gray-700 transition-fast">
          <i data-lucide="database" class="w-5 h-5"></i> CRUD
        </button>
        <button onclick="showSection('relatorios')" class="sidebar-btn w-full flex items-center gap-3 px-4 py-2 rounded-lg text-gray-700 transition-fast">
          <i data-lucide="bar-chart-3" class="w-5 h-5"></i> Relatórios
        </button>
        <button onclick="showSection('pedidos')" class="sidebar-btn w-full flex items-center gap-3 px-4 py-2 rounded-lg text-gray-700 transition-fast">
          <i data-lucide="truck" class="w-5 h-5"></i> Pedidos
        </button>
      </nav>
    </div>
    <p class="text-sm text-gray-500 mt-8">© 2025 - Sistema Premium</p>
  </aside>

  <!-- Conteúdo principal -->
  <main class="flex-1 p-10 space-y-10 overflow-y-auto">

    <!-- Cabeçalho -->
    <header class="flex justify-between items-center">
      <h2 class="text-3xl font-bold text-gray-800">Dashboard</h2>
      <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 shadow-md transition-fast flex items-center gap-2">
        <i data-lucide="user"></i> Admin
      </button>
    </header>

    <!-- Cards de resumo -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <div class="glass rounded-2xl p-6 shadow-md">
        <div class="flex items-center justify-between">
          <p class="text-gray-600">Produtos Cadastrados</p>
          <i data-lucide="box" class="w-5 h-5 text-indigo-600"></i>
        </div>
        <h3 class="text-2xl font-semibold mt-2" id="totalProdutos">0</h3>
      </div>
      <div class="glass rounded-2xl p-6 shadow-md">
        <div class="flex items-center justify-between">
          <p class="text-gray-600">Pedidos Hoje</p>
          <i data-lucide="truck" class="w-5 h-5 text-indigo-600"></i>
        </div>
        <h3 class="text-2xl font-semibold mt-2" id="totalPedidos">3</h3>
      </div>
      <div class="glass rounded-2xl p-6 shadow-md">
        <div class="flex items-center justify-between">
          <p class="text-gray-600">Faturamento</p>
          <i data-lucide="dollar-sign" class="w-5 h-5 text-indigo-600"></i>
        </div>
        <h3 class="text-2xl font-semibold mt-2">R$ 12.400</h3>
      </div>
    </div>

    <!-- CRUD -->
    <section id="crud" class="space-y-8">
  <div class="flex justify-between items-center">
    <h3 class="text-2xl font-semibold text-gray-800 flex items-center gap-2">
      <i data-lucide="database"></i> Gerenciar Produtos
    </h3>
  </div>

  <!-- Formulário -->
  <div class="glass p-6 rounded-2xl shadow-md border border-indigo-100/40">
    <form id="productForm" class="grid grid-cols-1 sm:grid-cols-5 gap-4">
      <div class="sm:col-span-2">
        <input type="text" id="name" placeholder="Nome do Produto"
          class="border p-2 rounded-lg w-full focus:ring-2 focus:ring-indigo-400 transition-fast outline-none"
          required />
      </div>

      <div>
        <input type="number" id="price" placeholder="Preço (R$)"
          class="border p-2 rounded-lg w-full focus:ring-2 focus:ring-indigo-400 transition-fast outline-none"
          required />
      </div>

      <div>
        <input type="number" id="stock" placeholder="Estoque"
          class="border p-2 rounded-lg w-full focus:ring-2 focus:ring-indigo-400 transition-fast outline-none"
          required />
      </div>
      <div>
        <input type="number" id="stock" placeholder="url imagem"
          class="border p-2 rounded-lg w-full focus:ring-2 focus:ring-indigo-400 transition-fast outline-none"
          required />
      </div>


      <div class="sm:col-span-5">
        <textarea id="description" placeholder="Descrição do Produto"
          class="border p-2 rounded-lg w-full focus:ring-2 focus:ring-indigo-400 transition-fast outline-none resize-none" rows="2"></textarea>
      </div>

      <button class="bg-gradient-to-r from-indigo-600 to-indigo-500 text-white rounded-lg px-6 py-2 font-medium hover:from-indigo-500 hover:to-indigo-400 shadow-md transition-fast flex items-center justify-center gap-2">
        <i data-lucide="plus-circle" class="w-5 h-5"></i> Salvar
      </button>
    </form>
  </div>

  <!-- Tabela -->
  <div class="glass p-6 rounded-2xl shadow-lg border border-indigo-100/40 overflow-hidden">
    <table class="w-full text-left border-collapse">
      <thead>
        <tr class="text-gray-700 border-b">
          <th class="p-3">Nome</th>
          <th class="p-3">Preço</th>
          <th class="p-3">Estoque</th>
          <th class="p-3">Descrição</th>
          <th class="p-3 text-right">Ações</th>
          <th class="p-3 text-right">Url imagem</th>
        </tr>
      </thead>
      <tbody id="productTable" class="text-gray-700"></tbody>
    </table>
  </div>
</section>

    <!-- Relatórios -->
    <section id="relatorios" class="hidden">
      <div class="glass p-6 rounded-2xl shadow-md">
        <h3 class="text-2xl font-semibold mb-4">Relatórios de Vendas</h3>
        <canvas id="salesChart" height="100"></canvas>
      </div>
    </section>

    <!-- Pedidos -->
    <section id="pedidos" class="hidden">
      <div class="glass p-6 rounded-2xl shadow-md">
        <h3 class="text-2xl font-semibold mb-4">Pedidos em Tempo Real</h3>
        <div id="orders" class="space-y-4"></div>
      </div>
    </section>
  </main>

  <script>
    lucide.createIcons();

   
  </script>
</body>
</html>
