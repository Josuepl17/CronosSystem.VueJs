<template lang="">
    <Layout>
        <template v-slot:conteudo>
            <div class="fomulario-usuario"> <!-- .fomulario-usuario -->
                <form @submit.prevent="form.post('/create/consulta')">
                    <div id="pessoais"> <!-- #pessoais -->

                        <div class="form-group"> <!-- .form-group -->
                            <label for="Medico">Médico(s) Responsável(is)</label>
                            <select v-model="form.medico_id" id="medico">
                                <!-- Mostra todos os médicos disponíveis -->
                                <option v-for="medico in medicos" :key="medico.id" :value="medico.id">
                                    {{ medico.nome }} ({{ medico.especialidade }})
                                </option>

                                <!-- Se houver uma consulta, mostra o médico atual selecionado -->
                                <option v-if="consulta" :value="consulta.medico_id" selected>
                                    {{ consulta.nome_medico }}
                                </option>
                            </select>
                        </div> <!-- .form-group -->

                        <div class="form-group"> <!-- .form-group -->
                            <label for="Paciente">Paciente(s)</label>
                            <select v-model="form.paciente_id" id="paciente">
                                <!-- Mostra todos os pacientes disponíveis -->
                                <option v-for="paciente in pacientes" :key="paciente.id" :value="paciente.id">
                                    {{ paciente.nome }}
                                </option>

                                <!-- Se houver uma consulta, mostra o paciente atual selecionado -->
                                <option v-if="consulta" :value="consulta.paciente_id" selected>
                                    {{ consulta.nome_paciente }}
                                </option>
                            </select>
                        </div> <!-- .form-group -->

                    </div> <!-- #pessoais -->

                    <div id="endereco"> <!-- #endereco -->
                        <div class="form-group"> <!-- .form-group -->
                            <label for="date">Data</label>
                            <input v-model="form.date" type="date" id="date" placeholder="Data Consulta">
                        </div> <!-- .form-group -->

                        <div class="form-group"> <!-- .form-group -->


                            <label for="time">Hora Inicial</label>
                            <input v-model="form.horainicial" type="time" id="time" placeholder="Hora Consulta" >

                            <label for="time">Hora Final</label>
                            <input v-model="form.horafinal" type="time" id="time" placeholder="Hora Consulta" >

                        <!--
                        <select v-model="form.hora" id="horario">
        
                                <option v-for="horario in horarios" :key="horario" :value="horario">
                                    {{ horario }}
                                </option>
                                 </select>
                        -->


                           
                        </div> <!-- .form-group -->

                        <div class="fechar-salvar"> <!-- .fechar-salvar -->
                            <button type="button" class="fechar">Fechar</button>
                            <button type="submit" class="salvar">Salvar</button>
                        </div> <!-- .fechar-salvar -->
                    </div> <!-- #endereco -->
                </form>
            </div> <!-- .fomulario-usuario -->
            <p v-if="props.errors.hora" style="color: red;">
                {{ props.errors.hora }}
            </p>
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
    pacientes: Array,
    consulta: Object,
});

const form = useForm({
    id: props.consulta?.id || '',
    paciente_id: props.consulta?.paciente_id || '',
    medico_id: props.consulta?.medico_id || '',
    date: props.consulta?.date || '',
    horainicial: props.consulta?.hora || '',
    horafinal: ""
});

// Define as variáveis para médicos e consulta
const medicos = props.medicos;
const consulta = props.consulta;
const pacientes = props.pacientes;

</script>

<style scoped>
    @import "..\Components\css\formularios.css";
</style>
