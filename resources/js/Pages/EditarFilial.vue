<template lang="">
  <div id="conteiner-geral">
    <!----------------------------------------------------------------------------------->
    <div id="nav">
      <div v-if="mostrarModal" class="modal-overlay">
        <div class="modal-content">
          <h1>Adicionar Usuario</h1>
          <br>
          <form @submit.prevent="adicionar.post('/create/vinculo/user')">
            <div class="input-label">
              <div class="checkbox-item" v-for="outros in outrosfilial" :key="outros.id">
                <label :for="'outros-' + outros.id">{{ outros.name }}</label>
                <input
                  type="checkbox"
                  :id="'todos-' + outros.id"
                  v-model="adicionar.users"
                  :value="outros.id"
                  class="custom-checkbox"
                />
              </div>
              <br><br>
              <div class="fechar-salvar-model">
                <a href="#" @click.prevent="fecharModal">Fechar</a>
                <button type="submit">Salvar</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div v-if="mostrarModal2" class="modal-overlay">
        <div class="modal-content">
          <h1>Adicionar Usuario</h1>
          <br><br>
          <form @submit.prevent="remover.post('/remove/vinculo/user')">
            <div class="input-label">
              <div class="checkbox-item" v-for="userfilial in usuariosfilial" :key="userfilial.id">
                <label :for="'userfilial-' + userfilial.id">{{ userfilial.name }}</label>
                <label :for="'userfilial-' + userfilial.id">{{ userfilial.email }}</label>
                <input
                  type="checkbox"
                  :id="'userfilial-' + userfilial.id"
                  v-model="remover.users"
                  :value="userfilial.id"
                  class="custom-checkbox"
                />
              </div>
              <br><br>
              <div class="fechar-salvar-model">
                <a href="#" @click.prevent="fecharModal2">Fechar</a>
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
        <form @submit.prevent="form.post('/update/filial')">
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
              <label for="cnpj">CNPJ</label>
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
              <label for="ie">Inscrição Estadual:</label>
              <input
                v-model="form.ie"
                type="number"
                id="ie"
                placeholder="Inscrição Estadual:"
              />
              <p style="color: red; font-size: 13px" v-if="errors.ie">
                {{ errors.ie }}
              </p>
            </div>

            <div class="form-group">
              <label for="im">Inscrição Municipal:</label>
              <input
              v-model="form.im"
              type="number"
              id="im"
              placeholder="Inscrição Municipal:"
              />
              <p style="color: red; font-size: 13px" v-if="errors.im">
              {{ errors.im }}
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
           
          </div>



          <div id="endereco">

            <div class="form-group">
              <label for="email">Endereço</label>
              <input
                v-model="form.endereco"
                type="text"
                id="endereco"
                placeholder="Endereço"
              />
            </div>

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
              <Link href="/gerenciar/filial">Voltar</Link>
              <button type="submit" class="salvar">Salvar</button>
            </div>
          </div>
        </form>
      </div>
      <br>
      <div id="box-usuarios">
      


        <div v-if="$page.props.adm" class="form-group">
                      <label for="Medico">Usuarios</label>
                      <div style="height: 300px; border: 1px solid #ccc; overflow-y: auto;">
                          <div v-for="users in props.usuariosFiliais" 
                               :key="users.id" 
                               @click="form.users.includes(users.id) ? form.users = form.users.filter(id => id !== users.id) : form.users.push(users.id)"
                               :style="{ padding: '5px 10px', cursor: 'pointer', backgroundColor: form.users.includes(users.id) ? '#e0e0e0' : 'white' }">
                              {{ users.name }}
                          </div>
                      </div>
                  </div>


      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import { defineProps } from "vue";
import { onMounted } from "vue";

onMounted(() => {
  document.title = " Editar Filial";
});

const props = defineProps({
  filial: Object,
  errors: Object,
  usuariosFiliais: Array,
  usuariosfilialselect: Array,
});

const form = useForm({
  id: props.filial.id,
  razao_social: props.filial.razao_social,
  cnpj: props.filial.cnpj,
  bairro: props.filial.bairro,
  cidade: props.filial.cidade,
  endereco: props.filial.endereco,
  telefone: props.filial.telefone,
  ie: props.filial.ie,
  im: props.filial.im,
  users: props.usuariosfilialselect,
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

#box-usuarios {
  width: 30%;
}

.form-group {
  width: 100%;
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
  background-color: green;
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
  background-color: #f4f4f9;
  border-radius: 10px;
  padding: 20px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
  accent-color: var(--azul-escuro);
  border-radius: 4px;
}

.checkbox-label {
  font-size: 16px;
  color: #333;
  font-weight: 500;
}

.action-buttons {
  display: flex;
  justify-content: flex-end;
  gap: 10px;
  margin-top: auto;
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
