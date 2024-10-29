<!-- views/books/create.php -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca - Cadastrar Novo Livro</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h2 class="mb-0">Cadastrar Novo Livro</h2>
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

                        <form method="POST" action="../../Controller/BookController.php?action=create_book"
                            enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="title" class="form-label">Título *</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>

                            <div class="mb-3">
                                <label for="author" class="form-label">Autor *</label>
                                <input type="text" class="form-control" id="author" name="author" required>
                            </div>


                            <div class="mb-3">
                                <label for="publisher" class="form-label">Genero</label>
                                <input type="text" class="form-control" id="genero" name="genero">
                            </div>
                            <div class="mb-3">
                                <label for="publisher" class="form-label">Estoque</label>
                                <input type="text" class="form-control" id="estoque" name="estoque">
                            </div>


                            <div class="mb-3">
                                <label for="edition" class="form-label">Data entrada</label>
                                <input type="date" class="form-control" id="dataEntrada" name="dataEntrada">
                            </div>

                            <div class="mb-3">
                                <label for="edition" class="form-label">Data saida</label>
                                <input type="date" class="form-control" id="dataSaida" name="dataSaida">
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="/books" class="btn btn-secondary">Voltar</a>
                                <button type="submit" class="btn btn-primary">Cadastrar Livro</button>
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