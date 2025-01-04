<template>
    <Layout>
        <template v-slot:conteudo>
            <div id="opcoes-conteudo">
                <Link id="botao_inserir_superior" href="/form/consultas">Inserir</Link>
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
                            <th>Motivo Status</th>
                            <th style="width: 40px;">X</th>
                            <th style="width: 40px;">X</th>
                            <th style="width: 20px;">X</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(consulta) in consultas" :key="consulta.id">
                            <td>{{ consulta.id }}</td>
                            <td>{{ consulta.nome_paciente }}</td>
                            <td>{{ consulta.nome_medico }}</td>
                            <td
                                style="color: white;"
                                :class="{
                                    'status-agendado': consulta.status === 'Agendado',
                                    'status-cancelado': consulta.status === 'Cancelado',
                                    'status-concluido': consulta.status === 'Concluido'
                                }"
                            >
                                {{ consulta.status }}
                            </td>
                            <td>{{ consulta.date }}</td>
                            <td>{{ consulta.hora }}</td>
                            <td>{{ consulta.motivo_status }}</td>
                            <td>
                                <Link class="status-concluido" :href="'/concluir/consulta/' + consulta.identificacao">Concluir</Link>
                            </td>
                            <td>
                                <a class="status-cancelado" href="#" @click.prevent="abrirFormulario(consulta.identificacao)"  >Cancelar</a>
                            </td>
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
            <a href="#" @click.prevent="fecharModal">Fechar</a>
            <button type="submit">Salvar</button>

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


.status-agendado {
    background-color: #1a0099d2;
    font-weight: 700;
}

.status-cancelado {
    background-color: #ff0019d5;
    font-weight: 700;

    color: white;
    border-radius: 2px;
}

.status-concluido {
    background-color: #009c08d9;
    font-weight: 700;

    color: white;
    border-radius: 2px;
}

input { /* Busca */
padding: 08px 29px 08px 29px;
margin-right: 10px;
}
</style>
