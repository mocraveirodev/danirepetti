<?php include_once "assets/includes/top.php";?>

    <main id="user">
        <section class="form">
            <a href="/"><img src="images/danirepetti-aulainglespinheiros.png" alt="Dani Repetti Aulas Inglês Particular Pinheiros" class="logo"></a>
            <h3>Alteração de Senha:</h3>
            <hr>
            <p class="erro"><?php if(isset($_SESSION['error'])) echo $_SESSION['error'] ?></p>
            <form action="/changepassword" method="post" enctype="multipart/form-data">
                <?php if (isset($_SESSION['change'])): ?>
                    <input type="hidden" name="email" value="<?= $_SESSION['change'] ?>">
                    <div class="field-deck">
                        <div class="field">
                            <label for="psw"><b>Nova Senha</b></label>
                            <input type="password" placeholder="Informe a nova senha" name="psw" required>                    
                        </div>

                        <div class="field">
                            <label for="confpsw"><b>Confirme a nova Senha</b></label>
                            <input type="password" placeholder="Confirme a nova senha" name="confpsw" required>                    
                        </div>
                    </div>
                <?php else: ?>
                    <div class="field-change">
                        <label for="email"><b>E-mail de cadastro</b></label>
                        <input type="email" placeholder="Informe o E-mail de cadastro" name="email" required>
                    </div>
                <?php endif; ?>
                    <button type="submit" class="button signupbtn">Alterar Senha</button>
                    <a href="/" class="button cancelbtn">Página Inicial</a>
                    <p class="direction">Ainda não tem cadastro? <a href="/register" class="cadlog">CLIQUE AQUI</a> e cadastre-se!</p>
                    <p class="direction">Lembrou a senha? <a href="/login" class="cadlog">CLIQUE AQUI</a> e entre!</p>
            </form>
        </section>

        <?php include_once "assets/includes/modal.php"; ?>
    </main>

    <script src="assets/js/modal.js"></script>

    <?php include_once "assets/includes/bottom.php"; ?>