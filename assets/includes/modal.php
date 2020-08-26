    <section id="modal">
        <div id="modalInfo" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close" onclick="this.style.display='none'">&times;</span>
                    <img src="images/danirepetti-aulainglespinheiros.png" alt="Dani Repetti Aulas Inglês Particular Pinheiros" class="logo-modal">
                </div>
                <div class="modal-body">
                    <p><?= $_SESSION['modal-title'] ?></p>
                    <p><?= $_SESSION['modal-text'] ?></p>
                </div>
                <div class="modal-footer">
                    <?php if ($_SESSION['modal'] == "psw"): ?>
                        <a href="/" class="button modalbtn">Entrar</a>
                    <?php else: ?>
                        <a href="/" class="button modalbtn">Voltar para Página Principal</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>