<template lang="">
<div id="conteiner-Geral">
            <nav>
                <div id="texto">
                    <img src="/images/CronosSystem.png" alt="" />
                </div>
                <div id="links">
                    <a href="https://wa.me/5527996550967" target="_blank">Suporte</a>
                    <a href="/form/verificar/consulta">Verificar Consulta</a>
                    <a href="/dash">Faça Login</a>
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
                        personalizada, Mais agilidade para o médico e mais
                        segurança para o paciente.
                    </p>
                </div>
            </div>
        </div>
</template>

<script setup>
const scrollToElement = (elementId) => {
    const element = document.getElementById(elementId);
    if (element) {
        element.scrollIntoView({ behavior: 'smooth' });
    }
};
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
                scroll-behavior: smooth;
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
                flex-wrap: wrap;
                background: var(--azul-escuro);
            }

            #links {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                justify-content: center;
                align-items: center;
                margin-right: 30px;
            }

            @media (max-width: 768px) {
                            img {
                                display: none;
                            }

                            nav{
                                min-height: 04vh;
                            }
                        }
            
            nav a {
                text-decoration: none;
                color: white;
                padding: 8px 12px;

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
                width: 18%;
                margin-left: 35px;
                margin-top: 10px;
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