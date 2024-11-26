<?php
    include ('planets.php'); 
    $badgeColors = [
        'Friendly' => 'badge-success',
        'Hostile' => 'badge-error',
        'unknown' => '',
        'Neutral' => 'badge-primary'
    ];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planets Stargate Controller</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.9.0/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <h1 class="text-3xl text-primary font-bold text-center py-5">Planets</h1>

    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <?php
           
            foreach ($planets as $planet) {
                $name = $planet['name']; 
                $info = $planet['info']; 
                $gate = $planet['gate']; 
                $badgeClass = isset($badgeColors[$info]) ? $badgeColors[$info] : '';
                $buttonClass = $gate === 'Reachable' ? 'btn-primary' : 'btn-disabled';
                echo "
                <div class='card bg-base-200 shadow-xl'>
                    <div class='card-body items-center text-center'>
                        <h2 class='card-title text-secondary mb-3'>$name</h2>
                        <div class='flex'>
                            <div class='badge $badgeClass badge-outline mr-3 truncate'>$info</div>
                            <div class='badge badge-outline truncate'>$gate</div>
                        </div>
                        <div class='card-actions justify-end mt-3'>
                            <button class='btn $buttonClass'>$gate</button>
                        </div>
                    </div>
                </div>";
            }
            ?>
        </div>
    </div>
</body>
</html>
