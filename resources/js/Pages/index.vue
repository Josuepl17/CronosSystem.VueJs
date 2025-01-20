<template lang="">
<div id="conteiner-Geral">
            <nav>
                <div id="texto">
                    <img style="width: 200px;" src="/images/CronosSystem.png" alt="" />
                </div>
                <div id="links">
                    <a href="#">Sobre-Nos</a>
                    <a href="#">Suporte</a>
                    <a href="/form/verificar/consulta">Verificar Consulta</a>
                    <a href="/dash">Entre Ou Cadastre-se</a>
                </div>
            </nav>

            <div id="conteiner">
                <div class="card">
                    <h2>Gerenciamento de Consultas</h2>
                    <p>
                        Facilite a rotina do seu consultório! Nosso software
                        permite agendamento e organização de consultas com
                        rapidez e eficiência. Visualize compromissos de forma
                        intuitiva, reduza erros e garanta um atendimento
                        impecável para seus pacientes.
                    </p>
                </div>
                <div class="card">
                    <h2>Acompanhamento Médico com Anexo de Documentos</h2>
                    <p>
                        Centralize todas as informações do paciente em um só
                        lugar! Com nosso sistema, médicos podem registrar o
                        histórico de atendimento, anexar exames, laudos e
                        documentos importantes, proporcionando um acompanhamento
                        completo e seguro.
                    </p>
                </div>
                <div class="card">
                    <h2>Prescrição de Medicamentos</h2>
                    <p>
                        Diga adeus às receitas manuais! Nossa ferramenta
                        possibilita a emissão de prescrições de forma prática e
                        personalizada, com acesso a uma base de medicamentos
                        atualizada. Mais agilidade para o médico e mais
                        segurança para o paciente.
                    </p>
                </div>
            </div>
        </div>
</template>

<script setup>
</script>

<style scoped>
    :root {
                --azul-escuro: #012841;
                --azul-claro: #014552;
                --cinza-escuro: #212529;
            }

            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
                font-family: "Arial", sans-serif;
            }

            #conteiner-Geral {
                min-height: 100vh;
                width: 100%;
                background-color: var(--azul-escuro);
                overflow-x: hidden;
            }

            nav {
                display: flex;
                justify-content: space-between;
                align-items: center;
                min-height: 10vh;
                background-color: rgba(0, 0, 0, 0.5);
                flex-wrap: wrap;
            }

            #links {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                justify-content: center;
                align-items: center;
            }

            @media (max-width: 768px) {
                            img {
                                display: none;
                            }

                            nav{
                                min-height: 20vh;
                            }
                        }
            



            nav a {
                text-decoration: none;
                color: white;
                padding: 8px 12px;
                border: 1px solid rgba(255, 255, 255, 0.5);
                border-radius: 5px;
                transition: background-color 0.3s, color 0.3s;
               
            }

            nav a:hover {
                background-color: white;
                color: black;
            }

            #conteiner {
                display: flex;
                justify-content: center;
                align-items: center;
                flex-wrap: wrap;
                gap: 20px;
                padding: 20px;
                min-height: calc(100vh - 80px);
            }

            .card {
                width: 300px;
                min-height: 356px;
                background-color: rgba(255, 255, 255, 0.8);
                border-radius: 10px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                padding: 20px;
                transition: transform 0.3s, box-shadow 0.3s;
                margin: 10px;
            }

            .card:hover {
                transform: translateY(-10px);
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            }

            .card h2 {
                font-size: 1.5em;
                margin-bottom: 15px;
                color: rgba(0, 0, 0, 0.8);
            }

            .card p {
                font-size: 1em;
                color: rgba(0, 0, 0, 0.7);
                line-height: 1.6;
            }

            #texto h3 {
                color: white;
                font-size: 1.2em;
            }

            #texto img {
                max-width: 200px;
                width: 100%;
                height: auto;
            }

            @media (max-width: 768px) {
                nav {
                    flex-direction: column;
                    text-align: center;
                    padding: 15px;
                }

                #links {
                    margin-top: 0;
                    align-items: center;
                }

                #texto {
                    margin-bottom: 15px;
                }

                .card {
                    width: 100%;
                    max-width: 300px;
                }

                #texto img {
                    max-width: 150px;
                }
            }
</style>