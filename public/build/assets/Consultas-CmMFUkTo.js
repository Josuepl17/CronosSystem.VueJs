import{_ as S,T as C,r as $,o as x,a as F,c as u,w as d,b as a,d as t,u as l,i as v,f as y,l as i,j as p,k as h,v as k,g as m,h as N,t as n,n as V,F as B}from"./app-Bf_Pnv30.js";const X={id:"opcoes-conteudo"},D={id:"tabela"},I={class:"minimal-table"},L=["onClick"],T={key:0,class:"modal-sobreposto"},A={class:"modal-content"},H={class:"form-group"},P={__name:"Consultas",props:{consultas:Array,date:String},setup(b){const g=b,r=C({identificacao:"",motivo:""}),c=C({date:g.date||""}),f=$(!1),w=s=>{f.value=!0,r.identificacao=s},M=()=>{f.value=!1};return x(()=>{document.title="Consultas"}),(s,e)=>{const _=F("Layout");return a(),u(_,null,{conteudo:d(()=>[t("div",X,[s.$page.props.inserir_consulta?(a(),u(l(v),{key:0,id:"botao_inserir_superior",href:"/form/consultas"},{default:d(()=>e[4]||(e[4]=[y("Inserir")])),_:1})):i("",!0),t("form",{onSubmit:e[1]||(e[1]=p(o=>l(c).post("/filtro/consulta"),["prevent"]))},[h(t("input",{"onUpdate:modelValue":e[0]||(e[0]=o=>l(c).date=o),type:"date",name:"date",id:"date"},null,512),[[k,l(c).date]]),e[5]||(e[5]=t("input",{type:"submit",value:"Pesquisar"},null,-1))],32)]),t("div",D,[t("table",I,[e[8]||(e[8]=t("thead",null,[t("tr",{style:{position:"sticky",top:"0","background-color":"white"}},[t("th",null,"Nome Paciente"),t("th",null,"Nome Medico"),t("th",null,"Status"),t("th",null,"Data Consulta"),t("th",null,"Hora Inicial"),t("th",null,"Hora Final"),t("th",null,"Motivo Status"),t("th",{style:{width:"40px"}},"X"),t("th",{style:{width:"40px"}},"X"),t("th",{style:{width:"20px"}},"X")])],-1)),t("tbody",null,[(a(!0),m(B,null,N(b.consultas,o=>(a(),m("tr",{key:o.id},[t("td",null,n(o.nome_paciente),1),t("td",null,n(o.nome_medico),1),t("td",{style:{color:"white"},class:V({"status-agendado":o.status==="Agendado","status-cancelado":o.status==="Cancelado","status-concluido":o.status==="Concluido"})},n(o.status),3),t("td",null,n(o.date),1),t("td",null,n(o.horainicial),1),t("td",null,n(o.horafinal),1),t("td",null,n(o.motivo_status),1),t("td",null,[s.$page.props.concluir_consulta?(a(),u(l(v),{key:0,class:"status-concluido",href:"/concluir/consulta/"+o.identificacao},{default:d(()=>e[6]||(e[6]=[y("Concluir")])),_:2},1032,["href"])):i("",!0)]),t("td",null,[s.$page.props.cancelar_consulta?(a(),m("a",{key:0,class:"status-cancelado",href:"#",onClick:p(U=>w(o.identificacao),["prevent"])},"Cancelar",8,L)):i("",!0)]),t("td",null,[s.$page.props.apagar_consulta?(a(),u(l(v),{key:0,class:"delete",href:"/delete/consulta/"+o.identificacao},{default:d(()=>e[7]||(e[7]=[y("X")])),_:2},1032,["href"])):i("",!0)])]))),128))])])]),f.value?(a(),m("div",T,[t("div",A,[e[11]||(e[11]=t("h1",null,"Motivo Cancelamento",-1)),e[12]||(e[12]=t("br",null,null,-1)),t("form",{onSubmit:e[3]||(e[3]=p(o=>l(r).post("/cancelar/consulta"),["prevent"]))},[t("div",H,[h(t("input",{"onUpdate:modelValue":e[2]||(e[2]=o=>l(r).motivo=o),type:"text",id:"motivo",placeholder:"Motivo Cancelamento"},null,512),[[k,l(r).motivo]])]),e[9]||(e[9]=t("br",null,null,-1)),e[10]||(e[10]=t("button",{id:"salvar",type:"submit"},"Salvar",-1)),t("button",{id:"fechar",type:"button",onClick:p(M,["prevent"])},"Fechar")],32)])])):i("",!0)]),_:1})}}},q=S(P,[["__scopeId","data-v-1b36d00d"]]);export{q as default};
