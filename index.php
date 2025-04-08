<?php

$connection = new PDO(
    'mysql:host=mysql-8.0;dbname=catalog;charset=utf8',
    'root',
    ''
);
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$query = "
    SELECT 
        p.id,
        p.name AS product_name,
        p.price,
        c.name AS category_name,
        s.remainder
    FROM products p
    JOIN categories c ON p.category_id = c.id
    JOIN remainder s ON p.id = s.product_id
";
$stmt = $connection->query($query);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Каталог товаров</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <div class="card p-4 mb-4">
        <h1 class="h3 mb-0"> Товары в наличии</h1>
    </div>

    <div class="card p-4">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Товар</th>
                <th>Категория</th>
                <th>Стоимость</th>
                <th>Остаток</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($products as $product): ?>
                <tr>
                    <td>
                        <?= htmlspecialchars($product['product_name']) ?>
                    </td>
                    <td>
                        <?= htmlspecialchars($product['category_name']) ?>
                    </td>
                    <td>
                        <?= $product['price'] ?> ₽
                    </td>
                    <td>
                        <?= $product['remainder'] ?> шт.
                    </td>
                </tr>
            <?php
            endforeach; ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="text-muted">
                Показано <?= count($products) ?> товаров
            </div>
        </div>
    </div>
</div>
</body>
</html>
