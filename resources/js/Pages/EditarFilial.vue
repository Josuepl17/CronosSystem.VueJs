<template lang="">


    <div id="conteiner-geral">
<!----------------------------------------------------------------------------------->     
      <div id="nav" >

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
  
  
                <input
                      type="checkbox"
                         :id="'userfilial-' + userfilial.id"
                         v-model="form.users"
                         :value="userfilial.id"
                         
                          >

            </div>
  
                </div>
  
  
  
  <br>
  <br>
  <br>
  <br>
  <!----------------------------------------------------------------------------------->
  
                <div id="usuarios">
              <div id="titulo-usuarios"><h3>Usuarios De Outra Filial</h3></div>
  
              <div class="checkbox" v-for="todos in todosusuarios" :key="todos.id">
  
                <label :for="'todos-' + todos.id">{{ todos.name }}</label>
  
                <input
                      type="checkbox"
                         :id="'todos-' + todos.id"
                         v-model="form.users"
                         :value="todos.id"
                         
                          >
  
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
  todosusuarios: Array,
});



const form = useForm({
  razao_social: props.filial.razao_social,
  cnpj: props.filial.cnpj,
  bairro: props.filial.bairro,
  cidade: props.filial.cidade,
  endereco: props.filial.endereco,
  telefone: props.filial.telefone,

});
</script>


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
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 4px;
  cursor: pointer;
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


#box-usuarios{
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 37%;

}


#titulo-usuarios {
  /* Title styling */
  margin-bottom: 10px;
  text-align: center;
}






#usuarios {
  border: 1px solid rgba(0, 0, 0, 0.503);
  display: flex;
  flex-direction: column;
  width: 25%;
  height: 200px;
  background: white;
  min-width: 300px;
}

.checkbox {
  display: flex;
  padding-top: 10px;
  width: 100%;
  height: 20px;
  justify-content: space-between;
  padding-right: 15px;
  padding-left: 15px;
  align-items: center;
}

#titulo-usuarios {
  width: 100%;
  height: 30px;
  display: flex;
  justify-content: center;
  border-bottom: 1px solid black;
  align-items: center;
}

</style>