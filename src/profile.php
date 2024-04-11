<?php
@session_start();
$userProfile = [
    'username' => '',
    'full_name' => '',
    'address1' => '',
    'address2' => '',
    'city' => '',
    'state' => '',
    'zip_code' => ''
];
$formDisabled = '';
$errorMsg = '';

if (isset($_SESSION['username'])) {
    require_once('db.php');
    if (!isset($conn)) {
      $connector = new DatabaseConnector();
      $conn = $connector->connect();
    }
    $stmt = $conn->prepare("SELECT * FROM user_info WHERE username = ?");
    $stmt->bind_param("s", $_SESSION['username']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $userProfile = $result->fetch_assoc();
    } else {
        $errorMsg = "Profile not found.";
    }

    $stmt->close();
    $conn->close();

} else {
    $errorMsg = "Not logged in.";
    $formDisabled = 'disabled';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Profile Management</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css" />
    <script src="../assets/js/script.js"></script>
</head>

<body class="common-body">
    <?php include 'header.php'; ?>  
    <div class="register-container">
        <h2 style="margin-top: 30%">Client Profile Management</h2>
        <div id="error-message" class="error"></div>
        <form name="profileForm" method="POST" action="update_profile.php" onsubmit="return validateProfile()">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($userProfile['username']); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="fullName">Full Name *</label>
                <input type="text" id="fullName" name="fullName" value="<?php echo htmlspecialchars($userProfile['full_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="address1">Address 1 *</label>
                <input type="text" id="address1" name="address1" value="<?php echo htmlspecialchars($userProfile['address1']); ?>" required>
            </div>
            <div class="form-group">
                <label for="address2">Address 2</label>
                <input type="text" id="address2" name="address2" value="<?php echo htmlspecialchars($userProfile['address2']); ?>">
            </div>
            <div class="form-group">
                <label for="city">City *</label>
                <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($userProfile['city']); ?>" required>
            </div>
            <div class="form-group">
                <label for="state">State *</label>
                <select id="state" name="state"  required>
                    <option value="">Select a State</option>
                    <option value="TX" <?php echo (isset($userProfile['state']) && $userProfile['state'] == 'TX') ? 'selected' : ''; ?>>Texas</option>
                    <option value="CA" <?php echo (isset($userProfile['state']) && $userProfile['state'] == 'CA') ? 'selected' : ''; ?>>California</option>
                </select>
            </div>
            <div class="form-group">
                <label for="zipCode">Zip Code *</label>
                <input type="text" id="zipCode" name="zipCode" value="<?php echo htmlspecialchars($userProfile['zip_code']); ?>" required>
            </div>
            <div class="form-group">
                <button type="submit" <?php echo $formDisabled; ?>>Update Profile</button>
            </div>
        </form>
    </div>

</body>

</html>