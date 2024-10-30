<!-- views/users/create.php -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca - Cadastrar Novo Usuário</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h2 class="mb-0">Atualizar Usuário</h2>
                    </div>
                    <div class="card-body">
                        <?php if (isset($errors) && !empty($errors)): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php foreach ($errors as $error): ?>
                                        <li><?php echo htmlspecialchars($error); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <?php $user = $_SESSION['oneuser'] ?>
                        <form method="POST" action="../../Controller/UserController.php?action=update_user&id=<?php echo htmlspecialchars($user['id']);?>"
                            enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome *</label>
                                <input type="text" class="form-control" id="nome" name="nome" 
                                value="<?php echo $user['nome']; ?>">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="text" class="form-control" id="email" name="email" 
                                value="<?php echo $user['email']; ?>">
                            </div>

                            <div class="mb-3">
                                <label for="telefone" class="form-label">Telefone *</label>
                                <input type="text" class="form-control" id="telefone" name="telefone"
                                value="<?php echo $user['telefone']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="senha" class="form-label">Senha *</label>
                                <input type="text" class="form-control" id="senha" name="senha"
                                value="<?php echo $user['senha']; ?>">
                            </div>



                            <div class="d-flex justify-content-between">
                                <a href="../../Controller/UserController.php?action=readall_users" class="btn btn-secondary">Voltar</a>
                                <button type="submit" class="btn btn-primary">Atualizar Usuário</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>