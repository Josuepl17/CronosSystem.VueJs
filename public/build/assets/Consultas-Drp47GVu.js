import{_ as M,T as y,r as _,o as S,a as F,c as N,w as a,b as i,d as t,e as m,f as p,u as l,i as c,j as d,k as h,v as C,g as f,h as V,t as n,n as B,F as X,l as D}from"./app-AjzsqkRK.js";const I={id:"opcoes-conteudo"},L={id:"tabela"},T={class:"minimal-table"},$=["onClick"],A={key:0,class:"modal-sobreposto"},H={class:"modal-content"},P={class:"form-group"},U={__name:"Consultas",props:{consultas:Array,date:String},setup(v){const k=v,s=y({identificacao:"",motivo:""}),r=y({date:k.date||""}),u=_(!1),w=b=>{u.value=!0,s.identificacao=b},x=()=>{u.value=!1};return S(()=>{document.title="Consultas"}),(b,e)=>{const g=F("Layout");return i(),N(g,null,{conteudo:a(()=>[t("div",I,[m(l(c),{id:"botao_inserir_superior",href:"/form/consultas"},{default:a(()=>e[4]||(e[4]=[p("Inserir")])),_:1}),t("form",{onSubmit:e[1]||(e[1]=d(o=>l(r).post("/filtro/consulta"),["prevent"]))},[h(t("input",{"onUpdate:modelValue":e[0]||(e[0]=o=>l(r).date=o),type:"date",name:"date",id:"date"},null,512),[[C,l(r).date]]),e[5]||(e[5]=t("input",{type:"submit",value:"Pesquisar"},null,-1))],32)]),t("div",L,[t("table",T,[e[8]||(e[8]=t("thead",null,[t("tr",{style:{position:"sticky",top:"0","background-color":"white"}},[t("th",null,"#"),t("th",null,"Nome Paciente"),t("th",null,"Nome Medico"),t("th",null,"Status"),t("th",null,"Data Consulta"),t("th",null,"Hora Inicial"),t("th",null,"Hora Final"),t("th",null,"Motivo Status"),t("th",{style:{width:"40px"}},"X"),t("th",{style:{width:"40px"}},"X"),t("th",{style:{width:"20px"}},"X")])],-1)),t("tbody",null,[(i(!0),f(X,null,V(v.consultas,o=>(i(),f("tr",{key:o.id},[t("td",null,n(o.id),1),t("td",null,n(o.nome_paciente),1),t("td",null,n(o.nome_medico),1),t("td",{style:{color:"white"},class:B({"status-agendado":o.status==="Agendado","status-cancelado":o.status==="Cancelado","status-concluido":o.status==="Concluido"})},n(o.status),3),t("td",null,n(o.date),1),t("td",null,n(o.horainicial),1),t("td",null,n(o.horafinal),1),t("td",null,n(o.motivo_status),1),t("td",null,[m(l(c),{class:"status-concluido",href:"/concluir/consulta/"+o.identificacao},{default:a(()=>e[6]||(e[6]=[p("Concluir")])),_:2},1032,["href"])]),t("td",null,[t("a",{class:"status-cancelado",href:"#",onClick:d(j=>w(o.identificacao),["prevent"])},"Cancelar",8,$)]),t("td",null,[m(l(c),{class:"delete",href:"/delete/consulta/"+o.identificacao},{default:a(()=>e[7]||(e[7]=[p("X")])),_:2},1032,["href"])])]))),128))])])]),u.value?(i(),f("div",A,[t("div",H,[e[11]||(e[11]=t("h1",null,"Motivo Cancelamento",-1)),e[12]||(e[12]=t("br",null,null,-1)),t("form",{onSubmit:e[3]||(e[3]=d(o=>l(s).post("/cancelar/consulta"),["prevent"]))},[t("div",P,[h(t("input",{"onUpdate:modelValue":e[2]||(e[2]=o=>l(s).motivo=o),type:"text",id:"motivo",placeholder:"Motivo Cancelamento"},null,512),[[C,l(s).motivo]])]),e[9]||(e[9]=t("br",null,null,-1)),e[10]||(e[10]=t("button",{id:"salvar",type:"submit"},"Salvar",-1)),t("button",{id:"fechar",type:"button",onClick:d(x,["prevent"])},"Fechar")],32)])])):D("",!0)]),_:1})}}},z=M(U,[["__scopeId","data-v-25931ecd"]]);export{z as default};
