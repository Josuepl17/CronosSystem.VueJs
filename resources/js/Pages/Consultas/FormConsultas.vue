<template lang="">
    <Layout>
        <template v-slot:conteudo>
            <div class="fomulario-usuario">
                <form @submit.prevent="form.post('/create/consulta')">
                    <div id="pessoais">
                        <div class="form-group">
                            <label for="Medico">Médico(s) Responsável(is)</label>
                            <select v-model="form.medico_id" id="medico" required>
                                <option v-for="medico in props.medicos" :key="medico.id" :value="medico.id">
                                    {{ medico.nome }} ({{ medico.especialidade }})
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Paciente">Paciente(s)</label>
                            <select v-model="form.paciente_id" id="paciente" required>
                                <option v-for="paciente in pacientesFiltrados" :key="paciente.id" :value="paciente.id">
                                    {{ paciente.nome }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div id="endereco">
                        <div class="form-group">
                            <label for="date">Data</label>
                            <input v-model="form.date" type="date" id="date" required>
                        </div>

                        <div class="form-group">
                            <label for="time">Hora Inicial</label>
                            <input v-model="form.horainicial" type="time" id="time" required>

                            <label for="time">Hora Final</label>
                            <input v-model="form.horafinal" type="time" id="time" required>

                                        <p v-if="props.errors.hora" style="color: red;">
                {{ props.errors.hora }}
            </p>

                            
                        </div>

                        <div class="fechar-salvar">
                            <Link href="/consultas" class="fechar">Fechar</Link>
                            <button type="submit" class="salvar">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>

        </template>
    </Layout>
</template>

<script setup>
import { defineProps, ref, computed, watch } from "vue";
import { useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";

onMounted(() => {
  document.title = "Inserir Consultas";
});

const props = defineProps({
  errors: Object,
  medicos: Array,
  pacientes: Array,
  consulta: Object,
  relacoes: Array, // Tabela intermediária que relaciona médicos e pacientes
});

const form = useForm({
  id: props.consulta?.id || "",
  paciente_id: props.consulta?.paciente_id || "",
  medico_id: props.consulta?.medico_id || "",
  date: props.consulta?.date || "",
  horainicial: props.consulta?.horainicial || "",
  horafinal: "",
});

// Variáveis reativas
const medicoSelecionado = ref(form.medico_id);

// Sincroniza `medicoSelecionado` com `form.medico_id`
watch(
  () => form.medico_id,
  (novoValor) => {
    medicoSelecionado.value = novoValor;
    form.paciente_id = ""; // Reseta a seleção do paciente ao trocar de médico
  }
);

// Computed para filtrar pacientes vinculados ao médico selecionado
const pacientesFiltrados = computed(() => {
  if (!medicoSelecionado.value) return props.pacientes;

  // Filtra os pacientes que têm uma relação com o médico selecionado
  const pacientesRelacionados = props.relacoes
    .filter((relacao) => relacao.medico_id === medicoSelecionado.value)
    .map((relacao) => relacao.paciente_id);

  return props.pacientes.filter((paciente) =>
    pacientesRelacionados.includes(paciente.id)
  );
});
</script>

<style scoped>
@import "../../../../public/css/formularios.css";
</style>

