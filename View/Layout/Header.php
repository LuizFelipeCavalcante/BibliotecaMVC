<header class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php"><img src="../../img/logo01.png" alt="Logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Alterna navegação">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link active" href="">Home <span class="sr-only">(Página atual)</span></a>
            <?php if (!isset($_SESSION['customer'])) {
                echo '<a class="nav-item nav-link" href="">Login</a>';
            }
            ?>

            <?php
            if (!isset($_SESSION['customer_id'])) {
                echo '<a class="nav-item nav-link"><b>Deslogado</b></a>';
            } else {
                echo '<a class="nav-item nav-link" href="../../Controller/BookController?action=readall_books">Livros</a>
                <a class="nav-item nav-link" href="../Logout">Sair</a>
                <a class="nav-item nav-link"><b>' . $_SESSION['user_name'] . '</b></a>';
            }
            ?>
        </div>
    </div>
</header>