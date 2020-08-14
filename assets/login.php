<?php include_once "assets/includes/top.php" ?>

    <main id="user">
        <section class="form">
            <a href="/"><img src="images/danirepetti-aulainglespinheiros.png" alt="Dani Repetti Aulas Inglês Particular Pinheiros" class="logo"></a>
            <h3>Entre e aproveite a Metodologia da Dani Repetti:</h3>
            <hr>
            <form action="/?login" method="post" enctype="multipart/form-data">
                <div class="field-deck">
                    <div class="field">
                        <label for="email"><b>E-mail</b></label>
                        <input type="email" placeholder="Informe seu E-mail" name="email" required>
                    </div>

                    <div class="field">
                        <label for="psw"><b>Senha</b></label>
                        <input type="password" placeholder="Informe sua senha" name="psw" required>                    
                    </div>
                </div>
                <button type="submit" class="button signupbtn">Entrar</button>
                <a href="/" class="button cancelbtn">Voltar</a>
                <p class="direction">Ainda não tem cadastro? <a href="/?register" class="cadlog">CLIQUE AQUI</a> e cadastre-se!</p>
            </form>
        </section>    
    </main>

<?php include_once "assets/includes/bottom.php" ?>