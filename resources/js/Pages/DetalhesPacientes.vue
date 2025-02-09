<template lang="">
  <Layout>
    <template v-slot:conteudo>

<nav>

  <button @click="AbrirRelatorios" id="salvar" type="submit">Relatorio</button>
  

</nav>


<!--------------------------------------LADO ESQUERDO---------------------------------------->

      <form @submit.prevent="form.post('/create/paciente/detalhes')">
        <div id="caixa">
          <div id="lado-esquerdo">
            <div id="texto-principal">
              <div id="titulo-texto">
                <h1>{{ props.paciente.nome }}</h1>
              </div> <!-- /#titulo-texto -->
              <div id="conteiner-texto">
                <textarea required @input="editando" v-model="form.texto_principal"></textarea>
              </div> <!-- /#conteiner-texto -->
              <div id="rodape">
                <p v-if="editado" style="color: white; margin-right: 20px; font-style: italic; padding: 05px; background: red; border-radius: 5px;">Texto Não salvo</p>               
                 <button id="salvar"  type="submit">Salvar</button>
                <button  type="button" @click="abrirarquivos">Escolher arquivo</button>
                <button type="button" @click.prevent="abrirModal">Novo</button>
                
                
              </div> <!-- /#rodape -->
            </div> <!-- /#texto-principal -->

            <div @click="abrirtramite(tramites.id, tramites.titulo, tramites.descricao)" class="publicacao" v-for="(tramites) in tramites_paciente" :key="tramites.id">
              <div class="publicacao-header">
                <h3 class="publicacao-titulo">{{ tramites.titulo }}</h3>
                
              </div> <!-- /.publicacao-header -->

              <div class="publicacao-descricao">
                <p>{{ tramites.descricao }}</p>
              </div> <!-- /.publicacao-descricao -->
            </div> <!-- /.publicacao -->
          </div> <!-- /#lado-esquerdo -->
  

<!--------------------------------------LADO DIREITO---------------------------------------->

          <div id="lado-direito">


            
            <div class="box-detalhes">
              <div class="box-info">
                <p>Idade do Paciente:</p>
                <p>{{ props.pacienteinfo.idadepaciente }}</p>
              </div> <!-- /.box-info -->
              <div class="box-info">
                <p>Data Aniversario:</p>
                <p>{{ props.pacienteinfo.aniversario }}</p>
              </div> <!-- /.box-info -->
              <div class="box-info">
                <p>Ultima Consulta:</p>
                <p>{{ props.pacienteinfo.ultimaconsulta }}</p>
              </div> <!-- /.box-info -->
              <div class="box-info">
                <p>Proxima Consulta:</p>
                <p>{{ props.pacienteinfo.proximaconsulta }}</p>
              </div> <!-- /.box-info -->
            </div> <!-- /.box-detalhes -->

            <div style="height: 300px;" class="box-detalhes">

              <div class="box-info">
              <div id="tabela"> 
              <table class="minimal-table"> 
                <thead> 
                <tr style="position: sticky; top: 0; background-color: white;">
                <th>#</th> 
                <th >Medicamento Prescrito:</th>
                <th >X</th>  
                </tr> 
                </thead> 
                <tbody> 
                <tr v-for="(medicamento) in medicamentos" :key="medicamento.id"> 
                <td>{{ medicamento.id }}</td> 
                <td>{{ medicamento.medicamento }}</td> 
                <td><Link class="delete" :href="'/delete/medicamento/' + medicamento.id" style="font-size: 12px; padding: 2px 5px;">X</Link></td>
                </tr> 
                </tbody> 
              </table> 
              </div> <!-- /#tabela -->
              </div> <!-- /.box-info -->

              <form @submit.prevent="formMedicamento.post('/create/medicamento')">
            <div class="form-group">
              <input v-model="formMedicamento.medicamento" type="text" id="motivo" placeholder="Medicamento"/>
            </div> <!-- /.form-group -->
            <button id="salvar" type="submit">Salvar</button>
            
            

            </form>
              
            </div> <!-- /.box-detalhes -->



          </div> <!-- /#lado-direito -->
        </div> <!-- /#caixa -->
      </form>

<!--------------------------------------NOTIFICAÇÃO---------------------------------------->

      <div v-if="message" class="notification">
        {{ message }}
      </div> <!-- /.notification -->


<!--------------------------------------MODAL TRAMITE---------------------------------------->
      
        <div v-if="mostrarModal" class="modal-sobreposto">
          <div class="modal-content">
            <h1>Registro de Consulta</h1>
            <br />
            <form @submit.prevent="modal.post('/inserir/tramite')">
              <div class="form-group">
                <input v-model="modal.titulo" type="text" id="titulo" placeholder="Título"  required />
                <p style="color: red; font-size:13px;" v-if="errors.titulo">{{ errors.titulo }}</p>
                <div style="padding:05px;" v-for="consulta in consultas" :key="consulta.id">
                  <input v-model="modal.consulta" :value="consulta.id" type="checkbox" :name="'checkbox_' + consulta.id" />
                  <p>Consulta dia {{ consulta.date }}</p>
                </div> <!-- /.consulta -->
              </div> <!-- /.form-group -->
              <div class="form-group">
                <textarea v-model="modal.descricao" name="descricao" id="descricao" placeholder="Descrição" required>
        
                </textarea>
                <p style="color: red; font-size:13px;" v-if="errors.descricao">{{ errors.descricao }}</p>
              </div> <!-- /.form-group -->
              <button id="salvar" type="submit">Salvar</button>
              <button id="fechar" type="button" @click.prevent="fecharModal">Fechar</button>
            </form>
          </div> <!-- /.modal-content -->
        </div> <!-- /.modal-sobreposto -->

<!--------------------------------------MODAL ARQUIVOS---------------------------------------->
      <div v-if="mostrararquivos" class="modal-sobreposto">
        <div class="modal-content">
          <div id="tabela">
            
            <table class="minimal-table">
              <thead>
                <tr style="position: sticky; top: 0; background-color: white;">
                  <th>#</th>
                  <th>Arquivo</th>
                  <th>X</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="arquivo in arquivos" :key="arquivo.id">
                  <td>{{arquivo.id}}</td>
                  <td>{{arquivo.nome}}</td>
                  <td style="width: 50px;">
                    <a :href="'/download/arquivo/' + arquivo.identificacao" style="background-color: white;">
                      <img src="/images/download.png" alt="" />
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
            <p style="color: red; font-size: 13px;" v-if="errors.arquivos">{{ errors.arquivos }}</p>
          </div> <!-- /#tabela -->
          <form @submit.prevent="file.post('/create/arquivos')">
            <br>


            <input type="file" @change="handleFileChange" multiple>
            <button id="salvar" type="submit">Salvar</button>
            <button type="button"  id="fechar"  @click.prevent="fechararquivos">Fechar</button>
          </form>

         
        </div> <!-- /.modal-content -->
      </div> <!-- /.modal-sobreposto -->

<!--------------------------------------MODAL PDF Receituario---------------------------------------->

      <div v-if="mostrarReceituario" class="modal-sobreposto">
        <div class="modal-content">
          <h1>Receituario</h1>
          <br />
          <form @submit.prevent="receituario.post('/create/relatorio')">
            <div class="form-group">
              <select required  v-model="receituario.tipo_documento" name="tipo_documento" id="tipo_documento" placeholder="Selecione o tipo de documento">
                <option value="" disabled selected>Selecione o tipo de documento</option>
                <option value="Receituário">Receituário</option>
                <option value="Encaminhamento">Encaminhamento</option>
                <option value="Avaliação">Avaliação</option>
              </select>
            </div>
            <div class="form-group">
              <textarea v-model="receituario.prescricao" name="prescricao" id="prescricao" required ></textarea>
              <p style="color: red; font-size:13px;" v-if="errors.descricao">{{ errors.descricao }}</p>
            </div>
            
            <button id="salvar" type="submit">Salvar</button>
            <button id="fechar" type="button" @click.prevent="fecharReceituario">Fechar</button>
          </form>
        </div>
      </div><!--------------------------------------MODAL PDF Receituario tabela---------------------------------------->

<div v-if="mostrarRelatorios" class="modal-sobreposto">
        <div class="modal-content">
          <div id="tabela">
            
            <table class="minimal-table">
              <thead>
                <tr style="position: sticky; top: 0; background-color: white;">
                  <th>#</th>
                  <th>tipo Documento</th>
                  <th style="width: 50px;">X</th>
                  <th style="width: 50px;">X</th>                </tr>
              </thead>
              <tbody>
                <tr v-for="relatorio in relatorios" :key="relatorio.id">
                  <td>{{relatorio.id}}</td>
                  <td>{{relatorio.tipo_documento}}</td>
                  <td style="width: 50px;">
                    <button @click.prevent="visualizarRelatorio(relatorio.id, relatorio.tipo_documento, relatorio.prescricao)" id="salvar" type="submit">Ver</button>
                  </td>
                                  <td>
                                    <a :href="'/pdf/' + receituario.id" id="salvar" class="button">Gerar</a>
                                  </td>
                </tr>
              </tbody>
            </table>
            
          </div> <!-- /#tabela -->
          <button @click="AbrirReceituario" id="salvar" type="submit">Novo</button>
          <button id="fechar" type="button" @click.prevent="FecharRelatorios">Fechar</button>
        </div> <!-- /.modal-content -->
      </div> <!-- /.modal-sobreposto -->



    </template>
  </Layout>
</template>


<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";
import { usePage } from "@inertiajs/vue3";

onMounted(() => {
  document.title = "Detalhes do Paciente";
});

const editado = ref(false);

const editando = () => {
  editado.value = true; // Define como "não salvo" ao editar
};

const props = defineProps({
  texto_principal: Object,
  paciente: Object,
  tramites_paciente: Array,
  message: String,
  consultas: Array,
  arquivos: Array,
  errors: Object,
  pacienteinfo: Object,
  medicamentos: Array,
  csrf_token: String,
  relatorios: Array,
});

const csrfToken = usePage().props.csrf_token;

const receituario = useForm({
  id: "",
  prescricao: "",
  tipo_documento: "",
});

const formMedicamento = useForm({
  medicamento: "",
});

function formatarData(data) {
  const [datePart] = data.split("T");
  const [ano, mes, dia] = datePart.split("-");
  return `${dia}/${mes}/${ano}`;
}

const arquivosSelecionados = ref([]);

const handleFileChange = (event) => {
  arquivosSelecionados.value = Array.from(event.target.files);
  file.arquivos = arquivosSelecionados.value;
};

const form = useForm({
  texto_principal: props.texto_principal || "",
});

const file = useForm({
  arquivos: [],
});

const modal = useForm({
  id: "",
  titulo: "",
  descricao: "",
  consulta: [],
});

const mostrarModal = ref(false);

const abrirtramite = (id, titulo, descricao) => {
  mostrarModal.value = true;
  modal.id = id;
  modal.titulo = titulo;
  modal.descricao = descricao;
};

const abrirModal = () => {
  mostrarModal.value = true;
};

const fecharModal = () => {
  mostrarModal.value = false;
};

const mostrararquivos = ref(false);

const abrirarquivos = () => {
  mostrararquivos.value = true;
};

const fechararquivos = () => {
  mostrararquivos.value = false;
};

const mostrarReceituario = ref(false);

const AbrirReceituario = () => {
  mostrarRelatorios.value = false;
  mostrarReceituario.value = true;
  receituario.id = null;
  receituario.tipo_documento = null;
  receituario.prescricao = null;
};

const fecharReceituario = () => {
  mostrarReceituario.value = false;
  mostrarRelatorios.value = true;
};

const mostrarRelatorios = ref(false);

const AbrirRelatorios = () => {
  mostrarRelatorios.value = true;
};

const FecharRelatorios = () => {
  mostrarRelatorios.value = false;
};

const visualizarRelatorio = (id, tipo_documento, prescricao) => {
  mostrarRelatorios.value = false;
  mostrarReceituario.value = true;
  receituario.id = id;
  receituario.tipo_documento = tipo_documento;
  receituario.prescricao = prescricao;
};
</script>







<style scoped>
@import "../../../public/css/modal.css";
@import "../../../public/css/tabelas.css";
@import "../../../public/css/botoes.css";

nav {
  display: flex;
  height: 02%;
  width: 100%;
  border-radius: 03px;
}

.notification {
  position: fixed;
  top: 10px;
  left: 50%;
  transform: translateX(-50%);
  padding: 15px 20px;
  background-color: #4caf50;
  color: #fff;
  font-weight: bold;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  z-index: 999;
  animation: slide-down 0.5s ease, fade-out 0.3s ease 2.7s forwards;
}

@keyframes slide-down {
  from {
    transform: translateY(-100%) translateX(-50%);
    opacity: 0;
  }
  to {
    transform: translateY(0) translateX(-50%);
    opacity: 1;
  }
}

@keyframes fade-out {
  from {
    opacity: 1;
  }
  to {
    opacity: 0;
    visibility: hidden;
  }
}

@keyframes fade-out {
  from {
    opacity: 1;
  }
  to {
    opacity: 0;
    visibility: hidden;
  }
}
</style>

<style>
.publicacao {
  width: 90%;
  display: flex;
  border-radius: 8px;
  flex-direction: column;
  margin-bottom: 15px;
  background-color: #f9f9f9;
  padding: 20px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.publicacao:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

.publicacao-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
}

.publicacao-titulo {
  font-size: 1.2rem;
  font-weight: bold;
  color: #333;
}

.publicacao-id {
  font-size: 0.9rem;
  color: #888;
}

.publicacao-descricao {
  font-size: 1rem;
  color: #555;
  line-height: 1.5;
}
</style>



<style scoped>
.form-group {
  margin-bottom: 10px;
  display: flex;
  align-items: center;
}

.form-group textarea {
  width: 100%;
  height: 300px;
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
  font-weight: 550;
}

input:focus {
  outline: none;
  border: 1px solid #ccc;
}

textarea:focus {
  outline: none;
  border: 1px solid #ccc;
}

:root {
  --azul-escuro: #012841;
  --azul-claro: #014552;
  --cinza-escuro: #212529;
}

#conteudo {
  background-color: #000000;
}

form {
  all: unset;
}

#caixa {
  display: flex;
  width: 100%;
  height: 100%;
  justify-content: space-between;
  background-color: rgb(185, 193, 201);
}

#lado-esquerdo {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 65%;
  height: 98%;
  overflow: auto;
  margin-top: 10px;
}

#texto-principal {
  width: 100%;
  margin-bottom: 15px;
  min-height: 340px;
  background-color: #ffffff;
  border-radius: 5px;
}

#titulo-texto {
  border-bottom: 1px solid rgba(0, 0, 0, 0.177);
  width: 100%;
  height: 10%;
  border-radius: 5px 5px 0px 0px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  color: rgb(0, 0, 0);
  font-size: 1.2rem;
  padding: 6px;
}

#conteiner-texto {
  width: 100%;
  height: 80%;
  padding: 9px;
  font-family: "Times New Roman", Times, serif;
  font-size: 16px;
}

textarea {
  width: 100%;
  height: 100%;
  border: 1px solid rgba(0, 0, 0, 0.229);
  border-radius: 4px;
  font-size: 16px;
  color: #555;
  padding: 10px;
}

#rodape {
  display: flex;
  justify-content: flex-end;
  align-items: center;
  width: 100%;
  height: 10%;
  border-radius: 0px 0px 5px 5px;
}

#rodape input {
  color: white;
  padding-right: 10px;
}

#publicacao {
  width: 90%;
  min-height: 145px;
  border-radius: 5px;
  margin-bottom: 10px;
  background-color: #ffffff;
}

#lado-direito {
  display: flex;
  width: 34%;
  height: 98%;
  justify-content: flex-start;
  flex-direction: column;
  margin-top: 10px;
}

.box-detalhes {
  width: 100%;
  height: 230px;
  background-color: #ffffff;
  border-radius: 4px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  padding: 15px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  gap: 8px;
  margin-bottom: 10px;
}

.box-info {
  display: flex;
  justify-content: space-between;
  font-family: Arial, sans-serif;
  font-size: 14px;
  color: #333;
  border-bottom: 1px solid #f0f0f0;
  padding: 5px 0;
  flex-direction: column;
  overflow: auto;
  height: 100%;
}

.box-info:last-child {
  border-bottom: none;
}

.box-info p:first-child {
  font-weight: bold;
  color: #555;
}

::-webkit-scrollbar {
  width: 4px;
}

::-webkit-scrollbar-thumb {
  background-color: #888;
  border-radius: 10px;
}

::-webkit-scrollbar-track {
  background-color: #f1f1f1;
  border-radius: 10px;
}

* {
  scrollbar-width: thin;
  scrollbar-color: #888 #f1f1f1;
}
</style>
