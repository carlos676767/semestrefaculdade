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
        const totalValue = document.getElementById(`totalValue`);

        this.value += Number(produto.preco);

        const precoFormatado = this.value.toLocaleString("pt-BR", {
            style: "currency",
            currency: "BRL",
        });

        showPrice.innerHTML = precoFormatado;

        totalValue.innerHTML =
            this.value + Number(localStorage.getItem(`frete`));
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

        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");

        const data = await fetch("http://localhost:8000/addreas", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
            body: JSON.stringify(getLocalStorage),
        });

        if (data.ok) {
            return AlertJs.alertJs(
                `parabens`,
                `success`,
                `o seu endereco foi cadastrado com sucesso.`
            );
        }

        const result = await data.json();
        console.log(result);

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
    const token = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    const response = await fetch(`http://localhost:8000/frete/${id}`, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": token,
        },
    });

    const result = await response.json();
    localStorage.setItem(`frete`, result.success);
    document.getElementById(`shippingValue`).innerText = result.success;

    return result;
}

class AdreasExist {
    static async getIdUser() {
        const data = await fetch(`http://localhost:8000/idUser`);

        const json = await data.json();

        localStorage.setItem(`userId`, json.idUser);
        return json.idUser;
    }

    static async setValuesId() {
        const id = await AdreasExist.getIdUser();

        await this.getAddreasExist(id);

        await showFrete(id);
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

function notification() {
    const notification = document.getElementById("paymentNotification");
    const closeBtn = document.getElementById("closePaymentNotification");

    const myTitlleDefault = document.title;

    document.title = "🔔 Você tem uma nova notificação!";

    setTimeout(() => {
        notification.classList.remove("translate-x-full");
        notification.classList.add("translate-x-0");
    }, 100);

    closeBtn.addEventListener("click", () => {
        notification.classList.remove("translate-x-0");
        notification.classList.add("translate-x-full");
    });

    setTimeout(() => {
        notification.classList.remove("translate-x-0");
        notification.classList.add("translate-x-full");
        document.title = myTitlleDefault;
    }, 30000);
}
class Payment {
    static async paymant() {
        const select = document.querySelector(`select`).value;
        const items = cart.querySelectorAll("li[data-id]");
        const ids = Array.from(items).map((item) => Number(item.dataset.id));
        const idUser = localStorage.getItem(`userId`);

        console.log({ ids, idUser, select });

        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");

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

            console.log(data);

            if (!response.ok) {
                const messages = Object.values(data).join("\n");
                return AlertJs.alertJs(
                    `error ao realizar compra`,
                    `error`,
                    messages
                );
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
                notification();
            });
        } catch (error) {
            AlertJs.alertJs(`error ao realizar compra`, `error`, error.message);
        }
    }
}

class buttonPay {
    static btnPays() {
        const checkoutBtn = document.getElementById(`checkoutBtn`);

        checkoutBtn.addEventListener(`click`, () => {
            Payment.paymant();
        });
    }
}

buttonPay.btnPays();

async function showItensPay() {
    const idUser = localStorage.getItem(`userId`);
    const data = await fetch(`http://localhost:8000/itens/${idUser}`);
    const response = await data.json();

    document.getElementById(`itens`).innerHTML = response.success
        .map((c) => c.item_formatado)
        .join(`\n`);
}

showItensPay();

function getPdf() {
    const pdfBtn = document.getElementById(`pdf`);

    const idUser = localStorage.getItem(`userId`);
    pdfBtn.addEventListener(`click`, () => {
        location.href = `http://localhost:8000/pdf/${idUser}`;
    });
}

getPdf();

function atualizarContador() {
    const reloj = document.getElementById(`clock`);
    const final = new Date("2026-11-30T23:59:59");
    const agora = new Date();

    const diff = final - agora;

    if (diff <= 0) {
        reloj.innerHTML = "Promoção encerrada!";
        return;
    }

    const minutos = Math.floor(diff / 1000 / 60);
    const horas = Math.floor(minutos / 60);
    const dias = Math.floor(horas / 24);

    const horasRestantes = horas % 24;
    const minutosRestantes = minutos % 60;

    reloj.innerHTML = `${dias}d • ${horasRestantes}h • ${minutosRestantes}min`;
}

setInterval(atualizarContador, 1000);
atualizarContador();

function faqs() {
    const faqs = [
        {
            question: "Qual é o prazo de entrega?",
            answer: "As entregas do Supermercado Sorriso são realizadas geralmente em até 24h dentro da cidade.",
        },
        {
            question: "Quais formas de pagamento aceitam?",
            answer: "Aceitamos Pix, Débito, Crédito, Dinheiro e Vale Alimentação.",
        },
        {
            question: "Tem promoções todos os dias?",
            answer: "Sim! Trabalhamos com ofertas diárias e promoções semanais exclusivas.",
        },
        {
            question: "Consigo rastrear meu pedido?",
            answer: "Sim, após o pagamento você recebe um código para acompanhar o status da entrega.",
        },
    ];

    const container = document.getElementById("faqContainer");

    faqs.forEach((faq, index) => {
        const wrapper = document.createElement("div");
        wrapper.className = "border-b border-slate-200 py-4 cursor-pointer";

        const header = document.createElement("div");
        header.className = "flex items-center justify-between";
        header.innerHTML = `
            <h3 class="text-base font-medium text-gray-900">${faq.question}</h3>
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                xmlns="http://www.w3.org/2000/svg"
                class="transition-all duration-500 ease-in-out icon">
                <path d="m4.5 7.2 3.793 3.793a1 1 0 0 0 1.414 0L13.5 7.2"
                    stroke="#1D293D" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        `;

        const answer = document.createElement("p");
        answer.className =
            "text-sm text-slate-500 transition-all duration-500 ease-in-out max-w-md opacity-0 max-h-0 -translate-y-2 pt-0 answer";
        answer.textContent = faq.answer;

        wrapper.appendChild(header);
        wrapper.appendChild(answer);
        container.appendChild(wrapper);

        header.addEventListener("click", () => {
            const allAnswers = document.querySelectorAll(".answer");
            const allIcons = document.querySelectorAll(".icon");

            allAnswers.forEach((el, i) => {
                if (i === index) {
                    const isOpen = el.classList.contains("opacity-100");
                    el.classList.toggle("opacity-100", !isOpen);
                    el.classList.toggle("max-h-[300px]", !isOpen);
                    el.classList.toggle("translate-y-0", !isOpen);
                    el.classList.toggle("pt-4", !isOpen);
                    el.classList.toggle("opacity-0", isOpen);
                    el.classList.toggle("max-h-0", isOpen);
                    el.classList.toggle("-translate-y-2", isOpen);

                    allIcons[i].classList.toggle("rotate-180", !isOpen);
                } else {
                    el.classList.remove(
                        "opacity-100",
                        "max-h-[300px]",
                        "translate-y-0",
                        "pt-4"
                    );
                    el.classList.add("opacity-0", "max-h-0", "-translate-y-2");
                    allIcons[i].classList.remove("rotate-180");
                }
            });
        });
    });
}

faqs();

function cards() {
    const cardsData = [
        {
            image: "https://images.unsplash.com/photo-1633332755192-727a05c4013d?q=80&w=200",
            name: "Maria Ferreira",
            handle: "@mariaf",
            date: "Abril 20, 2025",
            comment:
                "O Supermercado Sorriso tem preços excelentes e estoque sempre completo. Adoro comprar lá!",
        },
        {
            image: "https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?q=80&w=200",
            name: "João Mendes",
            handle: "@joaomendes",
            date: "Maio 10, 2025",
            comment:
                "Atendimento top! A equipe é super educada e ajuda sempre que preciso. Sorriso é o melhor!",
        },
        {
            image: "https://images.unsplash.com/photo-1527980965255-d3b416303d12?w=200&auto=format&fit=crop&q=60",
            name: "Carla Dias",
            handle: "@carla.dias",
            date: "Junho 5, 2025",
            comment:
                "As promoções do Supermercado Sorriso fazem muita diferença no bolso. Ótima opção para economizar!",
        },
        {
            image: "https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?w=200&auto=format&fit=crop&q=60",
            name: "Lucas Henrique",
            handle: "@lucashenrique",
            date: "Maio 10, 2025",
            comment:
                "Produtos sempre frescos, frutas bonitas e carnes de qualidade. Supermercado Sorriso é referência!",
        },
        {
            image: "https://images.unsplash.com/photo-1502685104226-ee32379fefbe?w=200",
            name: "Fernanda Silva",
            handle: "@fer.silva",
            date: "Abril 02, 2025",
            comment:
                "Ambiente limpo, organizado e agradável. Dá gosto fazer compras no Supermercado Sorriso!",
        },
        {
            image: "https://images.unsplash.com/photo-1544723795-3fb6469f5b39?w=200",
            name: "Ricardo Lopes",
            handle: "@ricardo.lps",
            date: "Julho 11, 2025",
            comment:
                "A padaria do Supermercado Sorriso é simplesmente maravilhosa! Pão fresquinho todo dia!",
        },
    ];

    const row1 = document.getElementById("row1");
    const row2 = document.getElementById("row2");

    const createCard = (card) => `
        <div class="p-4 rounded-lg mx-4 shadow hover:shadow-lg transition-all duration-200 w-72 shrink-0">
            <div class="flex gap-2">
                <img class="size-11 rounded-full" src="${card.image}" alt="User Image">
                <div class="flex flex-col">
                    <div class="flex items-center gap-1">
                        <p>${card.name}</p>
                        <svg class="mt-0.5" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.555.72a4 4 0 0 1-.297.24c-.179.12-.38.202-.59.244a4 4 0 0 1-.38.041c-.48.039-.721.058-.922.129a1.63 1.63 0 0 0-.992.992c-.071.2-.09.441-.129.922a4 4 0 0 1-.041.38 1.6 1.6 0 0 1-.245.59 3 3 0 0 1-.239.297c-.313.368-.47.551-.56.743-.213.444-.213.96 0 1.404.09.192.247.375.56.743.125.146.187.219.24.297.12.179.202.38.244.59.018.093.026.189.041.38.039.48.058.721.129.922.163.464.528.829.992.992.2.071.441.09.922.129.191.015.287.023.38.041.21.042.411.125.59.245.078.052.151.114.297.239.368.313.551.47.743.56.444.213.96.213 1.404 0 .192-.09.375-.247.743-.56.146-.125.219-.187.297-.24.179-.12.38-.202.59-.244a4 4 0 0 1 .38-.041c.48-.039.721-.058.922-.129.464-.163.829-.528.992-.992.071-.2.09-.441.129-.922a4 4 0 0 1 .041-.38c.042-.21.125-.411.245-.59.052-.078.114-.151.239-.297.313-.368.47-.551.56-.743.213-.444.213-.96 0-1.404-.09-.192-.247-.375-.56-.743a4 4 0 0 1-.24-.297 1.6 1.6 0 0 1-.244-.59 3 3 0 0 1-.041-.38c-.039-.48-.058-.721-.129-.922a1.63 1.63 0 0 0-.992-.992c-.2-.071-.441-.09-.922-.129a4 4 0 0 1-.38-.041 1.6 1.6 0 0 1-.59-.245A3 3 0 0 1 7.445.72C7.077.407 6.894.25 6.702.16a1.63 1.63 0 0 0-1.404 0c-.192.09-.375.247-.743.56m4.07 3.998a.488.488 0 0 0-.691-.69l-2.91 2.91-.958-.957a.488.488 0 0 0-.69.69l1.302 1.302c.19.191.5.191.69 0z" fill="#2196F3" />
                        </svg>
                    </div>
                    <span class="text-xs text-slate-500">${card.handle}</span>
                </div>
            </div>

            <p class="text-sm py-4 text-gray-800">
                ${card.comment}
            </p>

            <div class="flex items-center justify-between text-slate-500 text-xs">
                <div class="flex items-center gap-1">
                    <span>Postado em</span>
                    <a href="https://x.com" target="_blank" class="hover:text-sky-500">
                        <svg width="11" height="10" viewBox="0 0 11 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="m.027 0 4.247 5.516L0 10h.962l3.742-3.926L7.727 10H11L6.514 4.174 10.492 0H9.53L6.084 3.616 3.3 0zM1.44.688h1.504l6.64 8.624H8.082z" fill="currentColor" />
                        </svg>
                    </a>
                </div>
                <p>${card.date}</p>
            </div>
        </div>
    `;

    const renderCards = (target) => {
        const doubled = [...cardsData, ...cardsData];
        doubled.forEach((card) =>
            target.insertAdjacentHTML("beforeend", createCard(card))
        );
    };

    renderCards(row1);
    renderCards(row2);
}

cards();

function traducao() {
    i18next .init({
            lng: "pt",
            resources: {
               
                en: {
                    translation: {
                        promocoes: "Contact us via WhatsApp.",
                        contatoWpp: "Contact us via WhatsApp.",
                        familia: "Your family's trusted supermarket.",
                        sub: "At Sorriso Supermarkets you'll find the best prices, quality, and variety in every department.",
                    },
                },
            },
        })
        .then(updateContent);

}






// function updateContent() {
//     document.getElementById("title").innerText = i18next.t("title");
//     document.getElementById("text").innerText = i18next.t("text");
// }

// function changeLang(lang) {
//     i18next.changeLanguage(lang).then(updateContent);
// }