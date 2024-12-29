<template lang="">
    <Layout>
        <template v-slot:conteudo>
            <div class="fomulario-usuario">
                <form @submit.prevent="form.post('/create/consulta')">
                    <div id="pessoais">
    
                        <div class="form-group">
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
    
                        <div class="form-group">
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
    
                    <div id="endereco">
                        <div class="form-group">
                            <label for="date">Data</label>
                            <input v-model="form.date" type="date" id="date" placeholder="Data Consulta">
                        </div> <!-- .form-group -->
    
                        <div class="form-group">
                            <label for="time">Hora</label>
                            <input v-model="form.hora" type="time" id="time" placeholder="Hora Consulta">
                        </div> <!-- .form-group -->
    
                        <div class="fechar-salvar">
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
        hora: props.consulta?.hora || '',
    });
    
    // Define as variáveis para médicos e consulta
    const medicos = props.medicos;
    const consulta = props.consulta;
    const pacientes = props.pacientes;
    
    </script>
    
    <style scoped>
      @import "..\Components\css\formularios.css";
    </style>
    