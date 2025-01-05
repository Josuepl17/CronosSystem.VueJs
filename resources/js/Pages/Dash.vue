<template>
  <Layout>
    <template v-slot:conteudo>
      <div id="conteudo-pessoal">
        <div class="card">
          <span class="card-titulo">
          <!--  <img width="8%" src="images/check.png" alt="">&nbsp; Consultas Marcadas-->
          </span>
          <span class="card-conteudo">10</span>
        </div> <!-- card -->

        <div class="card">
          <span class="card-titulo">
         <!--    <img width="8%" src="usuario-ferido.png" alt="">&nbsp; Pacientes Ativos-->
          </span>
          <span class="card-conteudo">65</span>
        </div> <!-- card -->

        <div class="card">
          <span class="card-titulo">
           <!--  <img width="8%" src="pendente.png" alt="">&nbsp; Exames Pendentes-->
          </span>
          <span class="card-conteudo">36</span>
        </div> <!-- card -->

        <div class="card">
          <span class="card-titulo">
            <!-- <img width="8%" src="cancelado.png" alt="">&nbsp; Consultas Canceladas-->
          </span>
          <span class="card-conteudo">8</span>
        </div> <!-- card -->
      </div> <!-- conteudo-pessoal -->
    </template>
  </Layout>
</template>

<script setup>
  import { defineProps } from 'vue';
  import { onMounted } from 'vue';

  onMounted(() => {
    document.title = 'Dashboard';
  });
</script>

<style scoped>
  :root {
    --azul-escuro: #012841;
    --azul-claro: #00657c;
    --cinza-escuro: #212529;
  }

  #conteudo-pessoal {
    display: flex;
    width: 100%;
    height: 100%;
    flex-wrap: wrap;
    justify-content: space-evenly;
    overflow: auto;
  }

  .card {
    display: flex;
    flex-direction: column;
    margin-top: 10px;
    width: 17%;
    min-width: 160px;
    height: 130px;
    border-radius: 5px;
    background-color: var(--cinza-escuro);
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.311);
  }

  .card .card-titulo {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 20%;
    border-bottom: 2px solid var(--azul-claro);
    color: white;
  }

  .card .card-conteudo {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 80%;
    font-size: 18px;
    color: white;
  }
</style>