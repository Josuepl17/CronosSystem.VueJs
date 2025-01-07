<template>
    <Layout>
        <template v-slot:conteudo>
            <div id="opcoes-conteudo">
                <Link id="botao_inserir_superior" href="/form/agendas">Inserir</Link>
            </div>

            <div id="tabela">
                <table class="minimal-table">
                    <thead>
                        <tr style="position: sticky; top: 0; background-color: white;">
                            <th>#</th>
                            <th>Nome Paciente</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(consulta) in consultas" :key="consulta.id">
                            <td>{{ consulta.id }}</td>
                            <td>
                                <Link class="delete" :href="'/delete/consulta/' + consulta.identificacao">X</Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>




            <div v-if="showForm" class="modal-sobreposto">
        <div class="modal-content">
          <h1>Motivo Cancelamento</h1>
          <br />
          <form @submit.prevent="formcancel.post('/cancelar/consulta')">
            <div class="form-group">
              <input v-model="formcancel.motivo" type="text" id="motivo" placeholder="Motivo Cancelamento"  />
            </div> <!-- /.form-group -->
        <br>
            <button id="salvar" type="submit">Salvar</button>
            <button id="fechar" type="button"  @click.prevent="fecharModal">Fechar</button>
            

          </form>
        </div> <!-- /.modal-content -->
      </div> <!-- /.modal-sobreposto -->







        </template>
    </Layout>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import { onMounted } from 'vue';
import { ref } from "vue";


const formcancel = useForm({
    identificacao: '',
    motivo: '',
});    



const showForm = ref(false);

const abrirFormulario = (identificacao) => {
    showForm.value = true;
   formcancel.identificacao = identificacao;

};

const fecharModal = () => {
    showForm.value = false;
};




onMounted(() => {
    document.title = 'Consultas';
});

const props = defineProps({
    consultas: Array,
});
</script>

<style scoped>
@import "../Components/css/tabelas.css";
@import "../Components/css/modal.css";
@import "..\Components\css\botoes.css"; 




input { /* Busca */
padding: 08px 29px 08px 29px;
margin-right: 10px;
}
</style>
