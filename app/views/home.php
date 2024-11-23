<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Sistema de Vendas' ?></title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <header>
        <h1>Minha Loja de Veículos</h1>
        <nav>
            <a href="/veiculos">Veículos</a>
            <a href="/veiculos/create">Adicionar Veículo</a>
        </nav>
    </header>
    <main>
        <?= $content ?>
    </main>
    <footer>
        <p>&copy; 2024 Minha Loja de Veículos</p>
    </footer>
</body>
</html>
