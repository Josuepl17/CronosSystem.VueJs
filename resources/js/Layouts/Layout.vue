<template>
    <div id="conteiner-geral">
      <div id="flex-1">

        <div id="menu-geral" :class="{ reduzido: isReduced }" ref="menu">
                    <div id="topo-menu">
                            <img src="static/profile.jpg" alt="" />
                            <p>Josué</p>
                            <button class="botao-menu" @click="toggleMenu" ref="toggleButton">☰</button>
                    </div> <!-- topo-menu -->
            
                    <div id="links-menu">
                            <a style="background-color: var(--azul-claro)" href="index.html">
                            <img src="static/dashboard.png" alt="" /> <span>Dashboard</span>
                            </a>
                            <a href="form.html"><img src="static/paciente.png" alt="" /> <span>Pacientes</span></a>
                            <a href="dados.html"><img src="static/pesquisar.png" alt="" /> <span>Consultas</span></a>
                            <a href="#"><img src="static/agenda.png" alt="" /> <span>Agenda</span></a>
                            <a href="#"><img src="static/medico.png" alt="" /> <span>Médicos</span></a>
                            <Link href="/logout"><img src="static/logout.png" alt="" /> <span>Sair</span></Link>
                    </div> <!-- links-menu -->
        </div> <!-- menu-geral -->




  
        <div id="ajuste-2">
          <nav>
            <a href="#"><img src="static/sino.png" alt="" /></a>
            <a href="#"><img src="static/config.png" alt="" /></a>
            <Link style="background-color: var(--azul-claro); padding: 10px; border-radius: 10px; color: white;"  href="">Filial Selecionada</Link>
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



      template{
        width: 100%;
        height: 100dvh;
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
        width: 12%;
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
        display: flex;
        width: 98%;
        height: 94%;
        border-radius: 5px;
        background-color: white;
        padding: 20px;
    
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