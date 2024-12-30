<template lang="">

<Layout>
    <template v-slot:conteudo>

        <div id="opcoes-conteudo" >

<Link href="/form/consultas">Inserir</Link>



</div>

<div id="tabela">
<table class="minimal-table">
<thead>
<tr>
<th>#</th>
<th>Nome Paciente</th>
<th>Nome Medico</th>
<th>Status</th>
<th>Data Consulta</th>
<th>Hora Consulta</th>
<th>X</th>
</tr>
</thead>
<tbody>
<tr v-for="(consulta) in consultas" :key="consulta.id">
<td>{{ consulta.id }}</td>
<td>{{ consulta.nome_paciente }}</td>
<td>{{ consulta.nome_medico }}</td>

<td style="color: white;" :class="{
    'status-agendado': consulta.status === 'agendado',
    'status-cancelado': consulta.status === 'cancelado',
    'status-concluido': consulta.status === 'concluido'
}">

    {{ consulta.status }}
</td>
<td>{{ consulta.date }}</td>
<td>{{ consulta.hora }}</td>
<td><Link id="inserir" :href="'/edit/consulta/' + consulta.id">Delete</Link></td>
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
    consultas: Array,
})


</script>


<style scoped>


@import "..\Components\css\tabelas.css";

.status-agendado {
    background-color: #8db000; 
   font-weight: 700;
    
}

.status-cancelado {
    background-color: #721c25; 
    font-weight: 700;

}

.status-concluido {
    background-color: #009c08;
    font-weight: 700;

}
  



</style>