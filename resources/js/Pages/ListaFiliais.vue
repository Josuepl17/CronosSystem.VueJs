<template>
  <div id="conteiner-geral">
    <div id="nav">
      <Link href="/dash">Voltar</Link>
    </div>
    <div id="conteudo">
      <div class="filial">
        <h2>Lista de Filiais</h2>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>CNPJ</th>
              <th>X</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="filial in todasfiliais" :key="filial.id">
              <td>{{ filial.id }}</td>
              <td>{{ filial.razao_social }}</td>
              <td>{{ filial.cnpj }}</td>
              <td>
                <Link :href="'/editar/filial/' + filial.id">Editar</Link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { onMounted } from "vue";

const props = defineProps({
  todasfiliais: Array,
});



onMounted(() => {
  document.title = "Filiais";
});
</script>

<style scoped>
* {
  box-sizing: border-box;
  padding: 0px;
  margin: 0px;
}

a{
margin-left: 05px;
color: rgb(0, 0, 0);
padding: 05px;
background: white;
border-radius: 04px ;

}

:root {
  --azul-escuro: #012841;
  --azul-claro: #00657c;
  --cinza-escuro: #212529;
}

#conteiner-geral {
  width: 100%;
  height: 100vh;
}

#nav {
  display: flex;
  justify-content: flex-start;
  align-items: center;
  height: 8%;
  background-color: var(--azul-escuro);
}

body {
  background-color: #33333328;
}

#conteudo {
  display: flex;
  flex-wrap: wrap;
  width: 100%;
  height: 92%;
  justify-content: space-around;
}

.filial {
  width: 60%;
  min-width: 500px;
  height: 60%;
  padding: 20px;
  overflow: auto;
  background-color: white;
  border-radius: 4px;
}

/* Estilo para a tabela */
table {
  width: 100%;
  border-collapse: collapse;
  background-color: white;
  border-radius: 4px;
  overflow: hidden;
}

th,
td {
  padding: 10px;
  text-align: center;
  border: 1px solid #ddd;
}

th {
  background-color: var(--azul-claro);
  color: white;
  font-weight: bold;
}

td a {
  color: var(--azul-claro);
  text-decoration: none;
  font-weight: bold;
}

td a:hover {
  text-decoration: underline;
}
</style>
