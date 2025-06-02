document.addEventListener('DOMContentLoaded', function() {
    const formEvento = document.querySelector('form'); // Seleciona o formulário (ajuste se ele tiver um ID específico, tipo: document.getElementById('formCriarEvento'))
    const inputDataEvento = document.getElementById('dataEvento'); // Agora usando 'dataEvento'
    const feedbackDataEvento = document.getElementById('feedbackDataEvento'); // Seleciona o div de feedback

    if (formEvento && inputDataEvento && feedbackDataEvento) { // Garante que todos os elementos foram encontrados
        formEvento.addEventListener('submit', function(event) {
            const dataAtual = new Date();
            dataAtual.setHours(0, 0, 0, 0); // Zera a hora para comparar apenas o dia

            const dataEvento = new Date(inputDataEvento.value);
            dataEvento.setHours(0, 0, 0, 0); // Zera a hora para comparar apenas o dia

            // Validação: data do evento não pode ser antes do dia atual
            if (dataEvento < dataAtual) {
                event.preventDefault(); // Impede o envio do formulário
                inputDataEvento.classList.add('is-invalid'); // Adiciona a classe de erro do Bootstrap
                feedbackDataEvento.textContent = "A data do evento não pode ser antes do dia atual."; // Define a mensagem de erro
            } else {
                inputDataEvento.classList.remove('is-invalid'); // Remove a classe de erro se estiver válida
                inputDataEvento.classList.add('is-valid'); // Opcional: Adiciona classe de sucesso para feedback visual
            }
        });

        // Opcional: Validação em tempo real (enquanto o usuário muda a data)
        inputDataEvento.addEventListener('change', function() {
            const dataAtual = new Date();
            dataAtual.setHours(0, 0, 0, 0);

            const dataEvento = new Date(inputDataEvento.value);
            dataEvento.setHours(0, 0, 0, 0);

            if (dataEvento < dataAtual) {
                inputDataEvento.classList.add('is-invalid');
                feedbackDataEvento.textContent = "A data do evento não pode ser antes do dia atual.";
            } else {
                inputDataEvento.classList.remove('is-invalid');
                inputDataEvento.classList.add('is-valid');
                feedbackDataEvento.textContent = ""; // Limpa a mensagem de erro
            }
        });
    } else {
        // Isso ajuda a depurar se os elementos não forem encontrados
        console.warn("Elementos do formulário ou feedback de data não encontrados no DOM.");
    }
});