<template lang="">
    <div class="min-h-screen flex items-center justify-center">
        <div class="container" id="container">
            <div class="form-container sign-in">
                <form @submit.prevent="form.post('/login')">
                    <h1>Faça Login</h1>
                    <input type="email" placeholder="Email" v-model="form.email" required>
                    <input type="password" placeholder="Password" v-model="form.password">
                    <p style="color: red; font-size:13px;" v-if="errors.email">{{ errors.email }}</p>
                    <button>Login</button>
                 <!--   <Link class="novo-usuario" href="/form/user/empresas">Novo Usuario</Link>  -->
                </form>
            </div>
            <div class="toggle-container">
                <div class="toggle">
                    <div class="toggle-panel toggle-right">
                        <h1>Ola, Meu Amigo(a)</h1>
                        <p>Bem Vindo Ao Cronos, Seu Controle de Consultas.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { onMounted } from 'vue';

onMounted(() => {
  document.title = 'Faça Login';
});

const props = defineProps({
    errors: Array,
});

const form = useForm({
    email: '',
    password: '',
});
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

h1 {
    font-family: 'Times New Roman', Times, serif;
    font-size: 1.5rem;
    margin-bottom: 1rem;
}

body {
    background-color: #c9d6ff;
    background: linear-gradient(to right, #e2e2e2, #c9d6ff);
}

.min-h-screen {
    min-height: 100vh;
}

.flex {
    display: flex;
}

.items-center {
    align-items: center;
}

.justify-center {
    justify-content: center;
}

.container {
    background-color: #fff;
    border-radius: 30px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
    position: relative;
    overflow: hidden;
    width: 90%;
    max-width: 768px;
    min-height: 480px;
}

.container p {
    font-size: 14px;
    line-height: 1.5;
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
}

.novo-usuario {
    padding: 10px;
    border: 1px solid white;
    border-radius: 10px;
    background-color: #014552;
    color: white !important;
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
    width: 100%;
    max-width: 200px;
}

.container form {
    background-color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 20px;
    height: 100%;
    width: 100%;
}

.container input {
    background-color: #eee;
    border: none;
    margin: 8px 0;
    padding: 10px 15px;
    font-size: 13px;
    border-radius: 8px;
    width: 100%;
    max-width: 300px;
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
    width: 100%;
    z-index: 2;
}

.toggle-container {
    display: none;
}

@media (min-width: 768px) {
    .sign-in {
        width: 50%;
    }

    .toggle-container {
        display: block;
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
}

@media (max-width: 480px) {
    .container {
        margin: 10px;
        min-height: 400px;
    }

    .container form {
        padding: 15px;
    }

    h1 {
        font-size: 1.2rem;
    }

    .container input,
    .container button {
        font-size: 12px;
    }
}
</style>
