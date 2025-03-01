<template>
  <Layout>
    <template v-slot:conteudo>
      <div id="opcoes-conteudo">
        <Link
          v-if="$page.props.inserir_profissional"
          id="botao_inserir_superior"
          href="/form/medicos"
          >Inserir</Link
        >
      </div>

      <div id="tabela">
        <table class="minimal-table">
          <thead>
            <tr>
              <th>Medico</th>
              <th>Email</th>
              <th>Especialidade</th>
              <th>Contato</th>
              <th>X</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="medico in medicos" :key="medico.id">
              <td>{{ medico.nome }}</td>
              <td>{{ medico.email }}</td>
              <td>{{ medico.especialidade }}</td>
              <td>{{ medico.telefone }}</td>
              <td>
                <Link
                  v-if="$page.props.editar_profissional"
                  id="inserir"
                  :href="'/edit/medico/' + medico.identificacao"
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
import { onMounted } from "vue";

onMounted(() => {
  document.title = "Medicos";
});
const props = defineProps({
  medicos: Array,
});
</script>

<style scoped>
@import "../../../../public/css/tabelas.css";
@import "../../../../public/css/botoes.css";
</style>
