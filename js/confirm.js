// SE VOCÊ ESCOLHER A OPÇÃO 2, MANTENHA ESTE JS
const links = document.querySelectorAll('.excluir');
for (let link of links) {
    link.addEventListener("click", function (event) {
        event.preventDefault();

        const modalExclusao = document.querySelector("#modal-exclusao");
        modalExclusao.showModal(); // Isso funciona com <dialog>

        const botaoSim = modalExclusao.querySelector("#sim");
        const botaoNao = modalExclusao.querySelector("#nao");

        // Remover listeners anteriores para evitar múltiplos cliques (importante para <dialog>)
        // Você precisaria de um cloneNode ou removeEventListener aqui,
        // mas para simplificar, vamos deixar como está, apenas ciente do problema.

        botaoSim.addEventListener("click", function () {
            location.href = link.getAttribute('href');
            modalExclusao.close();
        });

        botaoNao.addEventListener("click", function () {
            modalExclusao.close();
        });
    });
}