<?php
// Initialize variables
$errors = [];
$success = false;
$name = $_GET['name'] ?? '';
$info = $_GET['info'] ?? '';
$gate = $_GET['gate'] ?? '';
$notanalien = isset($_GET['notanalien']) ? 'Yes' : 'No';

// Validate form inputs
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (empty($name) || !preg_match('/^P\d{1,2}[A-Z]-\d{3,4}$/', $name)) {
        $errors[] = 'The name must match the pattern: ^P\d{1,2}[A-Z]-\d{3,4}$';
    }
    if (empty($info)) {
        $errors[] = 'The info field is required.';
    }
    if (empty($gate)) {
        $errors[] = 'The gate field is required.';
    }
    if ($notanalien === 'No') {
        $errors[] = 'You must confirm that you are not an alien.';
    }

    // If no errors, save the data
    if (empty($errors)) {
        // Read existing planets
        $planets = json_decode(file_get_contents('planets.json'), true) ?? [];

        // Add the new planet
        $planets[] = [
            'name' => $name,
            'info' => $info,
            'gate' => $gate,
            'notanalien' => $notanalien
        ];

        // Save to JSON file
        file_put_contents('planets.json', json_encode($planets, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        // Set success flag
        $success = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en" data-theme="synthwave">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a New Planet</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.9.0/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <h1 class="text-3xl text-primary font-bold text-center py-5">
        Add a New Planet
        <a href="index.php" class="btn btn-primary btn-sm font-bold ml-10 mb-2">Back to Main Page</a>
    </h1>
    <div class="flex">
        <form action="addplanet.php" method="get" class="mx-auto mt-3 w-3/12 p-10">
            <h1 class="text-3xl p-5 font-bold">Add a New Planet</h1>
            <label class="form-control w-full max-w-xs">
                <div class="label">
                    <span class="label-text">Name</span>
                </div>
                <input type="text" name="name" placeholder="Type here" class="input input-bordered w-full max-w-xs"
                    value="<?= htmlspecialchars($name) ?>" />
            </label>
            <label class="form-control w-full max-w-xs">
                <div class="label">
                    <span class="label-text">Info</span>
                </div>
                <select class="select w-full max-w-xs mb-3 select-bordered" name="info">
                    <option disabled selected>Select the available info</option>
                    <option value="Unknown" <?= $info === 'Unknown' ? 'selected' : '' ?>>Unknown</option>
                    <option value="Hostile" <?= $info === 'Hostile' ? 'selected' : '' ?>>Hostile</option>
                    <option value="Friendly" <?= $info === 'Friendly' ? 'selected' : '' ?>>Friendly</option>
                    <option value="Neutral" <?= $info === 'Neutral' ? 'selected' : '' ?>>Neutral</option>
                </select>
            </label>
            <label class="form-control w-full max-w-xs">
                <div class="label">
                    <span class="label-text">Gate</span>
                </div>
                <select class="select w-full max-w-xs mb-3 select-bordered" name="gate">
                    <option disabled selected>Select the state of the gate</option>
                    <option value="Reachable" <?= $gate === 'Reachable' ? 'selected' : '' ?>>Reachable</option>
                    <option value="Destroyed" <?= $gate === 'Destroyed' ? 'selected' : '' ?>>Destroyed</option>
                    <option value="Not visited yet" <?= $gate === 'Not visited yet' ? 'selected' : '' ?>>Not visited yet</option>
                </select>
            </label>
            <div class="form-control w-6/12">
                <label class="label cursor-pointer flex">
                    <span class="label-text text-right">Not an alien</span>
                    <input type="checkbox" class="checkbox" name="notanalien" <?= $notanalien === 'Yes' ? 'checked' : '' ?> />
                </label>
            </div>
            <input type="submit" value="Add a New Planet" class="btn btn-primary font-bold">
        </form>

        <div class="results w-6/12 m-auto p-10">
            <?php if (!empty($errors)): ?>
                <div class="errors">
                    <h2 class="text-3xl mb-5 font-bold">Failed Addition</h2>
                    <?php foreach ($errors as $error): ?>
                        <div role="alert" class="alert alert-error mb-2">
                            <span><?= htmlspecialchars($error) ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php elseif ($success): ?>
                <div class="success">
                    <h2 class="text-3xl mb-2 font-bold">Successful Addition</h2>
                    <a class="btn btn-primary font-bold mt-1" href="index.php">Go back to Main Page</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
