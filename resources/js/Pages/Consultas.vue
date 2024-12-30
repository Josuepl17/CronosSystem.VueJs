<template lang="">

<Layout>
    <template v-slot:conteudo>

        <div id="opcoes-conteudo" >

<Link href="/form/consultas">Inserir</Link>



</div>

<div id="tabela">
<table class="minimal-table">
<thead>
<tr style="position: sticky; top: 0; background-color: white;">
<th>#</th>
<th>Nome Paciente</th>
<th>Nome Medico</th>
<th>Status</th>
<th>Data Consulta</th>
<th>Hora Consulta</th>
<th>X</th>
<th>X</th>
<th>X</th>
</tr>
</thead>
<tbody>
<tr v-for="(consulta) in consultas" :key="consulta.id">
<td>{{ consulta.id }}</td>
<td>{{ consulta.nome_paciente }}</td>
<td>{{ consulta.nome_medico }}</td>

<td style="color: white;" :class="{
    'status-agendado': consulta.status === 'Agendado',
    'status-cancelado': consulta.status === 'Cancelado',
    'status-concluido': consulta.status === 'Concluido'
}">

    {{ consulta.status }}
</td>
<td>{{ consulta.date }}</td>
<td>{{ consulta.hora }}</td>

<td><Link class="status-concluido" :href="'/concluir/consulta/' + consulta.identificacao">Concluir</Link></td>
<td><Link class="status-cancelado" :href="'/cancelar/consulta/' + consulta.identificacao">Cancelar</Link></td>
<td><Link id="inserir" :href="'/delete/consulta/' + consulta.identificacao">X</Link></td>
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
    background-color: #1a0099d2; 
   font-weight: 700;
    
}

.status-cancelado {
    background-color: #ff0019d5; 
    font-weight: 700;
    padding: 05px;
    color: white;

}

.status-concluido {
    background-color: #009c08d9;
    font-weight: 700;
    padding: 05px;
    color: white;
}
  



</style>