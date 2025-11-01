<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
         @keyframes rotate {
        100% {
            transform: rotate(1turn);
        }
    }

    .rainbow::before {
        content: '';
        position: absolute;
        z-index: -2;
        left: -50%;
        top: -50%;
        width: 200%;
        height: 200%;
        background-position: 100% 50%;
        background-repeat: no-repeat;
        background-size: 50% 30%;
        filter: blur(6px);
        background-image: linear-gradient(#FF0A7F,#780EFF);
        animation: rotate 4s linear infinite;
    }


    @keyframes slideIn {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-slideIn {
      animation: slideIn 0.4s ease forwards;
    }
    </style>
    <section id="section" name="header" class="bg-gradient-to-b px-3 sm:px-10 overflow-hidden from-[#F5F7FF] via-[#fffbee] to-[#E6EFFF] pt-6 h-full">
        <header class="flex items-center justify-between px-6 py-3 md:py-4 shadow-sm max-w-5xl rounded-full mx-auto w-full bg-white">
            <a href="#">
                <img src="https://i.ibb.co/QfP6bG9/sorriso-logo.png" alt="Sorriso Supermercados Logo" class="h-10">
            </a>

            <nav id="menu" class="max-md:absolute max-md:top-0 max-md:left-0 max-md:overflow-hidden items-center justify-center max-md:h-full max-md:w-0 transition-[width] bg-white/50 backdrop-blur flex-col md:flex-row flex gap-8 text-gray-900 text-sm font-normal">

                <a class="hover:text-indigo-600" href="#">
                    <i class="fa-solid fa-house"></i>
                    Home
                </a>
                <a class="hover:text-indigo-600" href="#">
                    <i class="fa-solid fa-bag-shopping"></i>
                    Produtos
                </a>

              
                <a command="show-modal" commandfor="drawer" class="hover:text-indigo-600" href="#">
                <button command="show-modal" commandfor="drawer" class="rounded-md bg-gray-950/5 px-2.5 py-1.5 text-sm font-semibold text-gray-900 hover:bg-gray-950/10">  <i class="fa-solid fa-basket-shopping"></i>
                carrinho</button>
                  
                </a>
                <a class="hover:text-indigo-600">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Perfil') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Sair') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>

                </a>
                <button id="closeMenu" class="md:hidden text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </nav>


            <div class="flex items-center space-x-4">
                <button id="btndark" class="size-8 flex items-center justify-center hover:bg-gray-100 transition border border-slate-300 rounded-md">
                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.5 10.39a2.889 2.889 0 1 0 0-5.779 2.889 2.889 0 0 0 0 5.778M7.5 1v.722m0 11.556V14M1 7.5h.722m11.556 0h.723m-1.904-4.596-.511.51m-8.172 8.171-.51.511m-.001-9.192.51.51m8.173 8.171.51.511" stroke="#353535" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <a class="hidden md:flex bg-green-500 text-white px-5 py-2 rounded-full text-sm font-medium " href="#">
                  <i class="fa-brands fa-whatsapp"> </i> 
                                 entre em contato
                </a>
                <button id="openMenu" class="md:hidden text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </header>

        <main class="flex-grow flex flex-col items-center max-w-7xl mx-auto w-full">
            <button class="mt-16 mb-6 flex items-center space-x-2 border border-indigo-600 text-indigo-600 text-xs rounded-full px-4 pr-1.5 py-1.5 hover:bg-indigo-50 transition" type="button">
                <span>
                    Veja nossas ofertas semanais
                </span>
                <span class="flex items-center justify-center size-6 p-1 rounded-full bg-indigo-600">
                    <svg width="14" height="11" viewBox="0 0 16 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 6.5h14M9.5 1 15 6.5 9.5 12" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
            </button>

            <h1 class="text-center text-gray-900 font-bold text-3xl sm:text-4xl md:text-5xl max-w-2xl leading-tight">
                O supermercado de confiança da
                <span class="text-indigo-600">
                    sua família
                </span>
            </h1>

            <p class="mt-4 text-center text-gray-600 max-w-md text-sm sm:text-base leading-relaxed">
                No Sorriso Supermercados você encontra os melhores preços, qualidade e variedade em todos os setores.
            </p>

            <button class="mt-8 bg-indigo-600 text-white px-6 pr-2.5 py-2.5 rounded-full text-sm font-medium flex items-center mt-1655555555 space-x-2 hover:bg-indigo-700 transition" type="button">
                <span>
                    Confira nossas promoções
                </span>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.821 11.999h13.43m0 0-6.714-6.715m6.715 6.715-6.715 6.715" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>




            <div id="alerta" class="hidden fixed top-6 right-6 bg-white border border-gray-200 shadow-2xl rounded-2xl p-5 flex items-start gap-4 max-w-sm animate-slideIn">
  
  </div>


            <h1 class="mt-40 text-3xl font-semibold text-center mx-auto">Nossas Últimas Criações</h1>
            <p class="text-sm text-slate-500 text-center mt-2 max-w-lg mx-auto">Confira alguns destaques do Supermercado Sorriso, com qualidade e atendimento de excelência.</p>

            <div class="flex items-center gap-6 h-[400px] w-full max-w-5xl mt-10 mx-auto">
                <div class="relative group flex-grow transition-all w-56 h-[400px] duration-500 hover:w-full">
                    <img class="h-full w-full object-cover object-center"
                        src="{{ asset('img/01.jpg') }}"
                        alt="Imagem do Supermercado Sorriso">
                    <div class="absolute inset-0 flex flex-col justify-end p-10 text-white bg-black/50 opacity-0 group-hover:opacity-100 transition-all duration-300">
                        <h1 class="text-3xl">Supermercado Sorriso</h1>
                        <p class="text-sm">Fundado nos anos 1990, referência em produtos de qualidade e atendimento em Sorriso, MT.</p>
                    </div>
                </div>
                <div class="relative group flex-grow transition-all w-56 h-[400px] duration-500 hover:w-full">
                    <img class="h-full w-full object-cover object-right"
                        src="{{ asset('img/2.jpg') }}"
                        alt="Imagem do Supermercado Sorriso">
                    <div class="absolute inset-0 flex flex-col justify-end p-10 text-white bg-black/50 opacity-0 group-hover:opacity-100 transition-all duration-300">
                        <h1 class="text-3xl">Supermercado Sorriso</h1>
                        <p class="text-sm">Destaque pela variedade de produtos e compromisso com a satisfação dos clientes.</p>
                    </div>
                </div>
                <div class="relative group flex-grow transition-all w-56 h-[400px] duration-500 hover:w-full">
                    <img class="h-full w-full object-cover object-center"
                        src="{{ asset('img/03.jpg') }}"
                        alt="Imagem do Supermercado Sorriso">
                    <div class="absolute inset-0 flex flex-col justify-end p-10 text-white bg-black/50 opacity-0 group-hover:opacity-100 transition-all duration-300">
                        <h1 class="text-3xl">Supermercado Sorriso</h1>
                        <p class="text-sm">Focado em inovação e qualidade, atende a uma clientela diversificada e exigente.</p>
                    </div>
                </div>
            </div>


        </main>


    </section>


    <div class="flex flex-col md:flex-row items-center gap-10">
 

    <div class="space-y-10 px-4 md:px-0" >
        

      





    </div>
</div>
    


<div class="bg-white">
  <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
    <h2 class="text-2xl font-bold tracking-tight text-gray-900">Clientes também compraram</h2>

    <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8" id="show">

     

      
  

    </div>
  </div>
</div>






<script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>

<el-dialog>
  <dialog id="drawer" aria-labelledby="drawer-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-hidden bg-transparent not-open:hidden backdrop:bg-transparent">
    <el-dialog-backdrop class="absolute inset-0 bg-gray-500/75 transition-opacity duration-500 ease-in-out data-closed:opacity-0"></el-dialog-backdrop>

    <div tabindex="0" class="absolute inset-0 pl-10 focus:outline-none sm:pl-16">
      <el-dialog-panel class="ml-auto block size-full max-w-md transform transition duration-500 ease-in-out data-closed:translate-x-full sm:duration-700">
        <div class="flex h-full flex-col overflow-y-auto bg-white shadow-xl">

          <!-- Header -->
          <div class="flex-1 overflow-y-auto px-4 py-6 sm:px-6">
            <div class="flex items-start justify-between">
              <h2 id="drawer-title" class="text-lg font-medium text-gray-900">Carrinho de Compras</h2>
              <div class="ml-3 flex h-7 items-center">
                <button type="button" command="close" commandfor="drawer" class="relative -m-2 p-2 text-gray-700 hover:text-gray-900">
                  <span class="absolute -inset-0.5"></span>
                  <span class="sr-only">Fechar painel</span>
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true" class="size-6">
                    <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </button>
              </div>
            </div>

            <!-- Produtos -->
            <div class="mt-8">
              <div class="flow-root">
                <ul role="list" class="-my-6 divide-y divide-gray-200" id="cart">
                  
                

                    
                </ul>
              </div>
            </div>
          </div>

          <!-- Rodapé -->
          <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
       
            <!-- Método de Pagamento -->
            <div class="mb-4">
              <label for="payment" class="block text-sm font-medium text-gray-700">Método de Pagamento</label>
              <select 
                id="payment" 
                name="payment"
                class="mt-1 block w-full rounded-md border border-gray-300 bg-white shadow-sm focus:border-indigo-600 focus:ring-indigo-600 sm:text-sm"
              >
                <option value="pix">PIX</option>
                <option value="card">Cartão de Crédito</option>
   
              </select>
            </div>

            <!-- Totais -->
            <div class="flex justify-between text-base font-medium text-gray-900">
              <p>Subtotal</p>
              <p id="subtotalValue"></p>
            </div>
            <div class="flex justify-between text-base font-medium text-gray-900 mt-2">
              <p>Frete</p>
              <p id="shippingValue">$–</p>
            </div>
            <div class="flex justify-between text-base font-medium text-gray-900 mt-2">
              <p>Total</p>
              <p id="totalValue">$–</p>
            </div>
           

            <!-- Botão Checkout -->
            <div class="mt-6">
              <button id="checkoutBtn" class="flex items-center justify-center w-full rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-xs hover:bg-indigo-700">
                Finalizar Compra
              </button>
            </div>

            <!-- Continuar comprando -->
            <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
              <p>
                ou
                <button type="button" command="close" commandfor="drawer" class="font-medium text-indigo-600 hover:text-indigo-500">
                  Continuar comprando →
                </button>
              </p>
            </div>
          </div>

        </div>
      </el-dialog-panel>
    </div>
  </dialog>
</el-dialog>




<script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>


<!-- Modal -->
<el-dialog>
  <dialog id="dialog" class="rounded-xl overflow-hidden" aria-labelledby="dialog-title">
    <el-dialog-backdrop class="fixed inset-0 bg-black/50 transition-opacity"></el-dialog-backdrop>

    <div class="relative w-full max-w-lg bg-gray-900 rounded-xl shadow-2xl overflow-hidden mx-auto my-10">
      <div class="px-6 py-6">
        <h3 id="dialog-title" class="text-lg font-semibold text-white mb-4">Consultar CEP</h3>

        <!-- Campo CEP -->
        <div class="mb-4">
          <label for="cep" class="block text-sm font-medium text-gray-300">Informe seu CEP</label>
          <input 
            type="text" 
            id="cep" 
            name="cep" 
            maxlength="9"
            placeholder="00000-000"
            class="mt-2 block w-full rounded-lg border border-gray-700 bg-gray-800 text-white px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm"
          />
        </div>

        <button id="consultarCep" class="w-full rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-4 py-2 shadow-md transition">
          Consultar
        </button>
      </div>

      <div class="bg-gray-800/50 px-6 py-4 flex justify-end space-x-3">
        <button type="button" command="close" commandfor="dialog" class="rounded-lg px-4 py-2 bg-gray-700 text-white hover:bg-gray-600 transition">
          Fechar
        </button>
      </div>
    </div>
  </dialog>
</el-dialog>




    <footer class="px-6 pt-8 md:px-16 lg:px-36 w-full bg-gradient-to-b from-[#F5F7FF] via-[#E8EBF9] to-[#DCE1F3]">
        
    <div class="flex flex-col md:flex-row justify-between w-full gap-10 border-b border-gray-300 pb-10">
      
   
      <div class="md:max-w-96">
        <img 
          alt="Logo Sorriso Supermercados" 
          class="h-11" 
          src="https://cdn-icons-png.flaticon.com/512/3081/3081559.png"
        >
        <p class="mt-6 text-sm text-gray-600">
          O <strong>Sorriso Supermercados</strong> é referência em qualidade e economia há mais de 20 anos, oferecendo os melhores produtos e um atendimento de excelência.
        </p>


        <div class="flex items-center gap-2 mt-4">
          <img 
            src="https://raw.githubusercontent.com/prebuiltui/prebuiltui/refs/heads/main/assets/appDownload/googlePlayBtnBlack.svg" 
            alt="Google Play" 
            class="h-10 w-auto border border-gray-400 rounded"
          >
          <img 
            src="https://raw.githubusercontent.com/prebuiltui/prebuiltui/refs/heads/main/assets/appDownload/appleStoreBtnBlack.svg" 
            alt="App Store" 
            class="h-10 w-auto border border-gray-400 rounded"
          >
        </div>

        <!-- Redes sociais -->
        <div class="flex items-center gap-4 mt-6 text-2xl">
          <a href="#" class="text-[#25D366] hover:text-[#22b958]" title="WhatsApp">
            <i class="fa-brands fa-whatsapp"></i>
          </a>
          <a href="#" class="text-[#E4405F] hover:text-[#d73556]" title="Instagram">
            <i class="fa-brands fa-instagram"></i>
          </a>
          <a href="#" class="text-[#1877F2] hover:text-[#0d5ed0]" title="Facebook">
            <i class="fa-brands fa-facebook"></i>
          </a>
        </div>
      </div>

      <!-- Links e contato -->
      <div class="flex-1 flex items-start md:justify-end gap-20 md:gap-40">
        <div>
          <h2 class="font-semibold mb-5 text-gray-900">Empresa</h2>
          <ul class="text-sm space-y-2">
            <li><a href="#" class="hover:text-emerald-600">Início</a></li>
            <li><a href="#" class="hover:text-emerald-600">Sobre nós</a></li>
            <li><a href="#" class="hover:text-emerald-600">Contato</a></li>
            <li><a href="#" class="hover:text-emerald-600">Política de Privacidade</a></li>
          </ul>
        </div>

        <div>
          <h2 class="font-semibold mb-5 text-gray-900">Fale conosco</h2>
          <div class="text-sm space-y-2 text-gray-700">
            <p><i class="fa-solid fa-phone text-emerald-600 mr-2"></i> (66) 000-0000</p>
            <p><i class="fa-solid fa-location-dot text-emerald-600 mr-2"></i> Av. Blumenau, 1020 - Centro, Sorriso - MT</p>
            <p><i class="fa-solid fa-envelope text-emerald-600 mr-2"></i> contato@sorrisosupermercados.com.br</p>
          </div>
        </div>
      </div>
    </div>

    <p class="pt-4 text-center text-sm pb-5 text-gray-600">
      © 2025 <strong>Sorriso Supermercados <em>by-csdev</strong>.</em> Todos os direitos reservados.
    </p>
  </footer>



<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.3/css/all.min.css"
  integrity="sha512-yh+YHzW2LJ2K8Xv6a1NydtjT6hI5+6J6ySgFGrZ7gK+ShyzTqFqD4X/9L+I0rHZGzZg3U9qYr5x7jTvBf1X0iw=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer"
/>









    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.7/lib/darkmode-js.min.js"></script>
    <script src="{{ asset('app.js') }}"></script>

   

</x-app-layout>