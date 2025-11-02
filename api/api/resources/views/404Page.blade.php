<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Erro no Pagamento</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen font-sans">

  <div class="bg-white shadow-xl rounded-xl p-10 max-w-lg w-full text-center animate-fadeIn">
    <!-- Ícone profissional -->
    <div class="flex justify-center mb-6">
      <div class="bg-red-50 p-4 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M4.93 4.93a10 10 0 1114.14 14.14A10 10 0 014.93 4.93z" />
        </svg>
      </div>
    </div>

    <!-- Mensagem principal -->
    <h1 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-2">Pagamento não concluído</h1>
    <p class="text-gray-600 mb-6 leading-relaxed">
      Ocorreu um erro ao processar o pagamento.  
      Por favor, verifique os dados e tente novamente.  
      Caso o problema persista, entre em contato com o suporte.
    </p>

    <!-- Código de erro -->
    <div class="text-gray-300 text-7xl font-extrabold mb-6">404</div>

    <!-- Linha decorativa -->
    <div class="h-1 w-16 bg-red-500 mx-auto rounded-full mb-8"></div>

    <!-- Botões de ação -->
    <div class="flex flex-col sm:flex-row justify-center gap-3">
      <a href="/" class="bg-red-600 hover:bg-red-700 text-white font-medium px-6 py-2.5 rounded-md transition-all active:scale-95">
        Voltar à Página Inicial
      </a>
      <a href="/suporte" class="border border-gray-300 hover:border-red-500 hover:text-red-600 text-gray-700 font-medium px-6 py-2.5 rounded-md transition-all active:scale-95">
        Contatar Suporte
      </a>
    </div>
  </div>

  <!-- Animação suave -->
  <style>
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn {
      animation: fadeIn 0.6s ease-out;
    }
  </style>

</body>
</html>
