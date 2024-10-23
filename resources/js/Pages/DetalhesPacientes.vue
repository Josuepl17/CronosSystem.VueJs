<template lang="">

<Layout>
    <template v-slot:conteudo>

<div id="caixa">

    <div id="lado-esquerdo">
        <div id="texto-principal">
            <div id="titulo-texto"><h1>Josué Pacheco de Lima</h1></div>

            <div id="conteiner-texto">
                <textarea  ></textarea>
            </div>

            <div id="rodape">
                <a href="">Novo Registro</a>
            </div>
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

:root {
        --azul-escuro: #012841;
        --azul-claro: #014552;
        --cinza-escuro: #212529;
      }

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
    border-bottom: 1px solid rgba(0, 0, 0, 0.177);
    width: 100%;
    height: 10%;
    border-radius:05px 05px 0px 0px;
    display: flex;
    justify-content: flex-start;
    align-items: center;
    color: white;
    background-color: var(--cinza-escuro);
}

#conteiner-texto{
    
    width: 100%;
    height: 80%;
    padding: 15px;
    font-family: 'Times New Roman', Times, serif;
    font-size: 16px;
}

#conteiner-texto textarea{
width: 100%;
height: 100%;
border: none;
outline: none;
font-size: 16px;

}

textarea:focus {
    border: none; /* Remove a borda ao clicar */
  }

#rodape{
    display: flex;
    justify-content: flex-end;
    align-items: center;
    border: 1px solid black;
    width: 100%;
    height: 10%;
    border-radius:0px 0px 05px 05px;
    background-color: var(--cinza-escuro);
}

#rodape a{

padding: 07px 20px 07px 20px;
  background-color: rgb(0, 0, 94);
  border-radius: 05px;
  color: white;
  margin-right: 10px;
  

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