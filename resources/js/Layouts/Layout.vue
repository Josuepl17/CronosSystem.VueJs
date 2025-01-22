<template>
  <div id="conteiner-geral">
    <div v-if="isModalOpen" class="modal-overlay" @click="isModalOpen = false">
      <div class="modal-content" @click.stop>
        <h1
          style="font-size: 16px; font-family: 'Times New Roman', Times, serif"
        >
          Selecione Uma Filial
        </h1>
        <br />
        <div
          id="selecioneFilial"
          v-for="filial in $page.props.filiais"
          :key="filial.id"
        >
          <Link :href="'/selecione/filial/' + filial.id">
            {{ filial.id }} - {{ filial.razao_social }} - {{ filial.cnpj }}
          </Link>
        </div>
      </div>
    </div>

    <div id="flex-1">
      <div id="menu-geral" :class="{ reduzido: isReduced }" ref="menu">
        <div id="topo-menu">
          <img src="/images/profile.jpg" alt="" />
          <p>{{ $page.props.nome }}</p>
          <button class="botao-menu" @click="toggleMenu" ref="toggleButton">
            ☰
          </button>
        </div>
        <!-- topo-menu -->

        <div id="links-menu">
          <Link href="/dash" :class="{ 'active-link': $page.url === '/dash' }">
            <img src="/images/agenda.png" alt="" />
            <span>Dashboard</span>
          </Link>

          <Link  v-if="$page.props.acessar_pacientes"
            href="/pacientes"
            :class="{
              'active-link':
                $page.url === '/pacientes' ||
                $page.url === '/detalhes/paciente' ||
                $page.url === '/form/paciente',
            }"
          >
            <img src="/images/paciente.png" alt="" />
            <span>Pacientes</span>
          </Link>

            <Link v-if="$page.props.acessar_atendentes"
            href="/atendentes"
            :class="{
              'active-link':
              $page.url.startsWith('/atendentes') || $page.url.startsWith('/form/atendentes') || $page.url.startsWith('/edit/atendentes'),
            }"
            >
            <img src="/images/medico.png" alt="" />
            <span>Atendentes</span>
            </Link>

          <Link v-if="$page.props.acessar_consultas"
            href="/consultas"
            :class="{
              'active-link':
                $page.url === '/consultas' || $page.url === '/form/consultas',
            }"
          >
            <img src="/images/pesquisar.png" alt="" />
            <span>Consultas</span>
          </Link>


          <Link v-if="$page.props.acessar_medicos"
            href="/medicos"
            :class="{
              'active-link':
                $page.url.startsWith('/medicos') ||
                $page.url.startsWith('/form/medicos') ||
                $page.url.startsWith('/edit/medico'),
            }"
          >
            <img src="/images/medico.png" alt="" />
            <span>Profissional</span>
          </Link>

          <Link
            v-if="$page.props.acessar_empresas"
            href="/gerenciar/filial"
            :class="{ 'active-link': $page.url === '/gerenciar/filial' }"
          >
            <img src="/images/filial.png" alt="" />
            <span>Gerenciar Filial</span>
          </Link>

          <Link
            href="/logout"
            :class="{ 'active-link': $page.url === '/logout' }"
          >
            <img src="/images/logout.png" alt="" />
            <span>Sair</span>
          </Link>
        </div>
        <!-- links-menu -->
      </div>
      <!-- menu-geral -->

      <div id="ajuste-2">
        <nav>
          <a href="#"><img src="/images/sino.png" alt="" /></a>
          <a href="#"><img src="/images/config.png" alt="" /></a>

          <button
            @click="isModalOpen = true"
            style="
              background-color: var(--azul-claro);
              padding: 10px;
              border-radius: 10px;
              color: white;
              border: none;
            "
          >
            {{ $page.props.razao_social }}
          </button>
        </nav>

        <div id="ajuste-3">
          <div id="conteudo">
            <slot name="conteudo"></slot>
          </div>
          <!-- conteudo -->
        </div>
        <!-- ajuste-3 -->
      </div>
      <!-- ajuste-2 -->
    </div>
    <!-- flex-1 -->
  </div>
  <!-- conteiner-geral -->
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";

const isModalOpen = ref(false);

const menu = ref(null);
const toggleButton = ref(null);

function toggleMenu() {
  const isReduced = menu.value.classList.toggle("reduzido");

  if (isReduced) {
    toggleButton.value.innerHTML = "☰";
    toggleButton.value.style.marginLeft = "-90%";
  } else {
    toggleButton.value.style.marginLeft = ""; // Resetando a margem
  }
}

// Função para pré-carregar imagens
function preloadImages(imageUrls) {
  const promises = imageUrls.map((url) => {
    return new Promise((resolve, reject) => {
      const img = new Image();
      img.src = url;
      img.onload = resolve;
      img.onerror = reject;
    });
  });

  return Promise.all(promises);
}

// Chamando a função de pré-carregamento no ciclo de vida
onMounted(async () => {
  const imageUrls = [
    "/images/profile.jpg",
    "/images/agenda.png",
    "/images/paciente.png",
    "/images/medico.png",
    "/images/pesquisar.png",
    "/images/filial.png",
    "/images/logout.png",
    "/images/sino.png",
    "/images/config.png",
  ];

  try {
    await preloadImages(imageUrls);
    console.log("Todas as imagens foram carregadas com sucesso!");
  } catch (error) {
    console.error("Erro ao carregar algumas imagens:", error);
  }
});
</script>

<style scoped>
#links-menu a,
#links-menu .active-link {
  text-decoration: none;
  color: #8a8888; /* Cor padrão */
}

#links-menu .active-link {
  background-color: var(--azul-claro); /* Cor de fundo */
  color: #fff; /* Cor do texto */
  font-weight: bold; /* Deixa o texto mais forte */
  border-radius: 8px; /* Bordas arredondadas */
}

#menu-geral.reduzido {
  width: 60px;
  min-width: 0;
}

#menu-geral.reduzido #topo-menu p {
  opacity: 0;
  visibility: hidden;
}

#menu-geral.reduzido #links-menu a span {
  opacity: 0;
  visibility: hidden;
}
</style>

<style>
#selecioneFilial {
  display: flex;
  justify-content: center;
  border: 1px solid black;
  border-radius: 5px;
  margin-bottom: 5px;
  background-color: var(--azul-escuro);
}

#selecioneFilial a:hover {
  background-color: var(--azul-claro);
}

#selecioneFilial a {
  display: flex;
  color: rgb(255, 255, 255);
  width: 100%;
  height: 100%;
  padding: 10px;
  justify-content: center;
}

.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.7);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.modal-content {
  background-color: white;
  padding: 20px;
  border-radius: 8px;
  width: 600px;
  height: 400px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  z-index: 1001;
  transition: ease-in-out 1s;
  text-align: center;
}

:root {
  --azul-escuro: #012841;
  --azul-claro: #014552;
  --cinza-escuro: #212529;
}

* {
  margin: 0px;
  padding: 0px;
  box-sizing: border-box;
  text-decoration: none;
  font-size: 13px;
  font-family: Arial, Helvetica, sans-serif;
}

#conteiner-geral {
  background-color: rgb(185, 193, 201);
  width: 100%;
  height: 100dvh;
}

/* Primeiro Conteudo Menu e Barra de Navegação */
#flex-1 {
  display: flex;
  width: 100%;
  height: 100%;
}

.botao-menu {
  /* Botão que abre e fecha o menu */
  background-color: var(--azul-claro);
  color: white;
  border: none;
  padding: 10px;
  cursor: pointer;
  z-index: 100;
}

#menu-geral {
  width: 13%;
  height: 100%;
  max-width: 250px;
  background-color: var(--cinza-escuro);
  transition: width 0.9s ease;
}

#topo-menu {
  display: flex;
  width: 100%;
  height: 8%;
  min-height: 50px;
  max-height: 60px;
  align-items: center;
  justify-content: space-between;
  padding: 10px;
  border-bottom: 1px solid var(--azul-claro);
}

#topo-menu img {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  object-fit: cover;
}

#topo-menu p {
  color: white;
  margin-left: 10px;
  transition: opacity 0.3s ease;
  width: 100%;
}

#links-menu {
  display: flex;
  flex-direction: column;
  padding: 10px;
}

#links-menu a {
  display: flex;
  align-items: center;
  padding: 10px;
  color: aliceblue;
  border-radius: 7px;
  margin-bottom: 5px;
}

#links-menu a:hover {
  background-color: var(--azul-claro);
  transition: background-color 0.3s;
}

#links-menu a img {
  width: 20px;
  height: 20px;
}

#links-menu a span {
  margin-left: 10px;
  transition: opacity 0.3s ease;
}

/* Area Menu de navegação com Area Conteudo */
#ajuste-2 {
  flex-grow: 1;
  width: 85%;
  height: 100%;
  display: flex;
  flex-direction: column;
  overflow: hidden;
}

nav {
  display: flex;
  width: 100%;
  height: 8%;
  max-height: 60px;
  min-height: 50px;
  justify-content: flex-end;
  align-items: center;
  padding: 10px;
  background-color: white;
  overflow: hidden;
}

nav a img {
  width: 25px;
  height: 25px;
  margin-right: 10px;
}

#ajuste-3 {
  /* Feito apenas para diminuir as bordas do conteiner do conteudo */
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  height: 92%;
  overflow: hidden;
}

#conteudo {
  width: 98%;
  height: 94%;
  border-radius: 5px;
  background-color: white;
}

@media (max-width: 1150px) {
  #menu-geral {
    width: 20%;
  }
}

@media (max-width: 850px) {
  #menu-geral {
    width: 30%;
  }
}

@media (max-width: 650px) {
  #menu-geral {
    width: 55%;
  }

  p,
  span {
    font-size: 12px;
  }
}
</style>
