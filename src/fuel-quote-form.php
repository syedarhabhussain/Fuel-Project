<?php
session_start();
$formDisabled = '';
$errorMsg = '';
if (!isset($_SESSION['username'])) {
    $errorMsg = "Not logged in.";
    $formDisabled = 'disabled';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css" />
    <script src="../assets/js/script.js"></script>
    <title>Fuel Quote Form</title>
</head>

<body class="common-body">
    <?php include 'header.php'; ?>  
    <div class="register-container">
        <h2>Fuel Quote Form</h2>
        <div id="error-message" class="error"></div>
        <form id="fuelQuoteForm" method="POST" action="insert_quote.php">
            <div class="form-group">
                <label for="gallonsRequested">Gallons Requested *</label>
                <input type="number" id="gallonsRequested" name="gallonsRequested" required>
            </div>
            <div class="form-group">
                <label for="deliveryAddress">Delivery Address</label>
                <input type="text" id="deliveryAddress" name="deliveryAddress" value="Texas" readonly>
            </div>
            <div class="form-group">
                <label for="deliveryDate">Delivery Date *</label>
                <input type="date" id="deliveryDate" name="deliveryDate" required>
            </div>
            <div class="form-group">
                <label for="suggestedPrice">Suggested Price</label>
                <input type="currency" id="suggestedPrice" name="suggestedPrice" readonly>
            </div>
            <div class="form-group">
                <label for="totalAmountDue">Total Amount Due</label>
                <input type="currency" id="totalAmountDue" name="totalAmountDue" readonly>
            </div>
            <div class="form-group">
                <button type="submit" value="Get Quote" name="GetQuote" <?php echo $formDisabled; ?>>Get Quote</button>
            </div>
            <div class="form-group">
                <button type="button" onclick="location.href='history.php'">Check History</button>
            </div>
        </form>
    </div>
    <script>
        function calculatePrice() {
            const pricePerGallon = 47.5;
            const gallonsRequested = document.getElementById('gallonsRequested').value;
            const totalAmountDue = gallonsRequested * pricePerGallon;
            document.getElementById('suggestedPrice').value = "$" + pricePerGallon.toFixed(2);
            document.getElementById('totalAmountDue').value = "$" + totalAmountDue.toFixed(2);
        }
        document.getElementById('gallonsRequested').addEventListener('change', calculatePrice);
    </script>
</body>

</html>