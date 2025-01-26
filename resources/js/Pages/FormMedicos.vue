<template lang="">

<Layout>
    <template v-slot:conteudo>

        <div class="fomulario-usuario"><!-- .fomulario-usuario -->
            <form @submit.prevent="form.post('/create/medico')"><!-- form -->

                <div id="pessoais"><!-- #pessoais -->
                    <div class="form-group"><!-- .form-group -->
                        <label for="nome">Nome Completo</label>
                        <input type="text" id="nome" v-model="form.nome" placeholder="Nome Completo">
                    </div><!-- .form-group -->
                    <div class="form-group"><!-- .form-group -->
                        <label for="cpf">CPF/RG</label>
                        <input v-model="form.cpf" type="text" id="cpf" placeholder="CPF/RG">
                        <p style="color: red; font-size:13px;" v-if="errors.cpf">{{ errors.cpf }}</p>
                    </div><!-- .form-group -->
                    <div class="form-group"><!-- .form-group -->
                        <label for="crp">CRP/CRM</label>
                        <input v-model="form.crp" type="text" id="crp" placeholder="CRP/CRM:">
                        <p style="color: red; font-size:13px;" v-if="errors.crp">{{ errors.crp }}</p>
                    </div><!-- .form-group -->
                    <div class="form-group"><!-- .form-group -->
                        <label for="especialidade">Especialidade</label>
                        <select v-model="form.especialidade" name="especialidade" id="especialidade">
                            <option value="Pisicologo">Psicólogo</option>
                            <option value="Psiquiatra">Psiquiatria</option>
                            <option value="Neurologista">Neurologista</option>
                            <option value="Pedriatra">Pedriatra</option>
                        </select>
                    </div><!-- .form-group -->
                    <div class="form-group"><!-- .form-group -->
                        <label for="telefone">Telefone</label>
                        <input v-model="form.telefone" type="text" id="telefone" placeholder="Telefone">
                    </div><!-- .form-group -->
                    <div class="form-group"><!-- .form-group -->
                        <label for="email">Email</label>
                        <input v-model="form.email" type="email" id="email" placeholder="Email">
                        <p style="color: red; font-size:13px;" v-if="errors.email">{{ errors.email }}</p>
                    </div><!-- .form-group -->
                </div><!-- #pessoais -->

                <div id="endereco"><!-- #endereco -->
                    
                    <div class="form-group"><!-- .form-group -->
                        <div class="form-group"><!-- .form-group -->
                        <label for="cidade">Cidade</label>
                        <input v-model="form.cidade" type="text" id="cidade" placeholder="Cidade">
                    </div><!-- .form-group -->

                        <label for="endereco">Endereco</label>
                        <input v-model="form.endereco" type="text" id="Endereco" placeholder="Endereco">
                    </div><!-- .form-group -->

                    <div class="form-group"><!-- .form-group -->
                        <label for="bairro">Bairro</label>
                        <input v-model="form.bairro" type="text" id="bairro" placeholder="Bairro">
                    </div>

                  <div v-if="$page.props.adm" class="form-group">
                      <label for="Medico">Permissões Do Usuario</label>
                      <div style="height: 150px; border: 1px solid #ccc; overflow-y: auto;">
                          <div v-for="permissao in props.permissoes" 
                               :key="permissao.id" 
                               @click="form.permissoes.includes(permissao.id) ? form.permissoes = form.permissoes.filter(id => id !== permissao.id) : form.permissoes.push(permissao.id)"
                               :style="{ padding: '5px 10px', cursor: 'pointer', backgroundColor: form.permissoes.includes(permissao.id) ? '#e0e0e0' : 'white' }">
                              {{ permissao.descricao }}
                          </div>
                      </div>
                  </div>

                  <div class="form-group"><!-- .form-group -->
                        <label for="bairro">Primeiro Acesso</label>
                        <input v-model="form.primeiro_acesso" type="checkbox" id="bairro" placeholder="Primeiro Acesso">
                    </div>

                    <div class="fechar-salvar"><!-- .fechar-salvar -->
                        <button type="button" class="fechar">Fechar</button>
                        <button type="submit" class="salvar">Salvar</button>
                    </div><!-- .fechar-salvar -->

                </div><!-- #endereco -->

            </form><!-- form -->
        </div><!-- .fomulario-usuario -->

    </template>
</Layout>

</template>

<script setup>
import { defineProps } from "vue";
import { useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";

onMounted(() => {
  document.title = "Inserir Medicos";
});

const props = defineProps({
  errors: Array,
  medico: Array,
  permissoes: Array,
  idPermissaoSelect: Array,
});

const form = useForm({
  id: props.medico?.id || "",
  nome: props.medico?.nome || "",
  cpf: props.medico?.cpf || "",
  crp: props.medico?.crp || "",
  especialidade: props.medico?.especialidade || "",
  telefone: props.medico?.telefone || "",
  email: props.medico?.email || "",
  endereco: props.medico?.endereco || "",
  cidade: props.medico?.cidade || "",
  bairro: props.medico?.bairro || "",
  permissoes: props.idPermissaoSelect || [],
  primeiro_acesso: "" || false,
});
</script>

<style scoped>
@import "..\Components\css\formularios.css";
</style>
