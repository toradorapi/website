<?php
    function callApi($method, $url, $data = false)
    {
        $curl = curl_init();
        switch ($method)
        {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Toradora</title>
        <link href="https://fonts.googleapis.com/css?family=Fira+Sans&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
        <style>
            body {
                margin: 0;
                padding: 25px;
                background-color: #1e1e1e;
                color: white;
                font-family: 'Fira Sans', sans-serif;
            },
            a {
                color: white;
                text-decoration: none;
                padding: 10px;
                line-height: 50px;
                border: 3px solid white;
                transition-duration: 500ms;
            }
            a:link {
                color: white;
                text-decoration: none;
                padding: 10px;
                line-height: 50px;
                border: 3px solid white;
                transition-duration: 500ms;
            }
            a:visited {
                color: white;
                text-decoration: none;
                padding: 10px;
                line-height: 50px;
                border: 3px solid white;
                transition-duration: 500ms;
            }
            a:hover {
                color: black;
                text-decoration: none;
                padding: 10px;
                line-height: 50px;
                background-color: white;
                border: 3px solid white;
                transition-duration: 500ms;
            }
            h1 {
                padding: 10px;
                text-align: center;
            }
            .footer-text {
                text-align: center;
                padding: 20px;
            }
            .delay-500ms {
                animation-delay: 500ms;
            }
            .delay-1s {
                animation-delay: 1s;
            }
            img {
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            }
        </style>
    </head>
    <body>
    <h1 class="animated infinite flash slower">ToradorAPI</h1>
    <?php
        if($_GET['type'] && $_GET['anim'] && $_GET['char']) {
            $image = callApi("GET", "http://crugg.de:90/api/v1/img_".$_GET['type']."/".$_GET['char']);
            echo("<img class='animated fadeIn faster' alt='image' src='".json_decode($image)->url."'></img>");
            echo("<p class='animated fadeIn faster delay-500ms'>Source: ".json_decode($image)->source."</p>");
        } else {
            if(!$_GET['type']) {
                echo("<p class='animated fadein faster'>What type of image do you want to see?</p>");
                echo("<a class='animated fadein faster delay-500ms' href='?type=original'>Original Screenshots from the Anime</a><br />");
                echo("<a class='animated fadein faster delay-1s' href='?type=fanart'>Fanart</a>");
            } else if(!$_GET['anim']) {
                echo("<p class='animated fadein faster'>Do you want to see animated gifs?</p>");
                echo("<a class='animated fadein faster delay-500ms' href='#'>Yes (Comming Soon)</a><br />");
                echo("<a class='animated fadein faster delay-1s' href='?type=".$_GET['type']."&anim=false'>No</a>");
            } else if(!$_GET['char']) {
                echo("<p class='animated fadein faster'>What character do you want to see? (More comming soon)</p>");
                echo("<a class='animated fadein faster delay-500ms' href='?type=".$_GET['type']."&anim=".$_GET['anim']."&char=taiga'>Taiga</a>");
                echo("<a class='animated fadein faster delay-500ms' href='?type=".$_GET['type']."&anim=".$_GET['anim']."&char=ami'>Ami</a>");
            } else {
                echo("<p class='animated infinite tada'>An error occured.</p>");
            }
        }
    ?>
    <p class="footer-text">Made with ❤️ by CRUGG#0001</p>
    </body>
</html>
