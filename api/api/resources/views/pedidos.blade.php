<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Premium</title>

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Charts -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest"></script>

  <!-- SweetAlert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Leaflet Map -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>



  <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.26.4/dist/sweetalert2.all.min.js
"></script>
  <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.26.4/dist/sweetalert2.min.css
" rel="stylesheet">

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
  </style>
</head>

<body class="flex min-h-screen text-gray-900">

  <!-- SIDEBAR -->
  <aside id="sidebar"
    class="w-72 bg-white/70 backdrop-blur-xl border-r border-gray-200 shadow-xl p-6 flex flex-col justify-between
    fixed md:static inset-y-0 left-0 transform -translate-x-full md:translate-x-0 transition-all duration-300 z-50">

    <div>
      <h1 class="text-2xl font-bold text-indigo-700 mb-8 flex items-center gap-2">
        <i data-lucide="layout-dashboard" class="w-6 h-6"></i> Painel
      </h1>

      <nav class="space-y-3">

        <button id="btnCloser" class="hidden p-2 rounded-lg bg-indigo-600 text-white shadow">
          <i data-lucide="menu"></i>
        </button>

        <button class="sidebar-btn w-full flex items-center gap-3 px-4 py-2 rounded-lg text-gray-700 transition-fast">
          <i data-lucide="database" class="w-5 h-5"></i> <a href="crud">CRUD</a>
        </button>

        <button class="sidebar-btn w-full flex items-center gap-3 px-4 py-2 rounded-lg text-gray-700 transition-fast">
          <i data-lucide="bar-chart-3" class="w-5 h-5"></i> <a href="http://localhost:8000/allItens"> Relatórios</a>
        </button>

        <button class="sidebar-btn w-full flex items-center gap-3 px-4 py-2 rounded-lg bg-indigo-100 text-indigo-700 transition-fast">
          <i data-lucide="truck" class="w-5 h-5"></i> Pedidos
        </button>
      </nav>
    </div>

    <p class="text-sm text-gray-500 mt-8">© 2025 - Sistema Premium</p>
  </aside>


  <main class="flex-1 p-10 space-y-10 overflow-y-auto">

    <header class="flex justify-between items-center">
      <button id="menuBtn" class="md:hidden p-2 rounded-lg bg-indigo-600 text-white shadow">
        <i data-lucide="menu"></i>
      </button>

      <h2 class="text-3xl font-bold text-gray-800">Dashboard</h2>

 

    </header>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">


  <div class="glass rounded-2xl p-6 shadow-lg border border-white/20 max-h-[750px] overflow-y-auto">

    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
      <i data-lucide="shopping-bag"></i>
      Pedidos
    </h2>

    <div id="listaPedidos" class="space-y-4"></div>
  </div>


  <div id="detalhesPedido"
    class="lg:col-span-2 glass rounded-2xl p-6 shadow-lg border border-white/20 hidden">

    <div class="flex items-center justify-between mb-4">
      <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
        <i data-lucide="file-text"></i>
        Detalhes do Pedido
      </h2>

    
      <div class="flex items-center gap-3">
        <button class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 shadow flex items-center gap-2">
         <a href="http://localhost:8000/allItens"><i data-lucide="file-text"></i>PDF</a> 
        
        </button>

        <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 shadow flex items-center gap-2">
          <i data-lucide="user"></i>
          Admin
        </button>
      </div>
    </div>

   
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    
      <div class="bg-white rounded-xl p-5 shadow border">
        <h3 class="font-semibold text-gray-800 text-lg mb-2 flex items-center gap-2">
          <i data-lucide="user-circle"></i> Cliente
        </h3>
        <p id="dpNome" class="text-gray-700">---</p>

        <h3 class="font-semibold text-gray-800 text-lg mt-4 mb-2 flex items-center gap-2">
          <i data-lucide="map-pin"></i> Endereço
        </h3>
        <p id="dpEndereco" class="text-gray-700">---</p>

        <h3 class="font-semibold text-gray-800 text-lg mt-4 mb-2 flex items-center gap-2">
          <i data-lucide="credit-card"></i> Pagamento
        </h3>
        <p id="dpPagamento" class="text-gray-700">---</p>

        <h3 class="font-semibold text-gray-800 text-lg mt-4 mb-2 flex items-center gap-2">
          <i data-lucide="badge-check"></i> Status
        </h3>

        <select id="dpStatus" class="mt-1 p-2 border rounded-lg w-full bg-gray-50">
          <option value="recebido">recebido</option>
          <option value="em preparo">em preparo</option>
          <option value="a caminho">a caminho</option>
          <option value="entregue">entregue</option>
        </select>
      </div>

   
      <div class="bg-white rounded-xl p-5 shadow border">
        <h3 class="font-semibold text-gray-800 text-lg mb-3 flex items-center gap-2">
          <i data-lucide="map"></i> Localização
        </h3>
        <div id="map" class="w-full h-64 rounded-lg border"></div>
      </div>

    </div>



    <div class="mt-6 bg-white rounded-xl p-5 shadow border">
      <h3 class="font-semibold text-gray-800 text-lg mb-3 flex items-center gap-2">
        <i data-lucide="shopping-cart"></i> Itens do Pedido
      </h3>

      <ul id="dpItens" class="text-gray-700"></ul>
    </div>

  </div>
</div>


  <script src="{{ asset('pedidos.js') }}"></script>
</body>

</html>