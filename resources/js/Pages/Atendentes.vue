<template lang="">

<Layout>

    <template v-slot:conteudo>

        <div id="opcoes-conteudo" >

          <Link href="/form/atendentes">Inserir</Link>

            <form action="#" method="GET">
                <input type="text"  placeholder="Search..." />
                <button type="submit" >Busca</button>
            </form>

        </div>

        <div id="tabela">
  <table class="minimal-table">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>CPF</th>
        <th>X</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(atendente) in atendentes" :key="atendente.id">
          <td>{{ atendente.id }}</td>
          <td>{{ atendente.nome }}</td>
          <td>{{ atendente.email }}</td>
          <td>{{ atendente.cpf }}</td>
          <td><Link id="inserir" :href="'/edit/atendentes/' + atendente.id">Editar</Link></td>
      </tr>
    </tbody>
  </table>
</div>





    </template>
    
</Layout>

</template>

<script setup >
import { Link } from '@inertiajs/vue3';
import { defineProps } from 'vue';




const props = defineProps({
  atendentes: Array,
})


</script>


<style scoped>

@import "..\Components\css\tabelas.css";

</style>