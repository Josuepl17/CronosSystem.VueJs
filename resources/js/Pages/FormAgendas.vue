<template lang="">
    <Layout>
        <template v-slot:conteudo>
            <div class="fomulario-usuario"> <!-- .fomulario-usuario -->
                <form @submit.prevent="form.post('/create/agenda')">
                    <div id="pessoais"> <!-- #pessoais -->

                        <div class="form-group"> <!-- .form-group -->
                            <label for="Medico">Médico(s) Responsável(is)</label>
                            <select v-model="form.medico_id" id="medico">
                                <option v-for="medico in medicos" :key="medico.id" :value="medico.id">
                                    {{ medico.nome }} ({{ medico.especialidade }})
                                </option>
                            </select>
                        </div> <!-- .form-group -->

                        <div class="form-group"> <!-- .form-group -->
                            <label for="Paciente">Dias da Semana</label>
                            <select v-model="form.diasdasemana" id="diasdasemana" multiple>
                                <option v-for="dia in diasdasemana" :key="dia.id" :value="dia.id">
                                    {{ dia.nome }}
                                </option>
                            </select>
                        </div> <!-- .form-group -->

                    </div> <!-- #pessoais -->

                    <div id="endereco"> <!-- #endereco -->
                        <div class="form-group"> <!-- .form-group -->
                            <label for="time">Começa as</label>
                            <input type="time" id="time" v-model="form.timeinicial" placeholder="Horas">
                        </div> <!-- .form-group -->

                        <div class="form-group"> <!-- .form-group -->
                            <label for="time">Termina as:</label>
                            <input type="time" id="time" v-model="form.timefinal" placeholder="Horas">
                        </div> <!-- .form-group -->

                        <div class="form-group"> <!-- .form-group -->
                            <label for="time">Tempo de Consulta</label>
                            <input type="time" id="time" v-model="form.tempodeconsulta" placeholder="Horas">
                        </div> <!-- .form-group -->

                      <div class="form-group"> <!-- .form-group -->
                            <label for="time">Horario de almoço</label>
                            <input type="time" id="time" v-model="form.horarioDeParadaInicio" placeholder="Horas"> as
                            <input type="time" id="time" v-model="form.horarioDeParadaFim" placeholder="Horas">
                        </div> <!-- .form-group --> 

                        <div class="fechar-salvar"> <!-- .fechar-salvar -->
                            <button type="button" class="fechar">Fechar</button>
                            <button type="submit" class="salvar">Salvar</button>
                        </div> <!-- .fechar-salvar -->
                    </div> <!-- #endereco -->
                </form>
            </div> <!-- .fomulario-usuario -->
        </template>
    </Layout>
</template>

<script setup>
import { defineProps } from "vue";
import { useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";

onMounted(() => {
  document.title = " Inserir Consultas";
});

const props = defineProps({
  errors: Array,
  medicos: Array,
  diasdasemana: Array,

});

const form = useForm({
     medico_id: "",
    diasdasemana: [],
    timeinicial: "",
    timefinal: "",
    tempodeconsulta: "",
    horarioDeParadaInicio: "",
    horarioDeParadaFim: "",

});



</script>

<style scoped>
@import "..\Components\css\formularios.css";
</style>
