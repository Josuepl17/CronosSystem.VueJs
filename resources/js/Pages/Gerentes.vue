<template>
    <Layout>
        <template v-slot:conteudo>
            <div id="opcoes-conteudo">
                <Link  id="botao_inserir_superior" href="/form/gerente">Inserir</Link>
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
                            <td>{{ gerente.email }}</td>
                            <td>{{ gerente.telefone }}</td>
                            <td>
                                <Link  id="inserir" :href="'/edit/gerente/' + gerente.id">Editar</Link>
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
@import "../../../public/css/tabelas.css";
@import "../../../public/css/botoes.css";

</style>
