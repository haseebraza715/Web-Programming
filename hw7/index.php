<?php
    include ('planets.php');

    $theme = $_GET['theme'] ?? '';
    $search = $_GET['search'] ?? '';
    $infoFilter = $_GET['info'] ?? '';
    $gate = $_GET['gate'] ?? '';
    $reachable =isset($_GET['gate']) ? true : false;

    $theme_attribute = "data-theme='$theme'";
    $badgeColors = [
        'Friendly' => 'badge-success',
        'Hostile' => 'badge-error',
        'unknown' => '',
        'Neutral' => 'badge-primary'
    ];

    $badgeClass = isset($badgeColors[$infoFilter]) ? $badgeColors[$infoFilter] : '';
    $buttonClass = $gate === 'Reachable' ? 'btn-primary' : 'btn-disabled';
?>

<!DOCTYPE html>
<html lang="en" $theme_attribute>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.9.0/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
   
<h1 class="text-3xl text-primary font-bold text-center py-5">
        Planets
        <a href="addplanet.php" class="btn btn-primary btn-sm font-bold ml-10 mb-2 ">Add planet</a>
    </h1>    <div class="md:w-8/12 mx-auto p-3 ">
        <h2 class="mb-3 text-xl text-bold text-secondary">Filters and options</h2>
        <form action="" method="get" class="grid lg:grid-cols-6 grid-cols-1 gap-3">
            <label class="input input-bordered flex items-center lg:col-span-2">
                <input type="text" class="grow" placeholder="Search" name="search" value="<?= htmlspecialchars($search) ?>"/>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                    class="w-4 h-4 opacity-70">
                    <path fill-rule="evenodd"
                        d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                        clip-rule="evenodd" />
                </svg>
            </label>
            <select class="select select-bordered w-full" name="info">
                <option disabled selected>Filter by info</option>
                <option value="Friendly"  <?= $infoFilter === 'Friendly' ? 'selected' : ''?> >Friendly</option>
                <option value="Hostile" <?= $infoFilter === 'Hostile' ? 'selected' : ''?> >Hostile</option>
                <option value="Neutral" <?= $infoFilter === 'Neutral' ? 'selected' : ''?> >Neutral</option>
            </select>
            <select class="select select-bordered w-full" name="theme">
                <option disabled selected>Set the theme!</option>
                <option value="forest" <?= $theme === 'forest' ? 'selected' : ''?>> Forest</option>
                <option value="cyberpunk" <?= $theme === 'cyberpunk' ? 'selected' : ''?>>Cyberpunk</option>
                <option value="synthwave" <?= $theme === 'synthwave' ? 'selected' : ''?>  >Synthwave</option>
                <option value="coffee"  <?= $theme === 'coffee' ? 'selected' : ''?>  >Coffee</option>
            </select>
            <div class="align-center my-auto flex flex-wrap w-full">
                <span class="w-6/12 mr-2">Reachable:</span>
                <input type="checkbox" class="toggle w-4/12 toggle-success" name="gate" <?= $reachable ? 'checked': '' ?> />
            </div>

            <input type="submit" class="btn btn-primary w-full">
        </form>
    
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <?php
           
            foreach ($planets as $planet) {
                $name = $planet['name'];
                $info = $planet['info'];
                $gate = $planet['gate'];

                
                if ($search && !str_starts_with(strtolower($name), strtolower($search))) {
                    continue; 
                }
                if ($infoFilter && $info !== $infoFilter) {
                    continue;
                }
                if ($reachable && $gate !== 'Reachable') {
                    continue; 
                }

               
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