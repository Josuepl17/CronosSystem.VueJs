<template lang="">
    <Layout>
        <template v-slot:conteudo>
            <div class="fomulario-usuario">
                <form @submit.prevent="form.post('/create/gerente')">
                    <div id="pessoais">
                        <div class="form-group">
                            <label for="nome">Nome Completo</label>
                            <input type="text" id="nome" v-model="form.nome" placeholder="Nome Completo" required>
                        </div>
                        <div class="form-group">
                            <label for="cpf">CPF/RG</label>
                            <input v-model="form.cpf" type="text" id="cpf" placeholder="CPF/RG" required>
                            <p style="color: red; font-size: 13px;" v-if="errors.cpf">{{ errors.cpf }}</p>
                        </div>
                        <div class="form-group">
                            <label for="telefone">Telefone</label>
                            <input v-model="form.telefone" type="text" id="telefone" placeholder="Telefone" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input v-model="form.email" type="email" id="email" placeholder="Email" required>
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




                  <div class="form-group"><!-- .form-group -->
                        <label for="bairro">Primeiro Acesso</label>
                        <input v-model="form.primeiro_acesso" type="checkbox" id="bairro" placeholder="Primeiro Acesso">
                    </div>

                        <div class="fechar-salvar">
                            <Link href="/gerentes" class="fechar">Fechar</Link>
                            <button type="submit" class="salvar">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </template>
    </Layout>
</template>

<script setup>
import { defineProps } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { onMounted } from 'vue';

onMounted(() => {
    document.title = 'Inserir Gerente';
});

const props = defineProps({
    errors: Array,
    gerente: Object,
});

const form = useForm({
    id: props.gerente?.id || "",
    nome: props.gerente?.nome || "",
    cpf: props.gerente?.cpf || "",
    telefone: props.gerente?.telefone || "",
    email: props.gerente?.email || "",
    endereco: props.gerente?.endereco || "",
    cidade: props.gerente?.cidade || "",
    bairro: props.gerente?.bairro || "",
    senha: "1234",
    primeiro_acesso: "" || false,
});
</script>

<style scoped>
@import "..\Components\css\formularios.css";
</style>
