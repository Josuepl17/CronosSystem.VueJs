<template lang="">
  <Layout>
    <template v-slot:conteudo>
      <div id="opcoes-conteudo">
        <Link v-if="$page.props.inserir_atendente" id="botao_inserir_superior" href="/form/atendentes">Inserir</Link>
      </div>

      <div id="tabela">
        <table class="minimal-table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>CPF</th>
              <th>X</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(atendente) in atendentes" :key="atendente.id">
              <td>{{ atendente.nome }}</td>
              <td>{{ atendente.email }}</td>
              <td>{{ atendente.cpf }}</td>
              <td>
                <Link v-if="$page.props.editar_atendente" id="inserir" :href="'/edit/atendentes/' + atendente.identificacao">Editar</Link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </template>
  </Layout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import { onMounted } from 'vue';

onMounted(() => {
  document.title = 'Atendentes';
});

const props = defineProps({
  atendentes: Array,
});
</script>

<style scoped>
@import "..\Components\css\tabelas.css";
@import "..\Components\css\botoes.css";
</style>
