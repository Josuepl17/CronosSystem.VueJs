<template lang="">



<Layout>

    <template v-slot:conteudo>

        <div id="opcoes-conteudo" >

          <Link  href="/form/paciente">Inserir</Link>

            <form @submit.prevent="form.post('/busca/atendentes')">
                <input v-model="form.pesquisa" type="text"   placeholder="Search..." />
                <button type="submit" >Busca</button>
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
       <!-- <th>Medico</th>-->
        <th>#</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(paciente) in pacientes" :key="paciente.id">
          <td>{{ paciente.nome }}</td>
          <td>{{ paciente.email }}</td>
          <td>{{ paciente.telefone }}</td>
          <td>{{ paciente.cpf }}</td>
          <!--<td>{{ paciente.Medico }}</td>-->
          <td><Link v-if="$page.props.autorizaMedico"  id="inserir" :href="'/detalhes/paciente/' + paciente.identificacao">Inserir</Link></td>
        
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
import { useForm } from '@inertiajs/vue3';



const props = defineProps({
  pacientes: Array,
})

const form = useForm({
pesquisa: "", 

})






</script>


<style scoped>




@import "..\Components\css\tabelas.css";

#tipo{
  background-color: rgb(255, 0, 0);
   color: white;
}

</style>