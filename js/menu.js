document.addEventListener('DOMContentLoaded', function () {
  const btn = document.getElementById('menuBtn');
  const menu = document.getElementById('menuNav');

  btn.addEventListener('click', function () {
    menu.classList.toggle('show');
  });

  const postCards = document.querySelectorAll(".post");  
    const postModal = document.getElementById('postModal');
    const postModalFechar = document.querySelectorAll('.fechar-modal');

    // Abrir modal ao clicar na card
    postCards.forEach(card => {
        card.addEventListener('click', function () {
            postModal.style.display = 'block';
            postModal.offsetHeight; // Forçar reflow
            postModal.classList.add('ativo');
            document.body.style.overflow = 'hidden';
        });
    });

    // Função para fechar o modal
    function fecharModal() {
        postModal.classList.remove('ativo');
        setTimeout(() => {
            postModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }, 300);
    }

    // Fechar modal ao clicar no botão "fechar" ou no fundo
    postModalFechar.forEach(fechar => {
        fechar.addEventListener('click', fecharModal);
    });

    window.addEventListener('click', function (event) {
        if (event.target === postModal) {
            fecharModal();
        }
    });
});