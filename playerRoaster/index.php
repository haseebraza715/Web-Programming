<!DOCTYPE html>
<html lang="en" data-theme="forest">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.2/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="p-0">
    <div class="header w-full text-3xl bg-neutral p-5 font-bold text-neutral-content text-center ">
        Roaster of Team Webprog
        <a class="btn btn-primary font-bold ml-10 mt-1" href="addplayer.php">Add player</a>
    </div>
    <div
        class="w-[80vw] mx-auto mt-5 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 max-h-[80vh] overflow-y-scroll ">
        <!-- Beginning of the cards -->
        <div class="card card-side bg-base-300 shadow-xl">
            <figure class="h-full"><img src="./img/valentino.jpg" class="h-full w-48 object-cover" />
            </figure>
            <div class="card-body mx-auto text-center w-full p-3 my-auto">
                <h2 class="card-title text-center block">Valentino Alfonzo</h2>
                <div class="card-actions mx-auto text-center block">
                    <div class="badge badge-primary">Striker</div>
                    <div class="badge badge-outline">Winger</div>
                    <div class="stat">
                        <div class="stat-title">Goals this season</div>
                        <div class="stat-value">30</div>
                        <div class="stat-desc">21% more than last season</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-side bg-base-300 shadow-xl ">
            <figure class="h-full"><img src="./img/kiss.jpg" class="h-full w-48 object-cover" />
            </figure>
            <div class="card-body mx-auto text-center w-full p-3 my-auto">
                <h2 class="card-title text-center block">Level Géza</h2>
                <div class="card-actions mx-auto text-center block">
                    <div class="badge badge-primary">Goalkeeper</div>
                    <div class="stat">
                        <div class="stat-title">Goals this season</div>
                        <div class="stat-value">0</div>
                        <div class="stat-desc">Same as last season</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-side bg-base-300 shadow-xl">
            <figure class="h-full"><img src="./img/batorini.jpg" class="h-full w-48 object-cover" />
            </figure>
            <div class="card-body mx-auto text-center w-full p-3 my-auto">
                <h2 class="card-title text-center block">Benke Giroud</h2>
                <div class="card-actions mx-auto text-center block">
                    <div class="badge badge-primary">Rightback</div>
                    <div class="badge badge-outline">Leftback</div>
                    <div class="badge badge-outline">Centerback</div>
                    <div class="stat">
                        <div class="stat-title">Goals this season</div>
                        <div class="stat-value">5</div>
                        <div class="stat-desc">Less than last season</div>
                    </div>
                </div>
            </div>
        </div>

        <?php
            $players = json_decode(file_get_contents('players.json'), true);
            $badge = array('badge-primary', 'badge-outline');
            
            
            $img = $players[$i]['img'];
            $goals2024 = $players[$i]['goals2024'];
            $goals2023 = $players[$i]['goals2023'];


                echo
                '<div class="card card-side bg-base-300 shadow-xl">
                    <figure class="h-full"><img src="./img/'.$img.'.jpg" class="h-full w-48 object-cover" />
                    </figure>
                    <div class="card-body mx-auto text-center w-full p-3 my-auto">
                        <h2 class="card-title text-center block">'.$name.'</h2>
                        <div class="card-actions mx-auto text-center block">';
                        for ($j = 0; $j < count($players[$i]['positions']); $j++){
                            $position = $players[$i]['positions'][$j];
                            if ($position == $players[$i]['positions'][0]){
                                echo '<div class="badge badge-primary">'.$position.'</div>';
                            }
                            else{
                                echo '<div class="badge badge-outline">'.$position.'</div>';
                            }
                        }
                        echo '<div class="stat">
                                <div class="stat-title">Goals this season</div>
                                <div class="stat-value">'.$goals2024.'</div>';
                                if ($goals2024 > $goals2023){
                                    $percentage = round((($goals2024 - $goals2023) / $goals2023) * 100);
                                    echo '<div class="stat-desc">'.$percentage.'% more than last season</div>';
                                }
                                else if ($goals2024 < $goals2023){
                                    echo '<div class="stat-desc"> less than last season</div>';
                                }
                                else{
                                    echo '<div class="stat-desc">Same as last season</div>';
                                }
                            echo '</div>
                        </div>
                    </div>
                </div>';
        ?>
    </div>
</body>

</html>