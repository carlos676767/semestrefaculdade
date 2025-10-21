


class Menu {
    static menu = document.getElementById("menu");
    static section = document.getElementById("section");

    static open() {
        const openMenu = document.getElementById("openMenu");
        openMenu.addEventListener("click", () => {
            this.menu.classList.remove("max-md:w-0");
            this.menu.classList.add("max-md:w-full");
            this.section.classList.add("overflow-hidden");
        });
    }

    static closer() {
        const closeMenu = document.getElementById("closeMenu");
        closeMenu.addEventListener("click", () => {
            this.menu.classList.remove("max-md:w-full");
            this.menu.classList.add("max-md:w-0");
            this.section.classList.remove("overflow-hidden");
        });
    }
}

Menu.open();
Menu.closer();

class DarkMode {
    static darkMode() {
        const btn = document.getElementById(`btndark`);

        const darkmode = new Darkmode({
            autoMatchOsTheme: true,
        });
        btn.addEventListener(`click`, () => {
            darkmode.toggle();
        });
    }
}

DarkMode.darkMode();



class LoadItens {
    static async load() {
        const data = await fetch(`http://localhost:8000/product`)
        const reseponse = await data.json()



        const show = document.getElementById(`show`)

        console.log(reseponse[0]);

        reseponse.forEach(c => {
            const { id, nome, imagem, descricao, preco } = c


            show.innerHTML += ` 
            <div class="group relative">
              <img 
                src="${imagem}" 
                alt="${nome}" 
                class="w-full h-80 object-contain object-center rounded-md bg-white"
              />
          
              <div class="mt-4 flex justify-between">
                <div>
                  <h3 class="text-sm text-gray-700">
                    <a href="#"><span aria-hidden="true" class="absolute inset-0"></span>${nome}</a>
                  </h3>
                  <p class="mt-1 text-sm text-gray-500">${descricao}</p>
                </div>
                <p class="text-sm font-medium text-gray-900">$${preco}</p>
              </div>
          
              <div class="mt-2 flex justify-center">
                <div class="rainbow relative z-0 overflow-hidden p-0.5 flex items-center justify-center rounded-full hover:scale-105 transition duration-300 active:scale-100 w-full">
                  <button 
                    class="w-full px-6 py-2 text-sm text-white rounded-full font-medium bg-gray-800 flex items-center justify-center gap-2 hover:bg-gray-900 transition"
                    data-produto='${JSON.stringify({ id, nome, imagem, descricao, preco })}'
                    onclick="CartShow.showItens(this)"
                  >
                    <i class="fa-solid fa-cart-shopping"></i>
                    Adicionar ao carrinho
                  </button>
                </div>
              </div>
            </div>
          `;
          
          

        });



    }



}



class Alert {
    static alertMy(text, icon, myText){
        const alerta = document.getElementById(`alerta`)

        alerta.classList.remove('hidden');
        setTimeout(() => alerta.classList.add('hidden'), 4000);

        alerta.innerHTML =`  <div class="flex-shrink-0 bg-green-100 text-green-600 p-2 rounded-full">
<i class="${icon}"></i>

    </div>
    <div>
      <h3 class="font-semibold text-gray-900 text-lg">${myText}!</h3>
      <p class="text-gray-600 text-sm">${text}</p>
    </div>
    <button onclick="fecharAlerta()" class="text-gray-400 hover:text-gray-700 ml-auto">
      <i data-lucide="x" class="w-5 h-5"></i>
    </button>`
    }
}

class CartShow {
  static value = 0
    static showItens(btn){
      
        const produto = JSON.parse(btn.dataset.produto);




        const cart = document.getElementById(`cart`)

        const items = cart.querySelectorAll("li[data-id]");

    
        
        const ids = Array.from(items).map(item => item.dataset.id);

        

        if (ids.includes(String(produto.id))) {
            return Alert.alertMy(`ja existe esse item no carrinho.`,`fas fa-info-circle`,`error`)
        }



                
         Alert.alertMy(`adicionado no carrinho`,`fas fa-check-circle`,`sucesso total!`)
     

        cart.innerHTML += `<li class="flex py-6" data-id="${produto.id}"> 
        <div class="size-24 shrink-0 overflow-hidden rounded-md border border-gray-200">
          <img src="${produto.imagem}"
            alt="Throwback Hip Bag"
            class="size-full object-cover" />
        </div>
        <div class="ml-4 flex flex-1 flex-col">
          <div>
            <div class="flex justify-between text-base font-medium text-gray-900">
              <h3><a href="#">${produto.nome}</a></h3>
              <p class="ml-4">${produto.preco}</p>
            </div>
            <p class="mt-1 text-sm text-gray-500">descricao: ${produto.descricao}</p>
          </div>
          <div class="flex flex-1 items-end justify-between text-sm">
            <p class="text-gray-500">Qtd 1</p>
           
          </div>
        </div>
   </li>
`



const showPrice = document.getElementById(`subtotalValue`)

this.value += Number(produto.preco)









const precoFormatado = this.value.toLocaleString("pt-BR", {
   style: "currency",
   currency: "BRL"
});


showPrice.innerHTML = precoFormatado;

    }


    
}


class BtnPay {
    static btnSendV(){
        const checkoutBtn = document.getElementById(`checkoutBtn`)
        console.log(checkoutBtn);
        

        checkoutBtn.addEventListener(`click`,() => {
            // const cart = document.getElementById(`cart`)
            // const items = cart.querySelectorAll("li[data-id]");

            // const ids = Array.from(items).map(item => item.dataset.id);
            // console.log(ids);
            
            // alert(items)
        })
    }
}
LoadItens.load()
BtnPay.btnSendV()