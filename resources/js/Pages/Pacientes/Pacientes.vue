<template>
  <Layout>
    <template v-slot:conteudo>
      <div id="opcoes-conteudo">
        <Link
          v-if="$page.props.inserir_paciente"
          id="botao_inserir_superior"
          href="/form/paciente"
          >Inserir</Link
        >
        <form @submit.prevent="form.post('/busca/pacientes')">
          <input v-model="form.pesquisa" type="text" placeholder="Search..." />
          <button type="submit">Busca</button>
        </form>
      </div>

      <div id="tabela">
        <table class="minimal-table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Telefone</th>
              <th>CPF</th>
              <th style="width: 20px">#</th>
              <th style="width: 20px">#</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="paciente in pacientes" :key="paciente.id">
              <td>{{ paciente.nome }}</td>
              <td>{{ paciente.email }}</td>
              <td>{{ paciente.telefone }}</td>
              <td>{{ paciente.cpf }}</td>
              <td>
                <Link
                  v-if="$page.props.autorizaMedico"
                  id="inserir"
                  :href="'/detalhes/paciente/' + paciente.identificacao"
                  >Inserir</Link
                >
              </td>
              <td>
                <Link
                  v-if="$page.props.editar_paciente"
                  id="inserir"
                  :href="'/editar/paciente/' + paciente.identificacao"
                  >Editar</Link
                >
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </template>
  </Layout>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { defineProps } from "vue";
import { useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";

onMounted(() => {
  document.title = "Pacientes";
});

const props = defineProps({
  pacientes: Array,
});

const form = useForm({
  pesquisa: "",
});
</script>

<style scoped>
@import "../../../../public/css/tabelas.css";
@import "../../../../public/css/botoes.css";

#tipo {
  background-color: rgb(255, 0, 0);
  color: white;
}

input {
  /* Busca */
  padding: 08px 29px 08px 29px;
  margin-right: 10px;
}
</style>
