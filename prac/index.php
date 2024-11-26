<?php

$errors = [];
$data = [];

function validate($input, &$data, &$errors) {
    // Validate Name
    if (!isset($input['name']) || empty(trim($input['name']))) {
        $errors[] = "Name is required.";
    } else if (strlen(trim($input['name'])) < 1) {
        $errors[] = "Name must be at least 1 character long.";
    } else {
        $data['name'] = htmlspecialchars($input['name']);
    }

    // Validate Email
    if (!isset($input['email']) || empty($input['email'])) {
        $errors[] = "Email is required.";
    } else if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email is not valid.";
    } else {
        $data['email'] = htmlspecialchars($input['email']);
    }

    // Validate Card Number
    if (!isset($input['cardnum']) || empty($input['cardnum'])) {
        $errors[] = "Card number is required.";
    } else if (!preg_match('/^\d{16}$/', $input['cardnum'])) {
        $errors[] = "Card number must be 16 digits long.";
    } else {
        $data['cardnum'] = htmlspecialchars($input['cardnum']);
    }

    // Validate CVV
    if (!isset($input['cvv']) || empty($input['cvv'])) {
        $errors[] = "CVV is required.";
    } else if (!preg_match('/^\d{3}$/', $input['cvv'])) {
        $errors[] = "CVV must be 3 digits long.";
    } else {
        $data['cvv'] = htmlspecialchars($input['cvv']);
    }

    // Validate Agree Checkbox
    if (!isset($input['agree'])) {
        $errors[] = "You must agree to the contract.";
    }

    return count($errors) === 0;
}

// Validate the form
$is_valid = validate($_GET, $data, $errors);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Win an iPhone</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/elte-fi/www-assets@19.10.16/styles/mdss.min.css">
</head>

<body style="background-color: <?= htmlspecialchars($_GET['bgcolor'] ?? "#f0f0f0") ?>">
    <h1>You might have a chance to win a new iPhone! 😍😍</h1>
    <h2>The only thing you have to do is fill out this form.</h2>
    <form action="index.php" method="get" novalidate>
        <h4>Name</h4>
        <input type="text" name="name" value="<?= htmlspecialchars($data['name'] ?? '') ?>">

        <h4>Email</h4>
        <input type="email" name="email" value="<?= htmlspecialchars($data['email'] ?? '') ?>">

        <h4>Card Number</h4>
        <input type="text" name="cardnum" value="<?= htmlspecialchars($data['cardnum'] ?? '') ?>">

        <h4>CVV</h4>
        <input type="text" name="cvv" value="<?= htmlspecialchars($data['cvv'] ?? '') ?>">

        <h4>Color</h4>
        <select name="color">
            <option value="1" <?= (isset($_GET['color']) && $_GET['color'] == '1') ? 'selected' : '' ?>>Blue</option>
            <option value="2" <?= (isset($_GET['color']) && $_GET['color'] == '2') ? 'selected' : '' ?>>Red</option>
            <option value="3" <?= (isset($_GET['color']) && $_GET['color'] == '3') ? 'selected' : '' ?>>Black</option>
        </select>

        <h4>Expiry Date</h4>
        <input type="date" name="date" value="<?= htmlspecialchars($_GET['date'] ?? '') ?>">

        <h4>Agreeing to the contract</h4>
        <input type="checkbox" name="agree" <?= isset($_GET['agree']) ? 'checked' : '' ?>>

        <input type="submit" value="Send">
    </form>

    <?php if (!$is_valid): ?>
        <ul style="color:red">
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <h1>YOU'VE JUST WON A NEW iPHONE! 😍😍</h1>
    <?php endif; ?>

    <a href="/index.php?bgcolor=%23aaa">Dark gray</a>
    <a href="/index.php?bgcolor=lightgreen">Light green</a>
    <a href="https://www.google.com/search?q=lions">Search</a>
</body>

</html>
