<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>f_ua_test</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: sans-serif;
        }
        .main_title {
            text-align: center;
            margin-bottom: 15px;
        }
        .main_wrapper {
            max-width: 100%;
            padding: 20px;
        }
        .main_container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .flex_body_wrapper {
            max-width: 470px;
            width: 100%;
            margin: 0 auto;
        }
        .flex_body {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            list-style-type: none;
            margin: -5px;
        }
        .flex_body_item {
            width: 150px;
            height: 150px;
            background-color: green;
            margin: 5px;
        }
    </style>
    <div class="main_wrapper">
        <div class="main_container">
            <h1 class="main_title">HTML + CSS</h1>
            <div class="flex_body_wrapper">
                <ul class="flex_body">
                    <li class="flex_body_item"></li>
                    <li class="flex_body_item"></li>
                    <li class="flex_body_item"></li>
                    <li class="flex_body_item"></li>
                    <li class="flex_body_item"></li>
                    <li class="flex_body_item"></li>
                    <li class="flex_body_item"></li>
                    <li class="flex_body_item"></li>
                    <li class="flex_body_item"></li>
                </ul>
            </div>
        </div>
    </div>
    <br><br><br><br><br>
    <div class="main_wrapper">
        <div class="main_container">
            <h2 class="main_title">Javascript (jQuery)</h2>
            <div class="flex_body_wrapper">
                <ul class="flex_body">
                    <li class="flex_body_item flex_body_item_reinbow"></li>
                </ul>
            </div>
    </div>
    <script>
        $(document).ready(function() {
            let rainbowColors = [
                'red',
                'orange',
                'yellow',
                'green',
                'blue',
                'indigo',
                'violet',
                'blue',
                'green',
                'yellow',
                'orange',
            ];
            let randomColor = rainbowColors[0];
            $('.flex_body_item_reinbow').css('background-color', randomColor);
            let i = 1;
            setInterval(function() {
                console.log(i);
                randomColor = rainbowColors[i];
                $('.flex_body_item_reinbow').css('background-color', randomColor);
                i++;
                if (i >= rainbowColors.length) {
                    i = 0;
                }
            }, 4000);
        });
    </script>
    <br><br><br><br><br>
    <div class="main_wrapper">
        <div class="main_container">
            <h2 class="main_title">MySQL</h2>
            <div class="flex_body_wrapper">
            <?php
                $user = 'root';
                $pass = 'root';
                $dbname = 'app_f-ua-test';
                $localhost = 'mysql-f-ua-test-service';

                $dbh = new PDO('mysql:host=' . $localhost . ';dbname=' . $dbname . '', $user, $pass);

                //$uqery = $dbh->query('SELECT description FROM products WHERE LENGTH(description) = (SELECT MAX(LENGTH(description)) FROM products)')->fetchAll();

                $query = $dbh->query('SELECT c.name AS category_name, count(*) AS cnt, MIN(price) AS min_price, MAX(price) AS max_price, 
                    (SELECT description FROM products WHERE LENGTH(description) = (SELECT MAX(LENGTH(description)) FROM products)) AS max_description FROM products AS p INNER JOIN categories AS c ON p.category_id = c.id GROUP BY c.name')->fetchAll();
            ?>
            <pre>
                <? var_dump($dbh, $query); ?>
            </pre>
            </div>
        </div>
    </div>
</body>
</html>