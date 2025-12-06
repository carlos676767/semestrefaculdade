lucide.createIcons();

class MenuMobile {
    static menu() {
        const sideBar = document.getElementById("sidebar");
        const btn = document.getElementById("menuBtn");

        const mediaquery = matchMedia("(max-width: 768px)");

        if (mediaquery.matches) showMenu();

        mediaquery.addEventListener("change", (e) => {
            if (e.matches) showMenu();
            else sideBar.classList.remove("-translate-x-full");
        });

        function showMenu() {
            btn.addEventListener("click", () => {
                sideBar.classList.remove("-translate-x-full");
                closerMenu();
            });
        }

        function closerMenu() {
            const closemeni = document.getElementById(`btnCloser`);
            closemeni.classList.remove(`hidden`);
            closemeni.addEventListener(`click`, () => {
                sideBar.classList.add("-translate-x-full");
            });
        }
    }
}

MenuMobile.menu();

let pedidos = {};

async function allGetItens() {
    const result = await fetch(`http://localhost:8000/itensAll`);
    const data = await result.json();

    console.log(data);

    const view = document.getElementById("listaPedidos");
    view.innerHTML = "";

    for (let item of data.success) {
        const addreas = `${item.rua} / ${item.estado} / ${item.cep}`;

        pedidos[item.userid] = {
            nome: item.username,
            endereco: addreas,
            pagamento: "Pix",
            status: item.status,
            lat: item.latitude,
            lng: item.longitude,
            itens: item.itensName,
            userId: item.userid,
            idItem: item.id,
        };

        view.innerHTML += `
  <div onclick="abrirPedido(${item.userid})"
    class="p-4 rounded-xl bg-white shadow cursor-pointer border hover:border-indigo-400 transition-all">

    <div class="flex justify-between items-center">
      <h3 class="font-semibold text-gray-800 flex items-center gap-2">
        <i data-lucide="receipt"></i> Pedido #${item.userid}
      </h3>
  
    </div>

    <p class="text-gray-600 text-sm flex items-center gap-2">
      <i data-lucide="user"></i> ${item.username}
    </p>
  </div>`;
    }
}

allGetItens();

const select = document.querySelector(`select`);

function updateStatus(dados) {
    const { userId, idItem, status } = dados;

    select.addEventListener(`change`, async () => {
        const v = select.value;

        const tets = {
            itemId: idItem,
            userId: userId,
            vSelect: v,

            status: status,
        };

      

        const token = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");

        const request = await fetch(`http://localhost:8000/updateItem`, {
            method: `PUT`,
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token,
            },
            body: JSON.stringify({
                itemId: idItem,
                userId: userId,
                vSelect: v,

                status: status,
            }),
        });

        if (request.ok) {
            return Swal.fire({
                title: "sucesso status",
                text: "o status foi atualizado com sucesso",
                icon: "success",
            });
        }

        const data = await request.json();
        console.log(data);
        Swal.fire({
            title: "erro",
            text: "ocorreu um erro ao atualizar, tente novamente.",
            icon: "error",
        });
    });
}

function abrirPedido(id) {
    const dados = pedidos[id];

    updateStatus(dados);



    document.getElementById("detalhesPedido").classList.remove("hidden");

    document.getElementById("dpNome").textContent = dados.nome;
    document.getElementById("dpEndereco").textContent = dados.endereco;
    document.getElementById("dpPagamento").textContent = dados.pagamento;
    document.getElementById("dpStatus").value = dados.status;
    document.getElementById(`dpItens`).innerHTML = dados.itens;

    const valores = [...select.options].map((opt) => opt.value);

    const findItem = valores.filter((c) => c == dados.status);

    if (findItem.length == 1) {
        const selectV = valores.indexOf(dados.status);
        const selectValkue = select.options[selectV];
        selectValkue.disabled = true;
    }

    lucide.createIcons();

   

    const mapa = L.map("map").setView([dados.lat, dados.lng], 15);

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 18,
    }).addTo(mapa);

    L.marker([dados.lat, dados.lng]).addTo(mapa);
}
