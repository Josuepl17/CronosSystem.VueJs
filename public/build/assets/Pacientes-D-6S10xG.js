import{_ as b,T as v,r as y,c as i,w as r,o as n,a as e,b as _,d as u,u as o,i as d,k as h,j as k,v as x,e as p,f as B,t as a,h as N,F as V}from"./app-ZdgCr1Xe.js";const w={id:"opcoes-conteudo"},C={id:"tabela"},T={class:"minimal-table"},g={__name:"Pacientes",props:{pacientes:Array},setup(m){const l=v({pesquisa:""});return(f,t)=>{const c=y("Layout");return n(),i(c,null,{conteudo:r(()=>[e("div",w,[_(o(d),{href:"/form/paciente"},{default:r(()=>t[2]||(t[2]=[u("Inserir")])),_:1}),e("form",{onSubmit:t[1]||(t[1]=h(s=>o(l).post("/busca/atendentes"),["prevent"]))},[k(e("input",{"onUpdate:modelValue":t[0]||(t[0]=s=>o(l).pesquisa=s),type:"text",placeholder:"Search..."},null,512),[[x,o(l).pesquisa]]),t[3]||(t[3]=e("button",{type:"submit"},"Busca",-1))],32)]),e("div",C,[e("table",T,[t[5]||(t[5]=e("thead",null,[e("tr",null,[e("th",null,"Name"),e("th",null,"Email"),e("th",null,"Telefone"),e("th",null,"CPF"),e("th",null,"#")])],-1)),e("tbody",null,[(n(!0),p(V,null,B(m.pacientes,s=>(n(),p("tr",{key:s.id},[e("td",null,a(s.nome),1),e("td",null,a(s.email),1),e("td",null,a(s.telefone),1),e("td",null,a(s.cpf),1),e("td",null,[f.$page.props.autorizaMedico?(n(),i(o(d),{key:0,id:"inserir",href:"/detalhes/paciente/"+s.identificacao},{default:r(()=>t[4]||(t[4]=[u("Inserir")])),_:2},1032,["href"])):N("",!0)])]))),128))])])])]),_:1})}}},F=b(g,[["__scopeId","data-v-137c83a2"]]);export{F as default};
