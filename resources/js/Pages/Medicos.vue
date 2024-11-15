<template lang="">
    <Layout>
        <template v-slot:conteudo>
            <div id="opcoes-conteudo">
                <Link href="/form/medicos">Inserir</Link>

                <form action="#" method="GET">
                    <input type="text" placeholder="Search..." />
                    <button type="submit">Busca</button>
                </form>
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
                            
                        </tr>
                    </thead>
                    <tbody>
                            <tr v-for="(medico) in medicos" :key="medico.id">
                                <td>{{ medico.id }}</td>
                                <td>{{ medico.nome }}</td>
                                <td>{{ medico.email }}</td>
                                <td>{{ medico.especialidade }}</td>
                                <td>{{ medico.telefone }}</td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </template>
    </Layout>
</template>


<script setup >

const props = defineProps ({
    medicos: Array,
})


</script>


<style scoped>
@import "..\Components\css\tabelas.css";
</style>