<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.9.0/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?php
    include ('planets.php');
    // var_dump($planets);
    ?>
    <h1 class="text-3xl text-primary font-bold text-center py-5">Planets</h1>
    <div class="md:w-8/12 mx-auto p-3 ">
        <h2 class="mb-3 text-xl text-bold text-secondary">Filters and options</h2>
        <form action="" method="" class="grid lg:grid-cols-6 grid-cols-1 gap-3">
            <label class="input input-bordered flex items-center lg:col-span-2">
                <input type="text" class="grow" placeholder="Search" name="search" />
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                    class="w-4 h-4 opacity-70">
                    <path fill-rule="evenodd"
                        d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                        clip-rule="evenodd" />
                </svg>
            </label>
            <select class="select select-bordered w-full" name="info">
                <option disabled selected>Filter by info</option>
                <option value="Friendly">Friendly</option>
                <option value="Hostile">Hostile</option>
                <option value="Neutral">Neutral</option>
            </select>
            <select class="select select-bordered w-full" name="theme">
                <option disabled selected>Set the theme!</option>
                <option value="forest">Forest</option>
                <option value="cyberpunk">Cyberpunk</option>
                <option value="synthwave">Synthwave</option>
                <option value="coffee">Coffee</option>
            </select>
            <div class="align-center my-auto flex flex-wrap w-full">
                <span class="w-6/12 mr-2">Reachable:</span><input type="checkbox" class="toggle w-4/12 toggle-success" name="gate" />
            </div>

            <input type="submit" class="btn btn-primary w-full">
        </form>
    </div>
</body>

</html>