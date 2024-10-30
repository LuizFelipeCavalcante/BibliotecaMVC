<!-- views/books/index.php -->
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
    <title>Biblioteca - Lista de Usuários</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Lista de Usuários</h1>
        
        <?php if (isset($successMessage)): ?>
            <div class="alert alert-success">
                <?php echo htmlspecialchars($successMessage); ?>
            </div>
        <?php endif; ?>

        <div class="d-flex justify-content-between mb-3">
            <form class="d-flex" method="GET" action="">
                <input type="text" name="search" class="form-control me-2" placeholder="Pesquisar livro..." 
                       value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button type="submit" class="btn btn-primary me-2">Buscar</button>
                <a href="../../Controller/BookController.php?action=readall_books" class="btn btn-success">Livros</a>
            </form>
            <a href="createUsuario" class="btn btn-success">Novo Usuário</a>
        </div>
            <?php $users = $_SESSION['allusers'] ?>
        <?php if (!empty($users)): ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Senha</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($user['id']); ?></td>
                                <td><?php echo htmlspecialchars($user['nome']); ?></td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td><?php echo htmlspecialchars($user['telefone']); ?></td>
                                <td><?php echo htmlspecialchars($user['senha']); ?></td>

                                
                                <td>
                                    <div class="btn-group">
                                        
                                        <a href="../../Controller/UserController?action=read_user&id=<?php echo htmlspecialchars($user['id']); ?>"
                                           class="btn btn-sm btn-warning me-2">Editar</a>
                                        <form method="POST" action="../../Controller/UserController?action=delete_user&id=<?php echo htmlspecialchars($user['id']); ?>" 
                                              style="display: inline;" 
                                              onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');">
                                            <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info">
                Nenhum usuário encontrado.
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>