import{_ as b,o as h,T as v,a as _,c as r,w as n,b as a,d as e,e as k,f as d,u as o,i as u,j as x,k as w,v as g,g as f,h as B,t as i,l as m,F as M}from"./app-hUv39q4F.js";const N={id:"opcoes-conteudo"},V={id:"tabela"},C={class:"minimal-table"},P={__name:"Pacientes",props:{pacientes:Array},setup(c){h(()=>{document.title="Pacientes"});const l=v({pesquisa:""});return(p,t)=>{const y=_("Layout");return a(),r(y,null,{conteudo:n(()=>[e("div",N,[k(o(u),{id:"botao_inserir_superior",href:"/form/paciente"},{default:n(()=>t[2]||(t[2]=[d("Inserir")])),_:1}),e("form",{onSubmit:t[1]||(t[1]=x(s=>o(l).post("/busca/atendentes"),["prevent"]))},[w(e("input",{"onUpdate:modelValue":t[0]||(t[0]=s=>o(l).pesquisa=s),type:"text",placeholder:"Search..."},null,512),[[g,o(l).pesquisa]]),t[3]||(t[3]=e("button",{type:"submit"},"Busca",-1))],32)]),e("div",V,[e("table",C,[t[6]||(t[6]=e("thead",null,[e("tr",null,[e("th",null,"Name"),e("th",null,"Email"),e("th",null,"Telefone"),e("th",null,"CPF"),e("th",{style:{width:"20px"}},"#"),e("th",{style:{width:"20px"}},"#")])],-1)),e("tbody",null,[(a(!0),f(M,null,B(c.pacientes,s=>(a(),f("tr",{key:s.id},[e("td",null,i(s.nome),1),e("td",null,i(s.email),1),e("td",null,i(s.telefone),1),e("td",null,i(s.cpf),1),e("td",null,[p.$page.props.autorizaMedico?(a(),r(o(u),{key:0,id:"inserir",href:"/detalhes/paciente/"+s.identificacao},{default:n(()=>t[4]||(t[4]=[d("Inserir")])),_:2},1032,["href"])):m("",!0)]),e("td",null,[p.$page.props.autorizaMedico?(a(),r(o(u),{key:0,id:"inserir",href:"/editar/paciente/"+s.identificacao},{default:n(()=>t[5]||(t[5]=[d("Editar")])),_:2},1032,["href"])):m("",!0)])]))),128))])])])]),_:1})}}},q=b(P,[["__scopeId","data-v-d818ba8c"]]);export{q as default};
