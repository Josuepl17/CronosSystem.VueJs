<template lang="">

<Layout>

    <template v-slot:conteudo>

        <div id="opcoes-conteudo" >

          <Link href="/consultas">Inserir</Link>
          
            <form action="#" method="GET">
                <input type="text"  placeholder="Search..." />
                <button type="submit" >Busca</button>
            </form>

        </div>

        <div id="tabela">
          <table class="minimal-table">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
              </tr>
            </thead>
            <tbody>
              <tr>
              
          <td>1</td>
          <td>John Doe</td>
          <td>john@example.com</td>
          <td>Admin</td>
               
              </tr>
              <tr>
                
          <td>2</td>
          <td>Jane Smith</td>
          <td>jane@example.com</td>
          <td>User</td>
               
              </tr>
              <tr>
                
          <td>3</td>
          <td>Emily Johnson</td>
          <td>emily@example.com</td>
          <td>Editor</td>
               
              </tr>
            </tbody>
          </table>
        </div>





    </template>
    
</Layout>

</template>

<script setup >
import { Link } from '@inertiajs/vue3';
</script>


<style scoped>

      @media (max-width: 650px){

        form{
          display: none;
        }

        #opcoes-conteudo a {

          font-size: 12px;
      }

      }

      #tabela{
        width: 100%;
        height: 92%;
        overflow: auto;
      }

input{
    padding: 08px 29px 08px 29px;
    margin-right: 10px;
}

button{
    padding: 08px 12px 08px 12px;
    margin-right: 10px;
}
#opcoes-conteudo {
  display: flex;
  justify-content: flex-end;
  align-items: center;
  height: 08%;
  width: 100%;
}

#opcoes-conteudo a {
  padding: 08px 29px 08px 29px;
  background-color: rgb(0, 94, 0);
  border-radius: 05px;
  color: white;
  margin-right: 10px;
}

/* Estilo para a tabela minimalista */
.minimal-table {
  width: 100%;
  border-collapse: collapse;
  font-family: Arial, sans-serif;
  background-color: #fff;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
  border-radius: 8px;
}

/* Estilo para os cabeçalhos da tabela */
.minimal-table thead th {
  background-color: #e6e5e5;
  color: #242424;
  font-weight: bold;
  padding: 12px 15px;
  text-align: left;
  border-bottom: 2px solid #ddd;
}

/* Estilo para as células */
.minimal-table tbody td {
  padding: 12px 15px;
  border-bottom: 1px solid #eee;
  color: #555;
}

/* Estilo para o link na linha */
.row-link {
  display: contents; /* Faz o link ocupar toda a linha */
  text-decoration: none;
  color: inherit;
}

/* Estilo para o hover nas linhas */
.minimal-table tbody tr:hover {
  background-color: #f9f9f9;
}

/* Remove a última linha de borda */
.minimal-table tbody tr:last-child td {
  border-bottom: none;
}

/* Estilo para hover nos links */
.row-link:hover {
  color: #007bff;
}
</style>