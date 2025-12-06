<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Premium</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">


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
          <i data-lucide="database" class="w-5 h-5"></i> CRUD
        </button>
        <button class="sidebar-btn w-full flex items-center gap-3 px-4 py-2 rounded-lg text-gray-700 transition-fast">
          <i data-lucide="bar-chart-3" class="w-5 h-5"></i> Relatórios
        </button>
        <button class="sidebar-btn w-full flex items-center gap-3 px-4 py-2 rounded-lg text-gray-700 transition-fast">
          <i data-lucide="truck" class="w-5 h-5"></i>  <a href="pedidos">Pedidos</a>
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

      <button
        class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 shadow-md transition-fast flex items-center gap-2">
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
          <p class="text-gray-600">Total pedidos</p>
          <i data-lucide="truck" class="w-5 h-5 text-indigo-600"></i>
        </div>
        <h3 class="text-2xl font-semibold mt-2" id="totalPedidos"></h3>
      </div>
      <div class="glass rounded-2xl p-6 shadow-md">
        <div class="flex items-center justify-between">
          <p class="text-gray-600">Produtos vendidos</p>
          <i data-lucide="dollar-sign" class="w-5 h-5 text-indigo-600"></i>
        </div>
        <h3 class="text-2xl font-semibold mt-2" id="vendidos">R$ 12.400</h3>
      </div>
    </div>

    <!-- CRUD -->
    <section id="crud" class="space-y-8">
      <div class="flex justify-between items-center">
        <h3 class="text-2xl font-semibold text-gray-800 flex items-center gap-2">
          <i data-lucide="database"></i> Gerenciar Produtos
        </h3>
      </div>


      <div class="glass p-6 rounded-2xl shadow-md border border-indigo-100/40">
        <div id="productForm" class="grid grid-cols-1 sm:grid-cols-5 gap-4">
          <!-- ID oculto (para editar produtos existentes) -->
          <input type="hidden" id="id" />

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
            <input
              type="file"
              id="imageUrl"
              name="image"
              accept="image/*"
              class="border p-2 rounded-lg w-full focus:ring-2 focus:ring-indigo-400 transition-fast outline-none" />
          </div>


          <div class="sm:col-span-5">
            <textarea id="description" placeholder="Descrição do Produto"
              class="border p-2 rounded-lg w-full focus:ring-2 focus:ring-indigo-400 transition-fast outline-none resize-none"
              rows="2"></textarea>
          </div>

          <button id="save"
            class="bg-gradient-to-r from-indigo-600 to-indigo-500 text-white rounded-lg px-6 py-2 font-medium hover:from-indigo-500 hover:to-indigo-400 shadow-md transition-fast flex items-center justify-center gap-2">
            <i data-lucide="plus-circle" class="w-5 h-5"></i> Salvar
          </button>
        </div>

      </div>





      <div class="itens">



      </div>








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


  <script src="https://cdn.socket.io/4.7.2/socket.io.min.js"></script>



  <div id="alertaSucess" class="fixed bottom-50 right-2 hidden bg-white inline-flex space-x-3 p-3 text-sm rounded-xl 
            border border-gray-200 shadow-lg
            animate-in fade-in slide-in-from-bottom-8 blur-in duration-500 ease-out">

    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M16.5 8.31V9a7.5 7.5 0 1 1-4.447-6.855M16.5 3 9 10.508l-2.25-2.25"
              stroke="#22C55E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>

    <div>
        <h3 class="text-slate-700 font-medium">¡Sucesso na operacao!</h3>
        <p class="text-slate-500">Item apagado com sucesso.</p>
    </div>

    <button type="button" aria-label="close" class="cursor-pointer mb-auto text-slate-400 hover:text-slate-600 active:scale-95 transition">
        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect y="12.532" width="17.498" height="2.1" rx="1.05" transform="rotate(-45.74 0 12.532)" fill="currentColor" fill-opacity=".7"/>
            <rect x="12.531" y="13.914" width="17.498" height="2.1" rx="1.05" transform="rotate(-135.74 12.531 13.914)" fill="currentColor" fill-opacity=".7"/>
        </svg>
    </button>
</div>


  <script>
    lucide.createIcons();




    class showItens {
      static async getItens() {
        const data = await fetch(`http://localhost:8000/product`)
        const resykt = await data.json()
        console.log(resykt);


        const itens = document.querySelector(`.itens`)

        resykt.forEach(c => {
          const {
            descricao,
            nome,
            preco,
            imagem,
            id
          } = c

          itens.innerHTML += `<div class="max-w-6xl w-full px-6">
  

  <div class="flex flex-col md:flex-row gap-16 mt-4">
      <div class="flex gap-3">
          <div class="flex flex-col gap-3">
              <div class="border max-w-24 border-gray-500/30 rounded overflow-hidden cursor-pointer">
                  <img src="${imagem}" alt="Thumbnail ${id}">
              </div>
           
          </div>

          <div class="border border-gray-500/30 max-w-100 rounded overflow-hidden">
              <img src="${imagem}" alt="Selected product">
          </div>
      </div>

      <div class="text-sm w-full md:w-1/2">
          <h1 class="text-3xl font-medium">${nome}</h1>

          <div class="flex items-center gap-0.5 mt-1">
              <svg width="14" height="13" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M8.049.927c.3-.921 1.603-.921 1.902 0l1.294 3.983a1 1 0 0 0 .951.69h4.188c.969 0 1.371 1.24.588 1.81l-3.388 2.46a1 1 0 0 0-.364 1.118l1.295 3.983c.299.921-.756 1.688-1.54 1.118L9.589 13.63a1 1 0 0 0-1.176 0l-3.389 2.46c-.783.57-1.838-.197-1.539-1.118L4.78 10.99a1 1 0 0 0-.363-1.118L1.028 7.41c-.783-.57-.38-1.81.588-1.81h4.188a1 1 0 0 0 .95-.69z" fill="#615fff" />
              </svg>
              <svg width="14" height="13" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M8.049.927c.3-.921 1.603-.921 1.902 0l1.294 3.983a1 1 0 0 0 .951.69h4.188c.969 0 1.371 1.24.588 1.81l-3.388 2.46a1 1 0 0 0-.364 1.118l1.295 3.983c.299.921-.756 1.688-1.54 1.118L9.589 13.63a1 1 0 0 0-1.176 0l-3.389 2.46c-.783.57-1.838-.197-1.539-1.118L4.78 10.99a1 1 0 0 0-.363-1.118L1.028 7.41c-.783-.57-.38-1.81.588-1.81h4.188a1 1 0 0 0 .95-.69z" fill="#615fff" />
              </svg>
        
              <p class="text-base ml-2">(4)</p>
          </div>

          <div class="mt-6">
              <p class="text-gray-500/70 line-through">Valor: $${preco}</p>
              
          </div>

          <p class="text-base font-medium mt-6">Descricao</p>
          <ul class="list-disc ml-4 text-gray-500/70">
              <li>${descricao}</li>
      
          </ul>

          <div class="flex items-center mt-10 gap-4 text-base">
              <button class="w-full py-3.5 font-medium bg-gray-100 text-gray-800/80 hover:bg-gray-200 transition cursor-pointer">
                  Add to Cart
              </button>
              <button onclick=deleteItem(${id}) class="w-full py-3.5 font-medium bg-indigo-500 text-white hover:bg-indigo-600 transition cursor-pointer">
                  Apagar item
              </button>
          </div>
      </div>
  </div>
</div>`
        });

      }
    }


    showItens.getItens()



    async function deleteItem(id) {
     

      const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      const data = await fetch(`http://localhost:8000/deleteItem/${id}`, {
        method: "DELETE",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": csrf
        }
      });



      function alertSucess() {
        const alerta = document.getElementById(`alertaSucess`)


        alerta.classList.remove(`hidden`)
        setTimeout(() => {
          alerta.classList.add(`hidden`)
          location.reload()
        }, 5000);
      }

      if (data.ok) {
       alertSucess()
      }


      const reslkt = await data.json()

      console.log(reslkt);
      

    }

    class MenuMobile {
      static menu() {
        const sideBar = document.getElementById("sidebar");
        const btn = document.getElementById("menuBtn");


        const mediaquery = matchMedia("(max-width: 768px)");


        if (mediaquery.matches) {
          showMenu();
        }


        mediaquery.addEventListener("change", (e) => {
          if (e.matches) {
            showMenu();
          } else {
            sideBar.classList.remove("-translate-x-full");
          }
        });


        function showMenu() {
          btn.addEventListener("click", () => {
            sideBar.classList.remove("-translate-x-full");

            closerMenu()
          });
        }


        function closerMenu() {
          const closemeni = document.getElementById(`btnCloser`)

          closemeni.classList.remove(`hidden`)


          closemeni.addEventListener(`click`, () => {
            sideBar.classList.add("-translate-x-full");

          })

        }
      }
    }

    MenuMobile.menu();



    class ObjectValues {

      static objectValues() {
        const imagem = document.getElementById(`imageUrl`).files[0];
        const name = document.getElementById(`name`).value.trim();
        const price = document.getElementById(`price`).value.trim();
        const description = document.getElementById(`description`).value.trim();

        const values = {
          name,
          price,
          description
        };

        console.log(values);

        return {
          values,
          imagem
        };
      }

      static dataForm() {
        const {
          values,
          imagem
        } = ObjectValues.objectValues();

        const form = new FormData();
        form.append('data', JSON.stringify(values));
        if (imagem) {
          form.append('image', imagem);
        }

        return form;
      }
    }



    class Alert {

      static alert(icon, message) {
        Swal.fire({
          icon: icon,
          title: 'Atenção!',
          text: message,
          showConfirmButton: true
        });
      }
    }
    class HttpRequest extends ObjectValues {
      static async request() {
        try {
          const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

          const response = await fetch('http://localhost:8000/product', {
            method: 'POST',
            body: ObjectValues.dataForm(),
            headers: {
              'X-CSRF-TOKEN': token
            },
          });

          const result = await response.json();
          console.log(result);


          if (response.ok) {
            return Alert.alert(`success`, `cadastro feito com sucesso`)
          }


          const v = Object.values(result.erros || result.mensagem).join(`\n`)




          return Alert.alert(`error`, v)
        } catch (error) {
          console.log(error);
        }
      }


    }

    class BtnSend {
      static send() {
        const btn = document.getElementById('save');
        btn.addEventListener('click', (e) => {
          e.preventDefault();
          HttpRequest.request();
        });
      }
    }

    BtnSend.send();





    async function getCountItens() {
      const data = await fetch(`http://localhost:8000/countsProducts`)
      const result = await data.json()

      console.log(result.success[0]);

      const itm = document.getElementById(`totalProdutos`)

      const totalPedidos = document.getElementById(`totalPedidos`)
      const vendidos = document.getElementById(`vendidos`)
      itm.innerText = result.success[0].itensCadastrados
      totalPedidos.innerHTML = result.success[0].pedidosFeitos

      vendidos.innerHTML = result.success[0].totalVendidos
    }


    getCountItens()
  </script>



</body>

</html>