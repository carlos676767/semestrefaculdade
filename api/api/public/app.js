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
        const data = await fetch(`http://localhost:8000/product`);
        const reseponse = await data.json();

        const show = document.getElementById(`show`);

        console.log(reseponse[0]);

        reseponse.forEach((c) => {
            const { id, nome, imagem, descricao, preco } = c;

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
                    data-produto='${JSON.stringify({
                        id,
                        nome,
                        imagem,
                        descricao,
                        preco,
                    })}'
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
    static alertMy(text, icon, myText) {
        const alerta = document.getElementById(`alerta`);

        alerta.classList.remove("hidden");
        setTimeout(() => alerta.classList.add("hidden"), 4000);

        alerta.innerHTML = `  <div class="flex-shrink-0 bg-green-100 text-green-600 p-2 rounded-full">
<i class="${icon}"></i>

    </div>
    <div>
      <h3 class="font-semibold text-gray-900 text-lg">${myText}!</h3>
      <p class="text-gray-600 text-sm">${text}</p>
    </div>
    <button onclick="fecharAlerta()" class="text-gray-400 hover:text-gray-700 ml-auto">
      <i data-lucide="x" class="w-5 h-5"></i>
    </button>`;
    }
}

class CartShow {
    static value = 0;
    static async showItens(btn) {
        const produto = JSON.parse(btn.dataset.produto);

        const cart = document.getElementById(`cart`);

        const items = cart.querySelectorAll("li[data-id]");

        const ids = Array.from(items).map((item) => item.dataset.id);

        if (ids.includes(String(produto.id))) {
            return Alert.alertMy(
                `ja existe esse item no carrinho.`,
                `fas fa-info-circle`,
                `error`
            );
        }

        Alert.alertMy(
            `adicionado no carrinho`,
            `fas fa-check-circle`,
            `sucesso total!`
        );

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
`;

        const showPrice = document.getElementById(`subtotalValue`);
        const totalValue = document.getElementById(`totalValue`)

        this.value += Number(produto.preco);

        const precoFormatado = this.value.toLocaleString("pt-BR", {
            style: "currency",
            currency: "BRL",
        });

        showPrice.innerHTML = precoFormatado;
    
        totalValue.innerHTML = this.value  +   Number( localStorage.getItem(`frete`))
    }
}

class BtnPay {
    static checkoutBtn = document.getElementById(`checkoutBtn`);

    static btnCep() {
        const btncEP = document.getElementById(`consultarCep`);

        btncEP.addEventListener(`click`, () => {
            CepConsultar.consultarCep(btncEP);
        });
    }
}

LoadItens.load();

BtnPay.btnCep();

class GetIdUser {
    static async getId() {
        const data = await fetch(`http://localhost:8000/idUser`);

       
        return await data.json();
    }
}

class SendAddreas {
    static async sendAddreas() {
        const getLocalStorage = JSON.parse(localStorage.getItem("dados"));
        const id = await GetIdUser.getId();

        getLocalStorage.userId = id.idUser;
      
        


        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

        const data = await fetch("http://localhost:8000/addreas", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
            body: JSON.stringify(getLocalStorage),
        });


        

        if (data.ok) {
       return   AlertJs.alertJs(
            `parabens`,
            `success`,
            `o seu endereco foi cadastrado com sucesso.`
        );



        }


        AlertJs.alertJs(
            `error ao cadastrar`,
            `error`,
            `tente novamente realizar o cadastro reiniciando a pagina.`
        );

        
        
    }
}



class AlertJs {
    static alertJs(title, icon, text) {
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
        });
    }

    static async alertCofirm(title, text, icon) {
        const result = await Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "confirmar",
        });

        if (result.isConfirmed) {
            await SendAddreas.sendAddreas();
          
        }

        document.getElementById(`dialog`).showModal();
    }
}

class CepConsultar {
    static async consultarCep(btn) {
        const token = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");
        const cep = document.getElementById(`cep`).value;

        btn.innerHTML = `aguarde estamos consultando...`;

        const response = await fetch("http://localhost:8000/cep", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token,
            },
            body: JSON.stringify({ cep: cep }),
        });

        btn.innerHTML = `Consultar cep`;
        const data = await response.json();
        if (response.ok) {
            const { address, city, state } = data.cep;
            localStorage.setItem(`dados`, JSON.stringify(data.cep));

            await AlertJs.alertCofirm(
                `confirme seus dados`,
                `${address + ` ` + city + `/` + state}`,
                `info`
            );

            return;
        }

        AlertJs.alertJs(
            `erro ao consultar cep!`,
            `error`,
            data.errors.cep.join(`\n`)
        );
    }
}



async function showFrete(id) {
   
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    const response = await fetch(`http://localhost:8000/frete/${id}`, {
        method: 'GET', 
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token 
        },
    });

   const result = await response.json(); 
   localStorage.setItem(`frete`,  result.success)
   document.getElementById(`shippingValue`).innerText = result.success

   return result
}


class AdreasExist {

    static async getIdUser(){
        const data = await fetch(`http://localhost:8000/idUser`);

        const json = await data.json();

        localStorage.setItem(`userId`, json.idUser)
        return json.idUser
    }

    
    static async setValuesId() {
       
        const id = await AdreasExist.getIdUser()
        
        await this.getAddreasExist(id);
    

        await showFrete(id)

    



    }

    static async getAddreasExist(id) {
        const data = await fetch(
            `http://localhost:8000/userExistAddreas/${id}`
        );
        const testes = await data.json();

        if (testes.success.length <= 0) {
            AlertJs.alertJs(
                `aviso`,
                `info`,
                `voce nao tem um endereco, informe um.`
            );

            setTimeout(() => {
                document.getElementById(`dialog`).showModal();
                BtnPay.btnCep();
            }, 3000);

            return;
        }
    }
}


AdreasExist.setValuesId();


class Payment {
    static async paymant() {
        const select = document.querySelector(`select`).value;
        const items = cart.querySelectorAll("li[data-id]");
        const ids = Array.from(items).map((item) => Number(item.dataset.id));
        const idUser = localStorage.getItem(`userId`);

        console.log({ ids, idUser, select });

       
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        try {
            const response = await fetch("http://localhost:8000/pay", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken, 
                },
                body: JSON.stringify({
                    user_id: idUser,
                    metodo_pagamento: select,
                    produtos: ids,
                }),
            });

            const data = await response.json();

            if (!response.ok) {
                const messages = Object.values(data).join('\n'); 
              return  AlertJs.alertJs(`error ao realizar compra`, `error`, messages)
                
               
            }

            console.log(data.success);
            
            const redirectPage = document.createElement("a");
            redirectPage.href = data.success;
            redirectPage.target = "_blank";
            document.body.appendChild(redirectPage);
            redirectPage.click();
            document.body.removeChild(redirectPage); 
            
          

            const socket = io("http://localhost:3000", { query: { idUser } });

            socket.on("connect", () => {
              console.log("Socket conectado com id:", socket.id);
            });
          
            socket.on("sucesso", (data) => {
                console.log(data);
                
              alert(`💰 Pagamento confirmado! Valor: R$${data.valor}`);
            });
        } catch (error) {
            AlertJs.alertJs(`error ao realizar compra`, `error`, error.message)
        }
    }
}



class buttonPay {
    static btnPays(){
        const checkoutBtn = document.getElementById(`checkoutBtn`);


        checkoutBtn.addEventListener(`click`, () => {
            Payment.paymant()
        })
    }
}


buttonPay.btnPays()