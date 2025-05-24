const formulario = document.querySelector("form");
const campoCep = formulario.querySelector("#cep");
const campoEndereco = formulario.querySelector("#logradouro"); 
const campoNumero = formulario.querySelector("#numero");
const campoBairro = formulario.querySelector("#bairro");
const campoCidade = formulario.querySelector("#cidade");
const campoEstado = formulario.querySelector("#estado");
const botaoBuscar = formulario.querySelector("#buscar");
const mensagemStatus = formulario.querySelector("#status"); 
//const campoTelefone = formulario.querySelector("#telefone"); 

/* Ativação da mascara para telefone cep  */
$(campoTelefone).mask("(00) 0000-0000");
$(campoCep).mask("00000-000"); 


/* Capturando o clique no botão buscar */
botaoBuscar.addEventListener("click", async function(){
    /* Verificando se o CEP não tem 9 digitos */
    if ( campoCep.value.length !== 9 ){
        //informar o usuario sobre o erro
        mensagemStatus.textContent = "Digite um CEP válido";
        mensagemStatus.style.color = "purple";

        //parar completamente a execução do script 
        return;
    }  
     
    /* Guardando o valor do cep didgitado */
    let cepDigitado = campoCep.value;  
    console.log(cepDigitado);
    

   
    
     /* AJAX - asyncronous JavaScript And XML
        tecnica de comunicação (transmissão, recebimento) de dados muito usada
        entre sistemas e tecnologias diferentes. */ 

        //Etapa 1: preparar a url contendo o cep a ser buscado 
        let url = `https://viacep.com.br/ws/${cepDigitado}/json/`;
        console.log(url);
        

        //Etapa 2: acessar a API ( com a url) e aguardar o retotno dela 
        const resposta = await fetch(url); 
        console.log(resposta);
           
        // Etapa 3: extrair os dados do retorno/resposta
         const dados = await resposta.json();
         console.log(dados);
         
        //Etapa 4: lidar com os dados (em caso de erro e sucesso)
        if( "erro" in dados ){
            mensagemStatus.innerHTML = "Cep inexistente!🌙";
            mensagemStatus.style.color = "red";      
        } else {
            mensagemStatus.innerHTML = "Cep encontrado 🌞"; 
            mensagemStatus.style.color = "blue";
            
            // selecionando todos os campos com a classe indicada
            const campos =  formulario.querySelectorAll(".campos-restantes"); 

            //Loop/laço de repetição para acessar acada campo selecionado
            for(const campo of campos){
                campo.classList.remove("campos-restantes");
                campo.style.transition = "2s";
            } 

            /* Atribuir os dados pra acada campo */
            //colocar o lgradouro como valor do campo endereço
             campoEndereco.value = dados.logradouro; 

            //colocar o bairro como valor do campo bairro 
            campoBairro.value = dados.bairro;

            //colocar a localidade como valor do campo cidade
            campoCidade.value = dados.localidade;

            //colocar a uf como valor do campo estado  
            campoEstado.value = dados.uf;
           
        }
    

});// final do evento do botão 


//Codigo do formspree 
var form = document.getElementById("my-form");
  
async function handleSubmit(event) {
  event.preventDefault();
  var status = document.getElementById("my-form-status");
  var data = new FormData(event.target);
  fetch(event.target.action, {
    method: form.method,
    body: data,
    headers: {
        'Accept': 'application/json'
    }
  }).then(response => {
    if (response.ok) {
      status.innerHTML = "Obrigado! mensagem enviada com sucesso. Aguarde nosso retorno";
      form.reset()
    } else {
      response.json().then(data => {
        if (Object.hasOwn(data, 'errors')) {
          status.innerHTML = data["errors"].map(error => error["message"]).join(", ")
        } else {
          status.innerHTML = "Oops! Algo deu errado não está certo... tente novamente mais tarde"
        }
      })
    }
  }).catch(error => {
    status.innerHTML = "Oops! Houve um erro .... fale com o adiministrador pelo email <a href=`mailto@simplicity.com.br`>admin@simplicity.com.br</a>"    
   
  });
}
form.addEventListener("submit", handleSubmit)
