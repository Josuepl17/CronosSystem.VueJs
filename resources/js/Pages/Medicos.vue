<template>
    <Layout>
        <template v-slot:conteudo>
            <div id="opcoes-conteudo">
                <Link href="/form/medicos">Inserir</Link>
            </div>

            <div id="tabela">
                <table class="minimal-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Medico</th>
                            <th>Email</th>
                            <th>Especialidade</th>
                            <th>Contato</th>
                            <th>X</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(medico) in medicos" :key="medico.id">
                            <td>{{ medico.id }}</td>
                            <td>{{ medico.nome }}</td>
                            <td>{{ medico.email }}</td>
                            <td>{{ medico.especialidade }}</td>
                            <td>{{ medico.telefone }}</td>
                            <td>
                                <Link id="inserir" :href="'/edit/medico/' + medico.id">Editar</Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </template>
    </Layout>
</template>

<script setup>
const props = defineProps({
    medicos: Array,
});
</script>

<style scoped>
@import "../Components/css/tabelas.css";
</style>
