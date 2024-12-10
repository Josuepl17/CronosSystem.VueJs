<template lang="">


    <div id="conteiner-geral">


<!----------------------------------------------------------------------------------->  








<!----------------------------------------------------------------------------------->     
      <div id="nav" >

      

        <div v-if="mostrarModal" class="modal-overlay">
  <div class="modal-content">
    <h1>Adicionar Usuario</h1>
    <br>
    <form @submit.prevent="adicionar.post('/create/vinculo/user')">

      <div class="checkbox-item" v-for="outros in outrosfilial" :key="outros.id">


              <div class="input-label" >

                <label :for="'outros-' + outros.id" >{{ outros.name }}</label>

                <input
                  type="checkbox"
                  :id="'todos-' + outros.id"
                  v-model="adicionar.users"
                  :value="outros.id"
                  class="custom-checkbox"
                />
              </div>



              <div class="fechar-salvar-model" >
                <a href="#" @click.prevent="fecharModal">Fechar</a>
                <button type="submit">Salvar</button>
              </div>

            </div>
     

    </form>
  </div>
</div>


      </div>
<!----------------------------------------------------------------------------------->  
        <div id="conteudo">
          <div class="filial">
            <form @submit.prevent="form.post('/teste')">
              <div id="pessoais">
                <div class="form-group">
                  <label for="nome">Razão Social</label>
                  <input
                    type="text"
                    id="nome"
                    v-model="form.razao_social"
                    placeholder="Nome Completo"
                  />
                </div>


                <div class="form-group">
                  <label for="cnpj">CPF/RG</label>
                  <input
                    v-model="form.cnpj"
                    type="number"
                    id="cnpj"
                    placeholder="CNPJ:"
                  />
                  <p style="color: red; font-size: 13px" v-if="errors.cnpj">
                    {{ errors.cnpj }}
                  </p>
                </div>
  
                <div class="form-group">
                  <label for="telefone">Telefone</label>
                  <input
                    v-model="form.telefone"
                    type="number"
                    id="telefone"
                    placeholder="Telefone:"
                  />
                </div>
                <div class="form-group">
                  <label for="email">Endereço</label>
                  <input
                    v-model="form.endereco"
                    type="text"
                    id="endereco"
                    placeholder="Endereço"
                  />
                </div>
              </div>
  
              <div id="endereco">
                <div class="form-group">
                  <label for="endereco">Cidade</label>
                  <input
                    v-model="form.cidade"
                    type="text"
                    id="cidade"
                    placeholder="Cidade"
                  />
                </div>


                <div class="form-group">
                  <label for="bairro">Bairro</label>
                  <input
                    v-model="form.bairro"
                    type="text"
                    id="bairro"
                    placeholder="Bairro"
                  />
                </div>



                <div class="fechar-salvar">
                  <button type="button" class="fechar">Fechar</button>
                  <button type="submit" class="salvar">Salvar</button>
                </div>
              </div>
            </form>
          </div>

          <br>





<div id="box-usuarios" >
  <!----------------------------------------------------------------------------------->
  
            <div id="usuarios">
              <div id="titulo-usuarios"><h3>Usuarios Da Filial</h3></div>

              
  
              <div class="checkbox" v-for="userfilial in usuariosfilial" :key="userfilial.id">
  
                <label :for="'userfilial-' + userfilial.id">{{ userfilial.name }}</label>
  


            </div>

            <br><br>
            <a href="#" @click.prevent="abrirModal">Adicionar</a>
  
                </div>
  
  
  
  <br>
  <br>
  <br>
  <br>
  <!----------------------------------------------------------------------------------->
  
                <div id="usuarios">
              <div id="titulo-usuarios"><h3>Usuarios De Outra Filial</h3></div>
  
              <div class="checkbox" v-for="outros in outrosfilial" :key="outros.id">
  
                <label :for="'outros-' + outros.id">{{ outros.name }}</label>
  
  
            </div>
  
                </div>
  <!----------------------------------------------------------------------------------->
</div>




        </div><!-- conteudo -->
       
      </div> <!--conteiner-geral-->
      



</template>

<script setup >
import { ref } from 'vue';
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
  filial: Object,

  errors: Array,
  usuariosfilial: Array,
  outrosfilial: Array,
});



const form = useForm({
  razao_social: props.filial.razao_social,
  cnpj: props.filial.cnpj,
  bairro: props.filial.bairro,
  cidade: props.filial.cidade,
  endereco: props.filial.endereco,
  telefone: props.filial.telefone,

});

const adicionar = useForm({
 users: [],
});



const mostrarModal = ref(false); // Usando ref() para reatividade


const abrirModal = () => {
  mostrarModal.value = true;
  console.log('mostrarModal:', mostrarModal.value); // Depuração
};

const fecharModal = () => {
  mostrarModal.value = false;
  console.log('mostrarModal:', mostrarModal.value); // Depuração
};










</script>



<style scoped >

a {
  display: flex;
  padding: 07px 20px 07px 20px;
  background-color: var(--azul-escuro);
  border: 1px solid rgba(255, 255, 255, 0.249);
  border-radius: 05px;
  color: white;
  margin-right: 10px;
  height: 35px;
  width: 70px;
  justify-content: center;
  
}

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
  height: 450px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  z-index: 1001;
  transition: ease-in-out 1s;
  text-align: center;
}


.checkbox-item{
display: flex;
flex-direction: column;
width: 100%;


}

.input-label{
  display: flex;
  height: 10%;
  width: 100%;
  flex-direction: row;
  justify-content: space-around;
  align-items: center;
  border: 1px solid rgba(0, 0, 0, 0.114);
  border-radius: 05px;

}

.fechar-salvar-model{
  display: flex;
  height: 10%;
  width: 100%;
  flex-direction: row;
  justify-content: right;
  padding-right: 05px;
  align-items: center;

}

</style>


<style scoped>
* {
  box-sizing: border-box;
  padding: 0px;
  margin: 0px;
  
}



:root {
  --azul-escuro: #012841;
  --azul-claro: #00657c;
  --cinza-escuro: #212529;
}

#conteiner-geral {
  width: 100%;
  height: 100dvh;
  
}

#nav {
  height: 05%;
  background-color: var(--azul-escuro);
}

#conteudo {
  display: flex;
  flex-wrap: wrap;
  width: 100%;
  height: 95%;
  justify-content: space-around;
  padding-top: 10px;

}



.filial {
  width: 57%;
  min-width: 500px;
  height: 60%;
  padding: 20px;
  overflow: auto;
  border: 1px solid rgba(0, 0, 0, 0.503);
  border-radius: 04px;
}

#endereco {
  width: 50%;
}


#pessoais {
  padding-right: 20px;

  width: 50%;
}

form {
  display: flex;
  flex-direction: row;
  width: 100%;
  height: 100%;
}

.form-group {
  margin-bottom: 10px;
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
}

button {
  display: flex;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 4px;
  cursor: pointer;
  height: 35px;
  width: 70px;
  background-color:green;
  justify-content: center;
}

button.salvar {
  background-color: #4caf50;
}

button.fechar {
  background-color: #9d9d9d;
}

.fechar-salvar {
  display: flex;
  justify-content: space-between;
  
}
</style>


<style>


#conteiner-geral {
  width: 100%;
  height: 100dvh;
}


#usuarios {
  width: 100%;
  background-color: #f4f4f9; /* Cor de fundo clara */
  border-radius: 10px;
  padding: 20px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra elegante */
  display: flex;
  flex-direction: column;
}

#titulo-usuarios h3 {
  text-align: center;
  font-size: 24px;
  color: #333;
  margin-bottom: 20px;
  font-weight: bold;
}

/* Lista de checkboxes centralizada */
.checkbox-list {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 20px;
  padding-bottom: 20px;
}

.checkbox-item {
  display: flex;
  align-items: center;
  gap: 10px;
}

.custom-checkbox {
  width: 20px;
  height: 20px;
  accent-color: var(--azul-escuro); /* Cor personalizada do checkbox */
  border-radius: 4px;
}

.checkbox-label {
  font-size: 16px;
  color: #333;
  font-weight: 500;
}

/* Botões no final, alinhados à direita */
.action-buttons {
  display: flex;
  justify-content: flex-end; /* Alinhamento à direita */
  gap: 10px; /* Espaçamento entre os botões */
  margin-top: auto; /* Para garantir que os botões fiquem no final */
}

.btn {
  padding: 10px 20px;
  font-size: 14px;
  border-radius: 5px;
  border: none;
  cursor: pointer;
  text-transform: uppercase;
}

.btn-save {
  background-color: var(--azul-escuro);
  color: white;
  transition: background-color 0.3s;
}

.btn-save:hover {
  background-color: #0056b3;
}

.btn-close {
  background-color: #ccc;
  color: #333;
  transition: background-color 0.3s;
}

.btn-close:hover {
  background-color: #999;
}

</style>