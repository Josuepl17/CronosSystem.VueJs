<template>
    <div id="conteiner-geral">


      <div v-if="isModalOpen" class="modal-overlay" @click="isModalOpen = false"> 
      <div class="modal-content" @click.stop>
        <h1 style="font-size: 16px; font-family: 'Times New Roman', Times, serif;" >Selecione Uma Filial</h1>
        <br>
        <div id="selecioneFilial" v-for="filial in $page.props.filiais" :key="filial.id" >
          
            <Link  :href="'/selecione/filial/' + filial.id">{{ filial.id }} - {{ filial.razao_social }} - {{ filial.cnpj }}</Link>
            
        </div>
  
      </div>
      </div>

      


      <div id="flex-1">

        <div id="menu-geral" :class="{ reduzido: isReduced }" ref="menu">
                    <div id="topo-menu">
                            <img src="/images/profile.jpg" alt="" />
                            <p>Josué</p>
                            <button class="botao-menu" @click="toggleMenu" ref="toggleButton">☰</button>
                    </div> <!-- topo-menu -->
            
                    <div id="links-menu">
                            <Link  href="/dash">
                            <img src="/images/agenda.png" alt="" /> <span>Dashboard</span>
                            </Link>
                            <Link href="/pacientes"><img src="/images/paciente.png" alt="" /> <span>Pacientes</span></Link>
                            <Link href="/consultas"><img src="/images/pesquisar.png" alt="" /> <span>Consultas</span></Link>
                            <a href="#"><img src="/images/agenda.png" alt="" /> <span>Agenda</span></a>
                            <Link href="/medicos"><img src="/images/medico.png" alt="" /> <span>Médicos</span></Link>
                            <Link href="/logout"><img src="/images/logout.png" alt="" /> <span>Sair</span></Link>
                    </div> <!-- links-menu -->
        </div> <!-- menu-geral -->




  
        <div id="ajuste-2">
          <nav>
            <a href="#"><img src="/images/sino.png" alt="" /></a>
            <a href="#"><img src="/images/config.png" alt="" /></a>
            <button @click="isModalOpen = true"  style=" background-color: var(--azul-claro); padding: 10px; border-radius: 10px; color: white; border: none; ">{{ $page.props.empresa_id }}</button>
          </nav>
  
          <div id="ajuste-3">


            <div id="conteudo">
                <slot name="conteudo"></slot>
            </div> <!-- conteudo -->




          </div> <!-- ajuste-3 -->
        </div> <!-- ajuste-2 -->
      </div> <!-- flex-1 -->
    </div> <!-- conteiner-geral -->
  </template>
  
  <script setup>
  import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';



const isModalOpen = ref(false);

  
  const menu = ref(null);
  const toggleButton = ref(null);
  
  function toggleMenu() {
    const isReduced = menu.value.classList.toggle('reduzido');
    
    if (isReduced) {
      toggleButton.value.innerHTML = '☰';
      toggleButton.value.style.marginLeft = '-70%';
    } else {
      
      toggleButton.value.style.marginLeft = '0';  // Resetando a margem
    }
  }
  </script>
  
  <style>
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
border-radius: 05px;
margin-bottom: 05px;
background-color: var(--azul-escuro);
}

#selecioneFilial a:hover{
  background-color: var(--azul-claro);
  
}



#selecioneFilial a{
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

      .botao-menu { /* Botão que abre e fecha o menu */
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
        height: 08%;
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
        height: 08%;
        max-height: 60px;
        min-height: 50px;
        justify-content: flex-end;
        align-items: center;
        padding: 10px;
        background-color: white;
        overflow: hidden;
        
      }

      nav a img{
        width: 25px;
        height: 25px;
        margin-right: 10px;
      }

      #ajuste-3 {  /* Feito apenas para diminuir as bordas do conteiner do conteudo */
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



      @media (max-width: 1150px){
        #menu-geral {
        width: 20%;
      }
      }
      

      @media (max-width: 850px){
        #menu-geral {
        width: 30%;
      }
      }

      @media (max-width: 650px){
        #menu-geral {
        width: 55%;
      }

      p, span{
        font-size: 12px;
      }
      }


</style>