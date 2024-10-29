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

                        <form method="POST" action="/books/store" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="title" class="form-label">Título *</label>
                                <input type="text" class="form-control" id="title" name="title" 
                                       value="<?php echo isset($old['title']) ? htmlspecialchars($old['title']) : ''; ?>" 
                                       required>
                            </div>

                            <div class="mb-3">
                                <label for="author" class="form-label">Autor *</label>
                                <input type="text" class="form-control" id="author" name="author" 
                                       value="<?php echo isset($old['author']) ? htmlspecialchars($old['author']) : ''; ?>" 
                                       required>
                            </div>

                            <div class="mb-3">
                                <label for="isbn" class="form-label">ISBN *</label>
                                <input type="text" class="form-control" id="isbn" name="isbn" 
                                       value="<?php echo isset($old['isbn']) ? htmlspecialchars($old['isbn']) : ''; ?>" 
                                       required>
                                <div class="form-text">Formato: ISBN-13 (exemplo: 978-0-123456-47-2)</div>
                            </div>

                            <div class="mb-3">
                                <label for="publisher" class="form-label">Editora</label>
                                <input type="text" class="form-control" id="publisher" name="publisher" 
                                       value="<?php echo isset($old['publisher']) ? htmlspecialchars($old['publisher']) : ''; ?>">
                            </div>

                            <div class="mb-3">
                                <label for="publication_year" class="form-label">Ano de Publicação</label>
                                <input type="number" class="form-control" id="publication_year" name="publication_year" 
                                       min="1000" max="<?php echo date('Y'); ?>" 
                                       value="<?php echo isset($old['publication_year']) ? htmlspecialchars($old['publication_year']) : ''; ?>">
                            </div>

                            <div class="mb-3">
                                <label for="edition" class="form-label">Edição</label>
                                <input type="text" class="form-control" id="edition" name="edition" 
                                       value="<?php echo isset($old['edition']) ? htmlspecialchars($old['edition']) : ''; ?>">
                            </div>

                            <div class="mb-3">
                                <label for="pages" class="form-label">Número de Páginas</label>
                                <input type="number" class="form-control" id="pages" name="pages" min="1" 
                                       value="<?php echo isset($old['pages']) ? htmlspecialchars($old['pages']) : ''; ?>">
                            </div>

                            <div class="mb-3">
                                <label for="category" class="form-label">Categoria</label>
                                <select class="form-select" id="category" name="category">
                                    <option value="">Selecione uma categoria</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?php echo htmlspecialchars($category['id']); ?>"
                                            <?php echo (isset($old['category']) && $old['category'] == $category['id']) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($category['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Descrição</label>
                                <textarea class="form-control" id="description" name="description" rows="3"><?php 
                                    echo isset($old['description']) ? htmlspecialchars($old['description']) : ''; 
                                ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="cover_image" class="form-label">Imagem da Capa</label>
                                <input type="file" class="form-control" id="cover_image" name="cover_image" 
                                       accept="image/jpeg,image/png">
                                <div class="form-text">Formatos aceitos: JPG, PNG. Tamanho máximo: 2MB</div>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="available" name="available" value="1"
                                       <?php echo (isset($old['available']) && $old['available']) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="available">Disponível para empréstimo</label>
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