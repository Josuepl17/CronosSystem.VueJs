<template>
    <Layout>
        <template v-slot:conteudo>
            <div id="opcoes-conteudo">
                <Link v-if="$page.props.inserir_gerente" id="botao_inserir_superior" href="/form/gerencia">Inserir</Link>
            </div>

            <div id="tabela">
                <table class="minimal-table">
                    <thead>
                        <tr>
                            <th>Gerente</th>
                            <th>Email</th>
                            <th>Contato</th>
                            <th>X</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(gerente) in gerentes" :key="gerente.id">
                            <td>{{ gerente.nome }}</td>
                            <td>{{ gerente.especialidade }}</td>
                            <td>{{ gerente.telefone }}</td>
                            <td>
                                <Link v-if="$page.props.editar_gerente" id="inserir" :href="'/edit/medico/' + gerente.identificacao">Editar</Link>
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
    document.title = 'Medicos';
});
const props = defineProps({
    gerentes: Array,
});
</script>

<style scoped>
@import "../Components/css/tabelas.css";
@import "..\Components\css\botoes.css";
</style>
