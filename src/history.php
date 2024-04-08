<?php include 'get_history.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fuel Quote History</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css" />
</head>

<body class="history-body">
    <?php include 'header.php'; ?>  
    <div class="container">
        <h2>Fuel Quote History</h2>
        <table id="quoteHistoryTable">
            <thead>
                <tr>
                    <th>Gallons Requested</th>
                    <th>Delivery Address</th>
                    <th>Delivery Date</th>
                    <th>Suggested Price</th>
                    <th>Total Amount Due</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($fuelQuotes as $quote): ?>
                    <tr>
                        <td><?= htmlspecialchars($quote['delivery_date']) ?></td>
                        <td><?= htmlspecialchars($quote['gallons']) ?></td>
                        <td><?= htmlspecialchars($quote['address']) ?></td>
                        <td><?= htmlspecialchars($quote['price']) ?></td>
                        <td><?= htmlspecialchars($quote['total']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>