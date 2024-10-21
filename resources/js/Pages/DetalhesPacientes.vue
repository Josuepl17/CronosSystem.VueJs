<template lang="">

<Layout>
    <template v-slot:conteudo>

<div id="caixa">

    <div id="lado-esquerdo">
        <div id="texto-principal">
            <div id="titulo-texto"><h1>Josué Pacheco de Lima</h1></div>
            <div id="conteiner-texto"></div>
            <div id="rodape"></div>
        </div>

        <div id="publicacao"></div>
        <div id="publicacao"></div>
        <div id="publicacao"></div>





    </div>




    <div id="lado-direito">

    </div>


</div>

    </template>
</Layout>

</template>

<script setup >



</script>


<style scoped>

#conteudo{
    background-color: #000000;
}

#caixa{
    display: flex;
    width: 100%;
    height: 100%;
    justify-content: space-between;
    background-color: rgb(185, 193, 201);
}

#lado-esquerdo{
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 65% ;
    height: 100%;
    overflow: auto;
    
}


#texto-principal{
    width: 100% ;
    margin-bottom: 15px;
    min-height: 340px;
    background-color: #ffffff;
    border-radius:05px;
}

#titulo-texto{
    border: 1px solid black;
    width: 100%;
    height: 10%;
    border-radius:05px 05px 0px 0px;
}

#conteiner-texto{
    border: 1px solid black;
    width: 100%;
    height: 82%;
}

#rodape{
    border: 1px solid black;
    width: 100%;
    height: 08%;
    border-radius:0px 0px 05px 05px;
}



#publicacao{
    
    width: 90%;
    min-height: 145px;
    border-radius: 05px;
    margin-bottom: 10px;
    background-color: #ffffff;
}




#lado-direito{
    display: flex;
    width: 34%;
    height: 100%;
    
    background-color: #ffffff;
    
}







::-webkit-scrollbar {
  width: 4px; /* Afina a barra de rolagem */
}

::-webkit-scrollbar-thumb {
  background-color: #888; /* Cor da parte móvel da barra de rolagem */
  border-radius: 10px; /* Arredonda as bordas da parte móvel */
}

::-webkit-scrollbar-track {
  background-color: #f1f1f1; /* Cor do fundo da barra de rolagem */
  border-radius: 10px; /* Arredonda as bordas da trilha (opcional) */
}

/* Para Firefox */
* {
  scrollbar-width: thin; /* Afina a barra de rolagem */
  scrollbar-color: #888 #f1f1f1; /* Cor da parte móvel e do fundo */
}

</style>