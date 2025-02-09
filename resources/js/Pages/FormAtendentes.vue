<template lang="">
    <Layout>
        <template v-slot:conteudo>
            <div class="fomulario-usuario">
                <form @submit.prevent="form.post('/create/atendentes')">
                    <div id="pessoais">
                        <div class="form-group">
                            <label for="nome">Nome Completo</label>
                            <input type="text" id="nome" v-model="form.nome" placeholder="Nome Completo" required >
                        </div>
                        <div class="form-group">
                            <label for="cpf">CPF/RG</label>
                            <input v-model="form.cpf" type="text" id="cpf" placeholder="CPF/RG" required >
                            <p style="color: red; font-size: 13px;" v-if="errors.cpf">{{ errors.cpf }}</p>
                        </div>
                        <div class="form-group">
                            <label for="telefone">Telefone</label>
                            <input v-model="form.telefone" type="text" id="telefone" placeholder="Telefone" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input v-model="form.email" type="email" id="email" placeholder="Email" required >
                            <p style="color: red; font-size: 13px;" v-if="errors.email">{{ errors.email }}</p>
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
                            <input v-model="form.bairro" type="text" id="bairro" placeholder="Bairro" required>
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

                        <div class="fechar-salvar">
                            <Link href="/atendentes" class="fechar">Fechar</Link>
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
  document.title = "Inserir Atendente";
});

const props = defineProps({
  errors: Object,
  atendente: Object,
  permissoes: Array,
  idPermissaoSelect: Array,
});

const form = useForm({
  id: props.atendente?.id || "",
  nome: props.atendente?.nome || "",
  cpf: props.atendente?.cpf || "",
  telefone: props.atendente?.telefone || "",
  email: props.atendente?.email || "",
  endereco: props.atendente?.endereco || "",
  cidade: props.atendente?.cidade || "",
  bairro: props.atendente?.bairro || "",
  senha: "1234",
  permissoes: props.idPermissaoSelect || [],
  primeiro_acesso: "" || false,
});
</script>

<style scoped>
@import "../../../public/css/formularios.css";
</style>
