import{_ as $,o as j,T as b,r as C,a as M,c as z,w as V,b as s,d as t,t as i,k as p,v as f,u as n,j as r,g as l,h as y,F as x,e as B,f as T,l as c,m as O}from"./app-AjzsqkRK.js";const X={id:"caixa"},E={id:"lado-esquerdo"},I={id:"texto-principal"},R={id:"titulo-texto"},G={id:"conteiner-texto"},H={id:"rodape"},J=["onClick"],K={class:"publicacao-header"},Q={class:"publicacao-titulo"},W={class:"publicacao-descricao"},Y={id:"lado-direito"},Z={class:"box-detalhes"},tt={class:"box-info"},et={class:"box-info"},ot={class:"box-info"},it={class:"box-info"},st={style:{height:"300px"},class:"box-detalhes"},nt={class:"box-info"},lt={id:"tabela"},at={class:"minimal-table"},dt={class:"form-group"},rt={key:0,class:"notification"},ut={key:1,class:"modal-sobreposto"},ct={class:"modal-content"},pt={class:"form-group"},vt={key:0,style:{color:"red","font-size":"13px"}},mt=["onUpdate:modelValue","value","name"],bt={class:"form-group"},ft={key:0,style:{color:"red","font-size":"13px"}},yt={key:2,class:"modal-sobreposto"},xt={class:"modal-content"},ht={id:"tabela"},kt={class:"minimal-table"},_t={style:{width:"50px"}},gt=["href"],Ct={key:0,style:{color:"red","font-size":"13px"}},qt={__name:"DetalhesPacientes",props:{detalhes:Object,paciente:Object,tramites_paciente:Array,message:String,consultas:Array,arquivos:Array,errors:Array,pacienteinfo:Object,medicamentos:Array},setup(a){j(()=>{document.title="Detalhes do Paciente"});const u=a,h=b({medicamento:""}),q=C([]),A=m=>{q.value=Array.from(m.target.files),S.arquivos=q.value},k=b({texto_principal:u.detalhes.texto_principal}),S=b({arquivos:[]}),d=b({id:"",titulo:"",descricao:"",consulta:[]}),v=C(!1),U=(m,e,g)=>{v.value=!0,d.id=m,d.titulo=e,d.descricao=g},D=()=>{v.value=!0},P=()=>{v.value=!1},_=C(!1),F=()=>{_.value=!0},L=()=>{_.value=!1};return(m,e)=>{const g=M("Link"),N=M("Layout");return s(),z(N,null,{conteudo:V(()=>[e[23]||(e[23]=t("nav",null,[t("button",{id:"salvar",type:"submit"},"Relatorio")],-1)),t("form",{onSubmit:e[3]||(e[3]=r(o=>n(k).post("/create/paciente/detalhes"),["prevent"]))},[t("div",X,[t("div",E,[t("div",I,[t("div",R,[t("h1",null,i(u.paciente.nome),1)]),t("div",G,[p(t("textarea",{"onUpdate:modelValue":e[0]||(e[0]=o=>n(k).texto_principal=o)},null,512),[[f,n(k).texto_principal]])]),t("div",H,[e[8]||(e[8]=t("button",{id:"salvar",type:"submit"},"Salvar",-1)),t("button",{type:"button",onClick:F},"Escolher arquivo"),t("button",{type:"button",onClick:r(D,["prevent"])},"Novo")])]),(s(!0),l(x,null,y(a.tramites_paciente,o=>(s(),l("div",{onClick:w=>U(o.id,o.titulo,o.descricao),class:"publicacao",key:o.id},[t("div",K,[t("h3",Q,i(o.titulo),1)]),t("div",W,[t("p",null,i(o.descricao),1)])],8,J))),128))]),t("div",Y,[t("div",Z,[t("div",tt,[e[9]||(e[9]=t("p",null,"Idade do Paciente:",-1)),t("p",null,i(u.pacienteinfo.idadepaciente),1)]),t("div",et,[e[10]||(e[10]=t("p",null,"Data Aniversario:",-1)),t("p",null,i(u.pacienteinfo.aniversario),1)]),t("div",ot,[e[11]||(e[11]=t("p",null,"Ultima Consulta:",-1)),t("p",null,i(u.pacienteinfo.ultimaconsulta),1)]),t("div",it,[e[12]||(e[12]=t("p",null,"Proxima Consulta:",-1)),t("p",null,i(u.pacienteinfo.proximaconsulta),1)])]),t("div",st,[t("div",nt,[t("div",lt,[t("table",at,[e[14]||(e[14]=t("thead",null,[t("tr",{style:{position:"sticky",top:"0","background-color":"white"}},[t("th",null,"#"),t("th",null,"Medicamento Prescrito:"),t("th",null,"X")])],-1)),t("tbody",null,[(s(!0),l(x,null,y(a.medicamentos,o=>(s(),l("tr",{key:o.id},[t("td",null,i(o.id),1),t("td",null,i(o.medicamento),1),t("td",null,[B(g,{class:"delete",href:"/delete/medicamento/"+o.id,style:{"font-size":"12px",padding:"2px 5px"}},{default:V(()=>e[13]||(e[13]=[T("X")])),_:2},1032,["href"])])]))),128))])])])]),t("form",{onSubmit:e[2]||(e[2]=r(o=>n(h).post("/create/medicamento"),["prevent"]))},[t("div",dt,[p(t("input",{"onUpdate:modelValue":e[1]||(e[1]=o=>n(h).medicamento=o),type:"text",id:"motivo",placeholder:"Medicamento"},null,512),[[f,n(h).medicamento]])]),e[15]||(e[15]=t("button",{id:"salvar",type:"submit"},"Salvar",-1))],32)])])])],32),a.message?(s(),l("div",rt,i(a.message),1)):c("",!0),v.value?(s(),l("div",ut,[t("div",ct,[e[17]||(e[17]=t("h1",null,"Registro de Consulta",-1)),e[18]||(e[18]=t("br",null,null,-1)),t("form",{onSubmit:e[6]||(e[6]=r(o=>n(d).post("/inserir/tramite"),["prevent"]))},[t("div",pt,[p(t("input",{"onUpdate:modelValue":e[4]||(e[4]=o=>n(d).titulo=o),type:"text",id:"titulo",placeholder:"Título"},null,512),[[f,n(d).titulo]]),a.errors.titulo?(s(),l("p",vt,i(a.errors.titulo),1)):c("",!0),(s(!0),l(x,null,y(a.consultas,o=>(s(),l("div",{style:{padding:"05px"},key:o.id},[p(t("input",{"onUpdate:modelValue":w=>n(d).consulta=w,value:o.id,type:"checkbox",name:"checkbox_"+o.id},null,8,mt),[[O,n(d).consulta]]),t("p",null,"Consulta dia "+i(o.date),1)]))),128))]),t("div",bt,[p(t("textarea",{"onUpdate:modelValue":e[5]||(e[5]=o=>n(d).descricao=o),name:"descricao",id:"descricao"},`        
                `,512),[[f,n(d).descricao]]),a.errors.descricao?(s(),l("p",ft,i(a.errors.descricao),1)):c("",!0)]),e[16]||(e[16]=t("button",{id:"salvar",type:"submit"},"Salvar",-1)),t("button",{id:"fechar",type:"button",onClick:r(P,["prevent"])},"Fechar")],32)])])):c("",!0),_.value?(s(),l("div",yt,[t("div",xt,[t("div",ht,[t("table",kt,[e[20]||(e[20]=t("thead",null,[t("tr",{style:{position:"sticky",top:"0","background-color":"white"}},[t("th",null,"#"),t("th",null,"Arquivo"),t("th",null,"X")])],-1)),t("tbody",null,[(s(!0),l(x,null,y(a.arquivos,o=>(s(),l("tr",{key:o.id},[t("td",null,i(o.id),1),t("td",null,i(o.nome),1),t("td",_t,[t("a",{href:"/download/arquivo/"+o.identificacao,style:{"background-color":"white"}},e[19]||(e[19]=[t("img",{src:"/images/download.png",alt:""},null,-1)]),8,gt)])]))),128))])]),a.errors.arquivos?(s(),l("p",Ct,i(a.errors.arquivos),1)):c("",!0)]),t("form",{onSubmit:e[7]||(e[7]=r(o=>n(S).post("/create/arquivos"),["prevent"]))},[e[21]||(e[21]=t("br",null,null,-1)),t("input",{type:"file",onChange:A,multiple:""},null,32),e[22]||(e[22]=t("button",{id:"salvar",type:"submit"},"Salvar",-1)),t("button",{type:"button",id:"fechar",onClick:r(L,["prevent"])},"Fechar")],32)])])):c("",!0)]),_:1})}}},wt=$(qt,[["__scopeId","data-v-46b4ef24"]]);export{wt as default};
