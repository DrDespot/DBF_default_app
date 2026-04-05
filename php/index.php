<?php
include 'db.php';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create'])) {
        $stmt = $pdo->prepare("INSERT INTO items (name) VALUES (:name)");
        $stmt->execute(['name' => $_POST['name']]);
    } elseif (isset($_POST['update'])) {
        $stmt = $pdo->prepare("UPDATE items SET name = :name WHERE id = :id");
        $stmt->execute(['name' => $_POST['name'], 'id' => $_POST['id']]);
    } elseif (isset($_POST['delete'])) {
        $stmt = $pdo->prepare("DELETE FROM items WHERE id = :id");
        $stmt->execute(['id' => $_POST['id']]);
    }
}

// Fetch all items
$items = $pdo->query("SELECT * FROM items ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple CRUD</title>
</head>
<body>
<h1>Items</h1>

<!-- Create form -->
<form method="post">
    <input type="text" name="name" placeholder="Item name" required>
    <button type="submit" name="create">Add Item</button>
</form>

<hr>

<!-- Items table -->
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Created</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($items as $item): ?>
        <tr>
            <form method="post">
                <td><?= $item['id'] ?></td>
                <td><input type="text" name="name" value="<?= htmlspecialchars($item['name']) ?>"></td>
                <td><?= $item['created_at'] ?></td>
                <td>
                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                    <button type="submit" name="update">Update</button>
                    <button type="submit" name="delete">Delete</button>
                </td>
            </form>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
