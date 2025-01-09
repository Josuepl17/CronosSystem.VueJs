<template>

<div class="container">
        <h1>Consultas do Paciente</h1>
        <form @submit.prevent="verificarConsulta.post('/verificar/consulta')"  id="cpfForm">
            <label for="cpf">Digite o CPF:</label>
            <input v-model="verificarConsulta.cpf" type="text" id="cpf" name="cpf" placeholder="Ex: 123.456.789-00" required>
            <button type="submit">Buscar Consultas</button>
        </form>
        <div class="results" id="results">
       
        <ul>
            <p style="color: red; font-size:13px;" v-if="errors.cpf">{{ errors.cpf }}</p>
            <li v-for="consulta in consultas" :key="consulta.id">
                <p><strong>Médico:</strong> {{ consulta.nome_medico }}</p>
                <p><strong>Horário:</strong> {{ consulta.horainicial }}</p>
            </li>
        </ul>
        </div>
    </div>

</template>

<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";

onMounted(() => {
  document.title = "Verifique sua consulta";
}); 

const verificarConsulta = useForm({
  cpf: "",
});



const props = defineProps({
    consultas: Array,
    errors: Array,
});
</script>

<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100vw;
    height: 100vh;
    background-color: #f3f4f6;
    width: 100%;
}

.container {
    width: 100%;

    background: white;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

h1 {
    font-size: 1.5em;
    margin-bottom: 20px;
    color: #333;
    text-align: center;
}

form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

input[type="text"] {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 1em;
}

button {
    padding: 10px;
    border: none;
    border-radius: 4px;
    background-color: #4CAF50;
    color: white;
    font-size: 1em;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #45a049;
}

.results {
    margin-top: 20px;
}

.results ul {
    list-style: none;
    padding: 0;
}

.results li {
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

.results li:last-child {
    border-bottom: none;
}

.no-results {
    text-align: center;
    color: #888;
}
</style>
