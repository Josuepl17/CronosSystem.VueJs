<template lang="">
  <Layout>
    <template v-slot:conteudo>
      <div class="fomulario-usuario">
        <form @submit.prevent="form.post('/create/paciente')">
          <div id="pessoais">
            <div class="form-group">
              <label for="nome">Nome Completo</label>
              <input type="text" id="nome" v-model="form.nome" placeholder="Nome Completo" required >
            </div>

            <div class="form-group">
              <label for="DataNascimento">Data Nascimento</label>
              <input type="date" id="DataNascimento" v-model="form.DataNascimento" placeholder="Data Nascimento" required >
            </div>

            <div class="form-group">
              <label for="Medico">Médico(s) Responsável(is)</label>
              <select v-model="form.medico" id="medico" multiple name="medico" >

                <option v-for="medico in props.medicos" :key="medico.id" :value="medico.id">
                  {{ medico.nome }} ({{ medico.especialidade }})
                </option>



              </select>
            </div>



            


            <div class="form-group">
              <label for="cpf">CPF</label>
              <input v-model="form.cpf" type="text" id="cpf" placeholder="CPF" required >
              <p style="color: red; font-size:13px;" v-if="errors.cpf">{{ errors.cpf }}</p>
            </div>

            <div class="form-group">
              <label for="email">Email</label>
              <input v-model="form.email" type="email" id="email" placeholder="Email" required >
              <p style="color: red; font-size:13px;" v-if="errors.email">{{ errors.email }}</p>
            </div>

            <div class="form-group">
              <label for="telefone">Telefone</label>
              <input v-model="form.telefone" type="number" id="telefone" placeholder="Telefone:" required>
  
            </div>
          </div>

          <div id="endereco">
            <div class="form-group">
              <label for="cidade">Cidade</label>
              <input v-model="form.cidade" type="text" id="cidade" placeholder="Cidade" required>
            </div>


            <div class="form-group">
              <label for="endereco">Endereço</label>
              <input v-model="form.endereco" type="text" id="endereco" placeholder="Endereço" required>
            </div>

            <div class="form-group">
              <label for="bairro">Bairro</label>
              <input v-model="form.bairro" type="text" id="bairro" placeholder="Bairro" required >
            </div>


            <div class="fechar-salvar">
              <Link href="/pacientes" class="fechar">Fechar</Link>
              <button type="submit" class="salvar">Salvar</button>
            </div>
          </div>
        </form>
      </div>
    </template>
  </Layout>
</template>

<script setup>
import { defineProps } from "vue";
import { useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";

onMounted(() => {
  document.title = "Inserir Pacientes";
});

const props = defineProps({
  errors: Array,
  medicos: Array,
  paciente: {
    type: Object,
    default: () => ({})
  },
  medicosSelect: Array,
});

const form = useForm({
  id: props.paciente.id || "",
  nome: props.paciente.nome || "",
  DataNascimento: props.paciente.DataNascimento || "",
  medico: props.medicosSelect || [],
  cpf: props.paciente.cpf || "",
  email: props.paciente.email || "",
  cidade: props.paciente.cidade || "",
  bairro: props.paciente.bairro || "",
  telefone: props.paciente.telefone || "",
  endereco: props.paciente.endereco || "",
});




function formatCPF() {
  form.cpf.value = cpf.value
    .replace(/\D/g, '') // Remove tudo que não é número
    .replace(/(\d{3})(\d)/, '$1.$2') // Adiciona o primeiro ponto
    .replace(/(\d{3})(\d)/, '$1.$2') // Adiciona o segundo ponto
    .replace(/(\d{3})(\d{1,2})$/, '$1-$2') // Adiciona o traço
    .slice(0, 14); // Limita o tamanho ao formato do CPF
}




</script>

<style scoped>
@import "..\Components\css\formularios.css";
</style>
