<template lang="">

<Layout>
    <template v-slot:conteudo>
<form @submit.prevent="form.post('/create/paciente/detalhes')" >
    

<div id="caixa">

    <div id="lado-esquerdo">
        <div id="texto-principal">
            <div id="titulo-texto">
                    <h1>Josué Pacheco de Lima</h1>
                    
                </div>

            <div id="conteiner-texto">

                  <textarea v-model="form.texto_principal" >
                   
                  </textarea>

               
            </div>

            <div id="rodape">
                <button type="submit">Salvar</button>
               
                <input @change="armazena"  type="file" name="" value="" style="opacity: 0; position: absolute; z-index: -1;"
                ref="fileInput">
                <!--<button type="button" @click="selecionarArquivo">Escolher arquivo</button>-->
                <a href="#" @click.prevent="abrirModal">Novo</a>
                <!--<a href="/download/paciente/detalhes">Donwload</a>-->
            </div> 
        </div>

        <div id="publicacao"></div>
        <div id="publicacao"></div>
        <div id="publicacao"></div>





    </div>




    <div id="lado-direito">

    </div>


</div>

<!--        -->

</form>



<div v-if="mostrarModal" class="modal-overlay">
  <div class="modal-content">
    <h1>Registro de Consulta</h1>
    <br>
    <form @submit.prevent="modal.post('/inserir/tramite')">
      <div class="form-group">
        <input v-model="modal.titulo" type="text" id="titulo" placeholder="Título">
      </div>
      <div class="form-group">
        <textarea v-model="modal.descricao" name="descricao" id="descricao"></textarea>
      </div>
      <a href="#" @click.prevent="fecharModal">Fechar</a>
      <button type="submit">Salvar</button>
    </form>
  </div>
</div>






    </template>
</Layout>

</template>

<script setup >
import { ref } from 'vue';
import { useForm } from "@inertiajs/vue3";


//function selecionarArquivo() {
  //document.querySelector('input[type="file"]').click()
//}

const props = defineProps({
  detalhes: Object,
})



const form = useForm({
  texto_principal: "" || props.detalhes.texto_principal,
  arquivos: null, // Armazena o array de arquivos
});


const modal = useForm({
  titulo: "",
  descricao: "",
})


const armazena = (event) => {
  form.arquivos = event.target.files; // Armazenar os arquivos diretamente no formulário
};

const mostrarModal = ref(false); // Estado da modal, começa fechado

// Função para abrir a modal
const abrirModal = () => {
  mostrarModal.value = true;
};

// Função para fechar a modal
const fecharModal = () => {
  mostrarModal.value = false;
};
</script>



<style>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.7);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.modal-content {
  background-color: white;
  padding: 20px;
  border-radius: 8px;
  width: 850px;
  height: 450px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  z-index: 1001;
  transition: ease-in-out 1s;
  text-align: center;
}

</style>


<style scoped>

.form-group {
      margin-bottom: 10px;
    display: flex;
    align-items: center;

    }

    .form-group textarea {
      width: 100%;
      height: 300px;

    }



    label {
      display: block;
      margin-bottom: 1px;
      font-weight: bold;
    }

    input[type="text"],
    input[type="email"],
    input[type="date"],
    input[type="password"],
    input[type="number"],
    select {
      width: 100%;
      padding: 10px;
      border-radius: 4px;
      border: 1px solid #ccc;
      font-weight: 550;
      
    }

    input:focus {
  outline: none; /* Remove a borda externa (geralmente mais grossa) */
  border: 1px solid #ccc; /* Mantém a borda normal */
}

textarea:focus {
  outline: none; /* Remove a borda externa (geralmente mais grossa) */
  border: 1px solid #ccc; /* Mantém a borda normal */
}



:root {
  --azul-escuro: #012841;
  --azul-claro: #014552;
  --cinza-escuro: #212529;
}

#conteudo {
  background-color: #000000;
}

form {
  all: unset;
}

#caixa {
  display: flex;
  width: 100%;
  height: 100%;
  justify-content: space-between;
  background-color: rgb(185, 193, 201);
}

#lado-esquerdo {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 65%;
  height: 100%;
  overflow: auto;
}

#texto-principal {
  width: 100%;
  margin-bottom: 15px;
  min-height: 340px;
  background-color: #ffffff;
  border-radius: 05px;
}

#titulo-texto {
  border-bottom: 1px solid rgba(0, 0, 0, 0.177);
  width: 100%;
  height: 10%;
  border-radius: 05px 05px 0px 0px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  color: rgb(0, 0, 0);
  padding: 06px;
}

button {
  all: unset;
  padding: 07px 20px 07px 20px;
  background-color: rgb(0, 97, 0);
  border: 1px solid rgba(255, 255, 255, 0.249) ;
  border-radius: 05px;
  color: white;
  margin-right: 10px;
}

a {
  
  padding: 07px 20px 07px 20px;
  background-color: var(--azul-escuro);
  border: 1px solid rgba(255, 255, 255, 0.249) ;
  border-radius: 05px;
  color: white;
  margin-right: 10px;
}




#conteiner-texto {
  width: 100%;
  height: 80%;
  padding: 09px;
  font-family: "Times New Roman", Times, serif;
  font-size: 16px;
}

 textarea {
  width: 100%;
  height: 100%;
  border: 1px solid rgba(0, 0, 0, 0.229);
  border-radius: 04px;
  font-size: 16px;
  padding: 10px;
}



#rodape {
  display: flex;
  justify-content: flex-end;
  align-items: center;
  border: 1px solid rgba(0, 0, 0, 0.212);
  width: 100%;
  height: 10%;
  border-radius: 0px 0px 05px 05px;

  
}



#rodape input {
  color: white;
  padding-right: 10px;
  
}

#publicacao {
  width: 90%;
  min-height: 145px;
  border-radius: 05px;
  margin-bottom: 10px;
  background-color: #ffffff;
}

#lado-direito {
  display: flex;
  width: 34%;
  height: 100%;

  background-color: #ffffff;
}

::-webkit-scrollbar {
  width: 4px; /* Afina a barra de rolagem */
}

::-webkit-scrollbar-thumb {
  background-color: #888; /* Cor da parte móvel da barra de rolagem */
  border-radius: 10px; /* Arredonda as bordas da parte móvel */
}

::-webkit-scrollbar-track {
  background-color: #f1f1f1; /* Cor do fundo da barra de rolagem */
  border-radius: 10px; /* Arredonda as bordas da trilha (opcional) */
}

/* Para Firefox */
* {
  scrollbar-width: thin; /* Afina a barra de rolagem */
  scrollbar-color: #888 #f1f1f1; /* Cor da parte móvel e do fundo */
}
</style>