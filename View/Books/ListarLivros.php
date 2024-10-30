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
    <title>Biblioteca - Lista de Livros</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Lista de Livros</h1>
        
        <?php if (isset($successMessage)): ?>
            <div class="alert alert-success">
                <?php echo htmlspecialchars($successMessage); ?>
            </div>
        <?php endif; ?>

        <div class="d-flex justify-content-between mb-3">
            <form class="d-flex" method="GET" action="">
                <input type="text" name="search" class="form-control me-2" placeholder="Pesquisar livro..." 
                       value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>
            <a href="createLivros" class="btn btn-success">Novo Livro</a>
        </div>
            <?php $books = $_SESSION['allbooks'] ?>
        <?php if (!empty($books)): ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>nome</th>
                            <th>Autor</th>
                            <th>genero</th>
                            <th>estoque</th>
                            <th>dataEntrada</th>
                            <th>dataSaida</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($books as $book): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($book['id']); ?></td>
                                <td><?php echo htmlspecialchars($book['nome']); ?></td>
                                <td><?php echo htmlspecialchars($book['autor']); ?></td>
                                <td><?php echo htmlspecialchars($book['genero']); ?></td>
                                <td><?php echo htmlspecialchars($book['estoque']); ?></td>
                                <td><?php echo htmlspecialchars($book['dataEntrada']); ?></td>
                                <td><?php echo htmlspecialchars($book['dataSaida']); ?></td>
                                
                                <td>
                                    <div class="btn-group">
                                        
                                        <a href="../../Controller/BookController?action=read_book&id=<?php echo htmlspecialchars($book['id']); ?>"
                                           class="btn btn-sm btn-warning">Editar</a>
                                        <form method="POST" action="../../Controller/BookController?action=delete_book&id=<?php echo htmlspecialchars($book['id']); ?>" 
                                              style="display: inline;" 
                                              onsubmit="return confirm('Tem certeza que deseja excluir este livro?');">
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
                Nenhum livro encontrado.
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>