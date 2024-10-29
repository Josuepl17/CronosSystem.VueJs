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
                            <th>Especialidade</th>
                            <th>Contato</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td> <!-- Ajuste conforme necessário -->
                           
                        </tr>
                    </tbody>
                </table>
            </div>
        </template>
    </Layout>
</template>


<script setup >

</script>


<style scoped>
@import "..\Components\css\tabelas.css";
</style>