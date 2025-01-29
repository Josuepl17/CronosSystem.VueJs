<template lang="">
<div id="conteiner-Geral">
            <nav>
                <div id="texto">
                    <img style="width: 200px;" src="/images/CronosSystem.png" alt="" />
                </div>
                <div id="links">
                    <a href="#sobre-nos" @click.prevent="scrollToElement('sobre-nos')">Sobre-Nos</a>
                    <a href="#">Suporte</a>
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

            <div id="sobre-nos" class="sobre-nos">
                <h2>Sobre Nós</h2>
                <p>
                    A Cronos System é uma empresa inovadora especializada em soluções tecnológicas para a área da saúde. 
                    Fundada com a missão de transformar a gestão médica, desenvolvemos sistemas intuitivos e eficientes 
                    que facilitam o dia a dia de clínicas e consultórios.
                </p>
                <p>
                    Nossa equipe é composta por profissionais apaixonados por tecnologia e comprometidos com a excelência. 
                    Trabalhamos constantemente para oferecer as melhores soluções, garantindo praticidade, segurança e 
                    eficiência para nossos clientes.
                </p>
                <p>
                    Com anos de experiência no mercado, nos orgulhamos de contribuir para a modernização do setor médico, 
                    sempre priorizando a satisfação de nossos usuários e a qualidade de nossos serviços.
                </p>
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

            .sobre-nos {
                padding: 40px;
                background-color: rgba(255, 255, 255, 0.9);
                margin: 20px;
                border-radius: 10px;
                text-align: center;
                width: 50%;
                margin: 0 auto;
            }

            .sobre-nos h2 {
                color: var(--azul-escuro);
                margin-bottom: 20px;
                font-size: 2em;
            }

            .sobre-nos p {
                color: var(--cinza-escuro);
                margin-bottom: 15px;
                line-height: 1.6;
                font-size: 1.1em;
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

                .sobre-nos {
                    margin: 10px;
                    padding: 20px;
                }
            }
</style>