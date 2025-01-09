<?php
// Database connection (PDO)
$db = new PDO('mysql:host=localhost;dbname=bank_management', 'root', '');

// Pagination settings
$itemsPerPage = 2; // Number of rows per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page
$offset = ($page - 1) * $itemsPerPage;

// Fetch total rows for pagination
$totalRows = $db->query("SELECT COUNT(*) FROM transactions")->fetchColumn();
$totalPages = ceil($totalRows / $itemsPerPage);

// Fetch transactions for the current page
$stmt = $db->prepare("SELECT * FROM transactions ORDER BY created_at DESC LIMIT :limit OFFSET :offset");
$stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transactions</title>
    <style>
        .pagination a {
            margin: 0 5px;
            text-decoration: none;
            color: blue;
        }
        .pagination a.active {
            font-weight: bold;
            color: red;
        }
    </style>
</head>
<body>
    <h1>Transactions</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Account ID</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Beneficiary</th>
                <th>Created At</th>
                <th>Motif</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactions as $transaction): ?>
                <tr>
                    <td><?= htmlspecialchars($transaction['id_transaction']) ?></td>
                    <td><?= htmlspecialchars($transaction['account_id']) ?></td>
                    <td><?= htmlspecialchars($transaction['transaction_type']) ?></td>
                    <td><?= htmlspecialchars($transaction['amount']) ?>€</td>
                    <td><?= htmlspecialchars($transaction['beneficiary_account_id']) ?></td>
                    <td><?= empty(htmlspecialchars($transaction['created_at']))?htmlspecialchars($transaction['created_at']):"" ?></td>
                    <td><?= htmlspecialchars($transaction['motif']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>
    </div>
</body>
</html>
