<template lang="">

<Layout>
    <template v-slot:conteudo>

        <div class="fomulario-usuario">
                <form @submit.prevent="form.post('/create/paciente')" >


                    <div id="pessoais">
                        <div class="form-group">
                           <label for="nome">Nome Completo</label>
                            <input type="text" id="nome" v-model="form.nome" placeholder="Nome Completo"  >
                        </div>
                        <div class="form-group">
                          <label for="cpf">CPF/RG</label>
                          <input v-model="form.cpf" type="text" id="cpf" placeholder="CPF/RG">
                          <p style="color: red; font-size:13px; " v-if="errors.cpf" >{{ errors.cpf }}</p>
                                          </div>
                        <div class="form-group">
                          <label for="crp">CRP</label>
                          <input v-model="form.crp" type="text" id="crp" placeholder="CRP">
                          <p style="color: red; font-size:13px; " v-if="errors.crp" >{{ errors.crp }}</p>
                                          </div>
                        
                                          <div  class="form-group">
                                          <label for="especialidade">Especialidade</label>
                                          <select v-model="form.especialidade" name="especialidade" id="especialidade">
                        <option value="Pisicologo">Pisicologo</option>
                        <option value="Psiquiatra">Psiquiatra</option>
                        <option value="Neurologista">Neurologista</option>
                        <option value="Pedriatra">Pedriatra</option>
                                          </select>
                                        </div>
                        <div class="form-group">
                            <label for="telefone">Telefone</label>
                            <input v-model="form.telefone" type="text" id="telefone" placeholder="Telefone">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input v-model="form.email" type="email" id="email" placeholder="Email">
                            <p style="color: red; font-size:13px; " v-if="errors.email" >{{ errors.email }}</p>
                        </div>
                    </div>




                    <div id="endereco">
                        <div class="form-group">
                            <label for="endereco">Endereco</label>
                            <input v-model="form.endereco" type="text" id="Endereco" placeholder="Endereco">
                        </div>
                        <div class="form-group">
                            <label for="cidade">Cidade</label>
                            <input v-model="form.cidade" type="text" id="cidade" placeholder="Cidade">
                        </div>
                        <div class="form-group">
                            <label for="bairro">Bairro</label>
                            <input v-model="form.bairro" type="text" id="bairro" placeholder="Bairro">
                        </div>

                        <div class="fechar-salvar">
                        <button type="button" class="fechar">Fechar</button>
                        <button type="submit" class="salvar">Salvar</button>

                    </div>


                    </div>




          
            
                   

                </form>
            </div>

    </template>

</Layout>

</template>

<script setup >

import { defineProps } from 'vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
  nome: '',
  cpf: '',
  crp: '',
  especialidade: '',
  telefone: '',
  email: '',
  endereco: '',
  cidade: '',
  bairro: '',
})


const props = defineProps({
  errors: Array,
})

</script>


<style scoped>

@import "..\Components\css\formularios.css";
</style>