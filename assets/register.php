<?php include_once "assets/includes/top.php" ?>

    <main id="user">
        <section class="form">
            <a href="/"><img src="images/danirepetti-aulainglespinheiros.png" alt="Dani Repetti Aulas Inglês Particular Pinheiros" class="logo"></a>
            <h3>Realize o pré-cadastro e conheça a Metodologia da Dani Repetti:</h3>
            <hr>
            <form action="/?register" method="post" enctype="multipart/form-data">
                <div class="field-deck">
                    <div class="field">
                        <label for="name"><b>Nome</b></label>
                        <input type="text" placeholder="Informe seu Nome" name="name" required>
                    </div>    
                    
                    <div class="field">
                        <label for="lastname"><b>Sobrenome</b></label>
                        <input type="text" placeholder="Informe seu Sobrenome" name="lastname" required>
                    </div>
                </div>

                <div class="field-deck">
                    <div class="field">
                        <label for="phone"><b>Telefone</b></label>
                        <input type="text" placeholder="+xx (xx) xxxxx-xxxx" name="phone" id="phone" maxlength="19" required>
                    </div>    
    
                    <div class="field">
                        <label for="company"><b>Empresa</b></label>
                        <input type="text" placeholder="Informe sua Empresa" name="company" required>                
                    </div>
                </div>

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
                <input value="student" name="profile" type="hidden" />
                <button type="submit" class="button signupbtn">Cadastrar</button>
                <a href="/" class="button cancelbtn">Voltar</a>
                <p class="direction">Já possui cadastro? <a href="/?login" class="cadlog">CLIQUE AQUI</a> e entre!</p>
            </form>
        </section>    
    </main>
    <?php include_once "assets/includes/modal.php"; ?>

    <script src="assets/js/modal.js"></script>
    <script>modalRegister.style.display = 'block';</script>

<?php include_once "assets/includes/bottom.php"; ?>