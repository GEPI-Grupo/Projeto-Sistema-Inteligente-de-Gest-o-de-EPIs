<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/index.css">

    <title>Meu Portfólio</title>

</head>

<body>

    <!-- CABEÇALHO -->
    <header>

        <nav class="navbar">

            <h2 class="logo">
                Meu Portfólio
            </h2>

            <ul class="menu">

                <li><a href="#inicio">Início</a></li>

                <li><a href="#sobre">Sobre</a> </li>

                <li><a href="#habilidades">Habilidades</a> </li>

                <li><a href="#projetos">Projetos</a></li>

                <li><a href="#contato">Contato</a></li>

            </ul>

        </nav>

    </header>


    <main>

        <!-- INÍCIO -->
        <section id="inicio" class="inicio">

            <div class="inicio-conteudo">

                <p class="saudacao">Olá! Eu sou</p>

                <h1>Micael Álvaro</h1>

                <h2>Desenvolvedor de Sistemas</h2>

                <p>
                    Sou estudante de Desenvolvimento de Sistemas, apaixonado por tecnologia
                    e programação. Tenho conhecimentos em HTML, CSS, JavaScript, C e Python,
                    e estou sempre em busca de novos aprendizados e desafios.
                </p>

                <a href="#projetos" class="botao"> Ver meus Projetos </a>

            </div>

        </section>


        <!-- SOBRE MIM -->
        <section id="sobre" class="secao">

            <h2 class="titulo-secao"> Sobre mim </h2>

            <p class="subtitulo-secao">
                Conheça um pouco mais sobre mim
            </p>

            <div class="sobre-conteudo">

                <div class="foto">
                    JS
                </div>

                <div class="sobre-texto">

                    <h3>
                        Quem sou eu?
                    </h3>

                    <p>
                        Meu nome é Micael Álvaro e sou estudante de Desenvolvimento de Sistemas.
                        Sou apaixonado por tecnologia e tenho interesse em programação e
                        desenvolvimento de aplicações.
                    </p>

                    <p>
                        Atualmente, estou aprimorando meus conhecimentos em HTML, CSS,
                        JavaScript, C e Python, colocando em prática o que aprendo por meio
                        de projetos e atividades durante o curso.
                    </p>

                    <p>
                        Meu objetivo é continuar evoluindo na área de tecnologia, adquirir
                        experiência profissional e me tornar um desenvolvedor cada vez mais
                        preparado para novos desafios.
                    </p>

                </div>

            </div>

        </section>


        <!-- HABILIDADES -->
        <section id="habilidades" class="secao secao-destaque">

            <h2 class="titulo-secao">
                Minhas habilidades
            </h2>

            <p class="subtitulo-secao">
                Algumas tecnologias que estou estudando:
            </p>

            <div class="lista-habilidades">

                <div class="habilidade">
                    HTML
                </div>

                <div class="habilidade">
                    CSS
                </div>

                <div class="habilidade">
                    JavaScript
                </div>

                <div class="habilidade">
                    PHP
                </div>

                <div class="habilidade">
                    Python
                </div>

                <div class="habilidade">
                    C
                </div>

                 <div class="habilidade">
                    JSON
                </div>

            </div>

        </section>


        <!-- PROJETOS -->
        <section id="projetos" class="secao">

            <h2 class="titulo-secao">
                Meus Projetos
            </h2>

            <p class="subtitulo-secao">
                Alguns projetos desenvolvidos durante as aulas.
            </p>


            <div class="projetos-container">


                <!-- PROJETO 01 -->
                <div class="projeto-card">

                    <div class="projeto-numero">
                        01
                    </div>

                    <h3>
                        Verificação de Idade
                    </h3>

                    <p>
                        Sistema desenvolvido para praticar formulários e
                        manipulação de dados.
                    </p>

                    <div class="tecnologias">

                        <span>
                            HTML
                        </span>

                        <span>
                            CSS
                        </span>

                        <span>
                            PHP
                        </span>

                    </div>

                    <a href="projetos/idade.php" class="link-projeto">
                        Ver projeto ➙
                    </a>

                </div>


                <!-- PROJETO 02 -->
                <div class="projeto-card">

                    <div class="projeto-numero">
                        02
                    </div>

                    <h3>
                        Notas
                    </h3>

                    <p>
                        Aplicação criada para trabalhar com notas, médias
                        e estruturas condicionais.
                    </p>

                    <div class="tecnologias">

                        <span>
                            HTML
                        </span>

                        <span>
                            CSS
                        </span>

                        <span>
                            PHP
                        </span>

                    </div>

                    <a href="projetos/notas.php" class="link-projeto">
                        Ver projeto ➙
                    </a>

                </div>


                <!-- PROJETO 03 -->
                <div class="projeto-card">

                    <div class="projeto-numero">
                        03
                    </div>

                    <h3>
                        Cadastro de Jogos
                    </h3>

                    <p>
                        Sistema desenvolvido para cadastrar jogos,
                        armazenar informações e exibir os jogos cadastrados.
                    </p>

                    <div class="tecnologias">

                        <span>
                            HTML
                        </span>

                        <span>
                            CSS
                        </span>

                        <span>
                            PHP
                        </span>

                        <span>
                            MySQL
                        </span>

                    </div>

                    <a href="projetos/jogos.php" class="link-projeto">
                        Ver projeto ➙
                    </a>

                </div>

                <!-- PROJETO 04 -->
                <div class="projeto-card">

                    <div class="projeto-numero">
                        04
                    </div>

                    <h3>
                        Help Desk
                    </h3>

                    <p> Sistema de gerenciamento de chamados técnicos, 
                        desenvolvido para registrar, consultar, 
                        atualizar e excluir solicitações de suporte, 
                        com controle de status e relatório de atendimentos utilizando PHP e JSON. </p>

                    <div class="tecnologias">

                        <span>
                            HTML
                        </span>

                        <span>
                            CSS
                        </span>

                        <span>
                            PHP
                        </span>

                        <span>
                            JSON
                        </span>

                    </div>

                    <a href="projetos/helpdesk.php" class="link-projeto">
                        Ver projeto ➙
                    </a>

                </div>


            </div>

        </section>


        <!-- CONTATO -->
        <section id="contato" class="secao secao-destaque">

            <h2 class="titulo-secao">
                Contato
            </h2>

            <p class="subtitulo-secao">
                Quer entrar em contato comigo?
            </p>


            <div class="contato-container">


                <!-- WHATSAPP -->
                <div class="contato-item">

                    <h3>
                        WhatsApp
                    </h3>

                    <p>
                        +55 41 3331-9999
                    </p>

                </div>


                <!-- GITHUB -->
                <div class="contato-item">

                    <h3>
                        GitHub
                    </h3>

                    <p>
                        github.com/micaellima-ai
                    </p>

                </div>


                <!-- LINKEDIN -->
                <div class="contato-item">

                    <h3>
                        LinkedIn
                    </h3>

                    <p>
                        linkedin.com/in/micael-baraneki-4b8610392
                    </p>

                </div>


            </div>

        </section>

    </main>


    <!-- RODAPÉ -->
    <footer class="footer">

        <p>
            Desenvolvido por

            <a href="https://micael315.devlook.xyz">
                Micael Álvaro
            </a>

            ● 2026
        </p>

    </footer>

</body>

</html>