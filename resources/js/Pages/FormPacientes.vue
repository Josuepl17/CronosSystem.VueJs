<template lang="">

<Layout>
    <template v-slot:conteudo>

        <div class="fomulario-usuario">
                <form>
                    <div class="form-group">
                       <label for="name">Nome Completo</label> 
                        <input type="text" id="name" placeholder="Nome Completo"  >
                    </div>

                    <div  class="form-group">
                        <label for="DataNascimento">Data Nascimento</label>
                        <input type="date" id="DataNascimento" placeholder="Data Nascimento">
                  </div>   

                  <div  class="form-group">
                  <label for="Medico">Medico Responsavel</label>
                  <select name="id" id="id">
                    <option value="iu">Carlos (Pisicologo)</option>
                    <option value="iu">Mariana (Psiquiatra)</option>
                    <option value="iu">Marlon (Neurologista)</option>
                    <option value="iu">Jessica (Pedriatra)</option>
                  </select>
                </div>  

                    <div class="form-group">
                      <label for="cpf">CPF/RG</label>
                      <input type="number" id="cpf" placeholder="CPF/RG">
                  </div>

            
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" placeholder="Email">
                    </div>
            
                    <div class="form-group">
                        <label for="company">Cidade</label>
                        <input type="text" id="company" placeholder="Cidade">
                    </div>
            
                    <div class="form-group">
                        <label for="bairro">Bairro</label>
                        <input type="text" id="bairro" placeholder="Bairro">
                    </div>
          
            
                    <div class="form-group">
                        <label for="password">Senha Pessoal</label>
                        <input type="password" id="password" placeholder="Senha Pessoal">
                    </div>
            
                    <div class="fechar-salvar">
                        <button type="button" class="fechar">Fechar</button>
                        <button type="submit" class="salvar">Salvar</button>

                    </div>
                </form>
            </div>

    </template>
</Layout>

</template>

<script setup >



</script>


<style scoped>
      .fomulario-usuario {
      width: 100%;
      padding: 20px;
      overflow: auto;
    }

    .form-group {
      margin-bottom: 10px;
    }

    label {
      display: block;
      margin-bottom: 1px;
      font-weight: bold;
    }

    input[type="text"],
    input[type="email"],
    input[type="date"],
    input[type="password"],
    input[type="number"],
    select {
      width: 100%;
      padding: 10px;
      border-radius: 4px;
      border: 1px solid #ccc;
      
    }

    button {
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 4px;
      cursor: pointer;
    }

    button.salvar {
      background-color: #4caf50;
    }

    button.fechar {
      background-color: #9d9d9d;
    }

    .fechar-salvar {
      display: flex;
      justify-content: space-between;
    }

</style>