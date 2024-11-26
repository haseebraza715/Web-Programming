<!DOCTYPE html>
<html lang="en" data-theme="synthwave">
<?php
include ('planets.php');
// var_dump($planets);
file_put_contents("planets.json", json_encode($planets, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));


//validate the name input 
//The name has to be validated with this regular expression:  \^P\d{1,2}[A-Z]-\d{3,4}$\
$name = $_GET['name'];
if (!preg_match('/^P\d{1,2}[A-Z]-\d{3,4}$/', $name)) {
    echo "<div role='alert' class='alert alert-error mb-2'>
    <span>Error! Task failed successfully.</span>
</div>";
}
else {
    $info = $_GET['info'];
    $gate = $_GET['gate'];
    $notanalien = isset($_GET['notanalien']) ? true : false;
    $newplanet = ["name" => $name, "info" => $info, "gate" => $gate, "notanalien" => $notanalien];
    array_push($planets, $newplanet);
    file_put_contents("planets.json", json_encode($planets, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    echo "<div role='alert' class='alert alert-success mb-2'>
    <span>Planet $name has been added successfully.</span>
</div>";

}





?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.9.0/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <h1 class="text-3xl text-primary font-bold text-center py-5">Planets

        <a href="index.php" class="btn btn-primary btn-sm font-bold ml-10 mb-2 ">Back to main page</a>
    </h1>
    <div class="flex">
        <form action="addplanet.php" method="get" class="mx-auto mt-3 w-3/12 p-10">
            <h1 class="text-3xl  p-5 font-bold">Add a new planet</h1>
            <label class="form-control w-full max-w-xs">
                <div class="label">
                    <span class="label-text">Name</span>
                </div>
                <input type="text" name="name"   placeholder="Type here" class="input input-bordered w-full max-w-xs" />
            </label>
            <label class="form-control w-full max-w-xs">
                <div class="label">
                    <span class="label-text">Info</span>
                </div>
                <select class="select w-full max-w-xs mb-3 select-bordered" name="info">
                    <option disabled selected>Select the available info</option>
                    <option value="Unknown">Unknown</option>
                    <option value="Hostile">Hostile</option>
                    <option value="Friendly">Friendly</option>
                    <option value="Neutral">Neutral</option>
                </select>
            </label>
            <label class="form-control w-full max-w-xs">
                <div class="label">
                    <span class="label-text">Gate</span>
                </div>
                <select class="select w-full max-w-xs mb-3 select-bordered" name="gate">
                    <option disabled selected>Select the state of the gate</option>
                    <option value="Reachable">Reachable</option>
                    <option value="Destroyed">Destroyed</option>
                    <option value="Not visited yet">Not visited yet</option>
                </select>
            </label>
            <div class="form-control w-6/12">
                <label class="label cursor-pointer flex">
                    <span class="label-text text-right">Not an alien </span>
                    <input type="checkbox" checked="checked" class="checkbox" name="notanalien"/>
                </label>
            </div>
            <input type="submit" value="Add a new planet" class="btn btn-primary font-bold">
        </form>

        <div class="results w-6/12  m-auto p-10">
            <div class="errors">
                <h2 class="text-3xl mb-5 font-bold">Failed addition</h2>
                <div role="alert" class="alert alert-error mb-2">
                    <span>Error! Task failed successfully.</span>
                </div>
                <div role="alert" class="alert alert-error mb-2">
                    <span>Error! Task failed successfully.</span>
                </div>
                <div role="alert" class="alert alert-error mb-2">
                    <span>Error! Task failed successfully.</span>
                </div>
            </div>

            <div class="success">
                <h2 class="text-3xl mb-2 font-bold">Successful addition</h2>
                <a class="btn btn-primary font-bold mt-1" href="index.php">Go back to Main Page</a>
            </div>
        </div>
    </div>
</body>

</html>