    <?php
        if(isset($_SESSION['modal'])){
            if($_SESSION['modal'] == "cadastro"){
                echo "<script>modalRegister.style.display = 'block';</script>";
                unset($_SESSION['modal']);
            }
        }
    ?>

</body>
</html>