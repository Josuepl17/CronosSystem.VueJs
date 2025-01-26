<template lang="">
    <div class="container" id="container">
        <div class="form-container sign-in">
            <form @submit.prevent="submitForm">
                <input type="text" id="name" placeholder="Email Administrador:" v-model="form.email">
                <input type="password" id="password" placeholder="Senha:" v-model="form.password">
                <input type="text" id="razao_social" placeholder="Razão Social:" v-model="form.razao_social">
                <input type="text" id="cnpj" placeholder="CNPJ/CPF:" v-model="formattedCNPJ" @input="formatCNPJ">
                <input type="number" id="ie" placeholder="Inscrição Estadual:" v-model="form.ie">
                <input type="number" id="im" placeholder="Inscrição Municipal:" v-model="form.im">
                <input type="text" id="telefone" placeholder="Telefone Empresa:" v-model="formattedTelefone" @input="formatTelefone">
                <input type="text" id="cidade" placeholder="Cidade Empresa:" v-model="form.cidade">
                <input type="text" id="endereco" placeholder="Endereco Empresa:" v-model="form.endereco">
                <input type="text" id="bairro" placeholder="Bairro Empresa:" v-model="form.bairro">

                <Link href="/form/login">Voltar</Link>
                <button>Cadastrar</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-right">
                    <h1>Ola, Meu Amigo(a)</h1>
                    <p>Faça O Seu Cadastro para Iniciarmos.</p>
                </div>
            </div>
        </div>
    </div>

    <p style="color: red; font-size:13px;" v-if="errors.razao_social">{{ errors.razao_social }}</p>
    <p style="color: red; font-size:13px;" v-if="errors.cnpj">{{ errors.cnpj }}</p>
    <p style="color: red; font-size:13px;" v-if="errors.ie">{{ errors.ie }}</p>
    <p style="color: red; font-size:13px;" v-if="errors.im">{{ errors.im }}</p>
    <p style="color: red; font-size:13px;" v-if="errors.telefone">{{ errors.telefone }}</p>
    <p style="color: red; font-size:13px;" v-if="errors.cidade">{{ errors.cidade }}</p>
    <p style="color: red; font-size:13px;" v-if="errors.endereco">{{ errors.endereco }}</p>
    <p style="color: red; font-size:13px;" v-if="errors.bairro">{{ errors.bairro }}</p>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import { defineProps } from 'vue';

const props = defineProps({
    errors: Array,
})

onMounted(() => {
    document.title = 'Cadastro de Empresas';
});

const form = useForm({
    name: '',
    email: '',
    password: '',
    razao_social: '',
    cnpj: '',
    ie: '',
    im: '',
    bairro: '',
    cidade: '',
    endereco: '',
    telefone: '',
    email: '',
    password: '',
});

const formattedCNPJ = ref('');
const formattedTelefone = ref('');

const formatCNPJ = (event) => {
    let value = event.target.value.replace(/\D/g, '');
    
    if (value.length <= 11) {
        if (value.length > 11) {
            value = value.slice(0, 11);
        }
        value = value.replace(/^(\d{3})(\d)/, '$1.$2');
        value = value.replace(/^(\d{3})\.(\d{3})(\d)/, '$1.$2.$3');
        value = value.replace(/\.(\d{3})(\d)/, '.$1-$2');
    } else {
        if (value.length > 14) {
            value = value.slice(0, 14);
        }
        value = value.replace(/^(\d{2})(\d)/, '$1.$2');
        value = value.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
        value = value.replace(/\.(\d{3})(\d)/, '.$1/$2');
        value = value.replace(/(\d{4})(\d)/, '$1-$2');
    }
    
    event.target.value = value;
    formattedCNPJ.value = value;
    form.cnpj = event.target.value.replace(/\D/g, '');
};

const formatTelefone = (event) => {
    let value = event.target.value.replace(/\D/g, '');
    value = value.replace(/^(\d{2})(\d)/g, '($1) $2');
    value = value.replace(/(\d)(\d{4})$/, '$1-$2');
    event.target.value = value;
    formattedTelefone.value = value;
    form.telefone = event.target.value.replace(/\D/g, '');
};

const submitForm = () => {
    form.post('/create/user/empresas');
};
</script>

<style scoped>
:root {
    --azul-escuro: #012841;
    --azul-claro: #014552;
    --cinza-escuro: #212529;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Montserrat', sans-serif;
}

body {
    background-color: #c9d6ff;
    background: linear-gradient(to right, #e2e2e2, #c9d6ff);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    min-height: 100vh;
    padding: 20px;
}

.container {
    background-color: #fff;
    border-radius: 30px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
    position: relative;
    overflow: hidden;
    width: 100%;
    max-width: 768px;
    min-height: 650px;
    margin: 0 auto;
}

@media (max-width: 768px) {
    .container {
        min-height: auto;
        padding: 20px;
    }

    .toggle-container {
        display: none;
    }

    .form-container {
        position: relative !important;
        width: 100% !important;
        padding: 20px;
    }

    .sign-in {
        width: 100%;
    }

    .container form {
        padding: 0 20px;
    }

    .container input {
        font-size: 16px;
        padding: 12px 15px;
    }

    .container button {
        width: 100%;
        margin: 10px 0;
    }
}

.container p {
    font-size: 14px;
    line-height: 20px;
    letter-spacing: 0.3px;
    margin: 20px 0;
}

.container span {
    font-size: 12px;
}

.container a {
    color: #333;
    font-size: 13px;
    text-decoration: none;
    margin: 15px 0 10px;
    display: inline-block;
}

.container button {
    background-color: var(--azul-claro);
    color: #fff;
    font-size: 12px;
    padding: 10px 45px;
    border: 1px solid transparent;
    border-radius: 8px;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    margin-top: 10px;
    cursor: pointer;
}

.container button.hidden {
    background-color: transparent;
    border-color: #fff;
}

.container form {
    background-color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 40px;
    height: 100%;
}

.container input {
    background-color: #eee;
    border: none;
    margin: 8px 0;
    padding: 10px 15px;
    font-size: 13px;
    border-radius: 8px;
    width: 100%;
    outline: none;
}

.form-container {
    position: absolute;
    top: 0;
    height: 100%;
    transition: all 0.6s ease-in-out;
}

.sign-in {
    left: 0;
    width: 50%;
    z-index: 2;
}

.toggle-container {
    position: absolute;
    top: 0;
    left: 50%;
    width: 50%;
    height: 100%;
    overflow: hidden;
    transition: all 0.6s ease-in-out;
    border-radius: 150px 0 0 100px;
    z-index: 1000;
}

.toggle {
    background-color: var(--azul-claro);
    height: 100%;
    color: #fff;
    position: relative;
    left: -100%;
    height: 100%;
    width: 200%;
    transform: translateX(0);
    transition: all 0.6s ease-in-out;
}

.toggle-panel {
    position: absolute;
    width: 50%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 30px;
    text-align: center;
    top: 0;
    transform: translateX(0);
    transition: all 0.6s ease-in-out;
}

.toggle-right {
    right: 0;
    transform: translateX(0);
}

@media (min-width: 769px) {
    .container {
        display: flex;
    }
    
    .form-container {
        flex: 1;
    }
}
</style>