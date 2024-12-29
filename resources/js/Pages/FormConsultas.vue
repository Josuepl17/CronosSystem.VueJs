<template lang="">

<Layout>
    <template v-slot:conteudo>
        <div class="fomulario-usuario">
            <form @submit.prevent="form.post('/create/consulta')">
                <div id="pessoais">

                    <div class="form-group">
                        <label for="Medico">Médico(s) Responsável(is)</label>
                        <select v-model="form.medico_id" id="medico">
                            <option v-for="medico in props.medicos" :key="medico.id" :value="medico.id">
                                {{ medico.nome }} ({{ medico.especialidade }})
                            </option>
                        </select>

                    </div> <!-- .form-group -->


                    <div class="form-group">
                        <label for="Paciente">Paciente(s)</label>
                        <select v-model="form.paciente_id" id="paciente">
                            <option v-for="paciente in props.pacientes" :key="paciente.id" :value="paciente.id">
                                {{ paciente.nome }}
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
    medicos: {
        type: Array,
        default: () => props.consulta?.nome_medico || []
    },
    pacientes: {
        type: Array,
        default: () => []
    },
    consulta: {
        type: Object,
        default: () => ({
            paciente_id: '',
            medico_id: '',
            date: '',
            hora: ''
        })
    }
});

const form = useForm({

    paciente_id: props.consulta?.paciente_id || '',
    medico_id: props.consulta?.medico_id || '',
    date: props.consulta?.date || '',
    hora: props.consulta?.hora || '',

});


</script>

<style scoped>
  @import "..\Components\css\formularios.css";
</style>
