<?php
if (!isset($_SESSION['user_id'])) {
    echo "<script>window.location.href = '?page=login';</script>";
    exit();
}

include 'db.php';
$user_id = $_SESSION['user_id'];
$userlevel = $_SESSION['userlevel'];

if ($userlevel == 1) {
    // Admin: Show all purchase history
    $stmt = $conn->prepare("SELECT bh.purchase_date, p.name, p.price, p.category, u.username 
                            FROM buy_history bh 
                            JOIN products p ON bh.product_id = p.id 
                            JOIN users u ON bh.user_id = u.id");
} else {
    // Regular user: Show only their purchase history
    $stmt = $conn->prepare("SELECT bh.purchase_date, p.name, p.price, p.category 
                            FROM buy_history bh 
                            JOIN products p ON bh.product_id = p.id 
                            WHERE bh.user_id = ?");
    $stmt->bind_param("i", $user_id);
}

$stmt->execute();
$result = $stmt->get_result();
$purchases = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<div class="container mt-5">
    <h2><?php echo $userlevel == 1 ? 'All Purchase History' : 'Your Purchase History'; ?></h2>
    <div class="card mb-4">
        <div class="card-body">
            <?php if (!empty($purchases)): ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Purchase Date</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Category</th>
                            <?php if ($userlevel == 1): ?>
                                <th>Username</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($purchases as $purchase): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($purchase['purchase_date']); ?></td>
                                <td><?php echo htmlspecialchars($purchase['name']); ?></td>
                                <td>$<?php echo htmlspecialchars($purchase['price']); ?></td>
                                <td><?php echo htmlspecialchars($purchase['category']); ?></td>
                                <?php if ($userlevel == 1): ?>
                                    <td><?php echo htmlspecialchars($purchase['username']); ?></td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p><?php echo $userlevel == 1 ? 'No purchase history found.' : 'You have not made any purchases yet.'; ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>