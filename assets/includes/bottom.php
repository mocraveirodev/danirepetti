    <?php
        if(!is_null($_SESSION['modal'])){
            echo "<script>modalInfo.style.display = 'block';</script>";
            unset($_SESSION['modal']);
        }

        unset($_SESSION['change']);
        unset($_SESSION['error']);
    ?>

</body>
</html>