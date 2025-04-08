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

