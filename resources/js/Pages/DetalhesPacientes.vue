<template lang="">

<Layout>
    <template v-slot:conteudo>

<div id="caixa">

    <div id="lado-esquerdo">
        <div id="texto-principal">
            <div id="titulo-texto"></div>
            <div id="conteiner-texto"></div>
            <div id="rodape"></div>
        </div>

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

#caixa{
    display: flex;
    width: 100%;
    height: 100%;
    border: 1px solid black;
    justify-content: space-between;
}

#lado-esquerdo{
    border: 1px solid black;
    width: 65% ;
    height: 100%;
}


#texto-principal{
    border: 1px solid black;
    width: 100% ;
    height: 70%;

}

#titulo-texto{
    border: 1px solid black;
    width: 100%;
    height: 10%;
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
}




#lado-direito{
    display: flex;
    width: 34%;
    height: 100%;
    border: 1px solid black;
    
}

</style>