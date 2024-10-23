<template lang="">

<Layout>
    <template v-slot:conteudo>
<form @submit.prevent="form.post('/teste')" >
    

<div id="caixa">

    <div id="lado-esquerdo">
        <div id="texto-principal">
            <div id="titulo-texto">
                    <h1>Josué Pacheco de Lima</h1>
                    <a @click.prevent="isModalOpen = true" href="">Novo</a>
                </div>

            <div id="conteiner-texto">
                <textarea v-model="form.TextoPrincipal" rows="" cols=""></textarea  >
            </div>

            <div id="rodape">
                <button type="submit">Salvar</button>
               
                <input @change="armazena"  type="file" name="" value="" style="color:white;" multiple >
            </div>
        </div>

        <div id="publicacao"></div>
        <div id="publicacao"></div>
        <div id="publicacao"></div>





    </div>




    <div id="lado-direito">

    </div>


</div>
</form>
    </template>
</Layout>

</template>

<script setup >
import { useForm } from "@inertiajs/vue3";

const form = useForm({
TextoPrincipal: "",
arquivos: null,
  crp: "",
  especialidade: "",
  telefone: "",
  email: "",
  endereco: "",
  cidade: "",
  bairro: "",
});



const armazena = (event) => {
  form.arquivos = event.target.files; // Armazenar os arquivos diretamente no formulário
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
  width: 600px;
  height: 400px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  z-index: 1001;
  transition: ease-in-out 1s;
  text-align: center;
}

</style>


<style scoped>
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
  color: white;
  background-color: var(--azul-escuro);
  padding: 06px;
}

#titulo-texto a {
    all: unset;
  padding: 07px 20px 07px 20px;
  background-color: rgb(0, 108, 0);
  border-radius: 05px;
  color: white;
  margin-right: 10px;
}

#conteiner-texto {
  width: 100%;
  height: 80%;
  padding: 15px;
  font-family: "Times New Roman", Times, serif;
  font-size: 16px;
}

#conteiner-texto textarea {
  width: 100%;
  height: 100%;
  border: none;
  outline: none;
  font-size: 16px;
}

textarea:focus {
  border: none; /* Remove a borda ao clicar */
}

#rodape {
  display: flex;
  justify-content: flex-end;
  align-items: center;
  border: 1px solid black;
  width: 100%;
  height: 10%;
  border-radius: 0px 0px 05px 05px;
  background-color: var(--azul-escuro);
}

#rodape button {
    all: unset;
  padding: 07px 20px 07px 20px;
  background-color: rgb(0, 108, 0);
  border-radius: 05px;
  color: white;
  margin-right: 10px;
}

#rodape input {
  color: white;

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