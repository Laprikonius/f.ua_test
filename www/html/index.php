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
        .ASCII_table {
            text-align: center;
        }
        .ASCII_table i {
            font-style: normal;
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

                $query = $dbh->query('SELECT
                        c.name AS category_name,
                        COUNT(p.id) AS product_count,
                        MIN(p.price) AS min_price,
                        MAX(p.price) AS max_price,
                        p.name AS product_with_longest_description,
                        LENGTH(p.description) AS longest_description_length,
                        p.description AS longest_description_text
                    FROM
                        categories c
                    JOIN
                        products p ON c.id = p.category_id
                    JOIN
                        (
                            SELECT 
                                category_id,
                                name,
                                description,
                                ROW_NUMBER() OVER (PARTITION BY category_id ORDER BY LENGTH(description) DESC) AS rn
                            FROM 
                                products
                        ) sub_p ON p.category_id = sub_p.category_id AND p.name = sub_p.name
                    WHERE
                        sub_p.rn = 1
                    GROUP BY
                        c.id, c.name, p.name, p.description
                    ORDER BY
                        c.name;')
                    ->fetchAll(PDO::FETCH_ASSOC);
            ?>
                <pre>
                    <? var_dump($query); ?>
                </pre>
                <pre>
                    <? print_r(json_encode($query, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)) ?>
                </pre>
            </div>
        </div>
    </div>

    <?php
        $data = [
            [
                'Name' => 'Trixie',
                'Color' => 'Green',
                'Element' => 'Earth',
                'Likes' => 'Flowers'
            ],
            [
                'Name' => 'Tinkerbell',
                'Element' => 'Air',
                'Likes' => 'Singning',
                'Color' => 'Blue',
            ],
            [
                'Name' => 'Blum',
                'Element' => 'Water',
                'Likes' => 'Dancing',
                'Name' => 'Blum',
                'Color' => 'Pink'
            ]
        ];

        const SPACING_X   = 1;
        const SPACING_Y   = 0;
        const JOINT_CHAR  = '+';
        const LINE_X_CHAR = '-';
        const LINE_Y_CHAR = '|';
        
        function draw_table($table)
        {

            $nl              = "\n";
            $columns_headers = columns_headers($table);
            $columns_lengths = columns_lengths($table, $columns_headers);
            $row_separator   = row_seperator($columns_lengths);
            $row_spacer      = row_spacer($columns_lengths);
            $row_headers     = row_headers($columns_headers, $columns_lengths);

            echo '<pre class="ASCII_table">';

            echo $row_separator . $nl;
            echo str_repeat($row_spacer . $nl, SPACING_Y);
            echo $row_headers . $nl;
            echo str_repeat($row_spacer . $nl, SPACING_Y);
            echo $row_separator . $nl;
            echo str_repeat($row_spacer . $nl, SPACING_Y);
            foreach ($table as $row_cells) {
                $row_cells = row_cells($row_cells, $columns_headers, $columns_lengths);
                echo $row_cells . $nl;
                echo str_repeat($row_spacer . $nl, SPACING_Y);
                echo $row_separator . $nl;
            }
            //echo $row_separator . $nl;

            echo '</pre>';

        }

        function columns_headers($table)
        {
            return array_keys(reset($table));
        }

        function columns_lengths($table, $columns_headers)
        {
            $lengths = [];
            foreach ($columns_headers as $header) {
                $header_length = strlen($header);
                $max           = $header_length;
                foreach ($table as $row) {
                    $length = strlen($row[$header]);
                    if ($length > $max) {
                        $max = $length;
                    }
                }

                if (($max % 2) != ($header_length % 2)) {
                    $max += 1;
                }

                $lengths[$header] = $max;
            }

            return $lengths;
        }

        function row_seperator($columns_lengths)
        {
            $row = '';
            foreach ($columns_lengths as $column_length) {
                $row .= JOINT_CHAR . str_repeat(LINE_X_CHAR, (SPACING_X * 2) + $column_length);
            }
            $row .= JOINT_CHAR;

            return $row;
        }

        function row_spacer($columns_lengths)
        {
            $row = '';
            foreach ($columns_lengths as $column_length) {
                $row .= LINE_Y_CHAR . str_repeat(' ', (SPACING_X * 2) + $column_length);
            }
            $row .= LINE_Y_CHAR;

            return $row;
        }

        function row_headers($columns_headers, $columns_lengths)
        {
            $row = '';
            foreach ($columns_headers as $header) {
                $row .= LINE_Y_CHAR . str_pad($header, (SPACING_X * 2) + $columns_lengths[$header], ' ', STR_PAD_BOTH);
            }
            $row .= LINE_Y_CHAR;

            return $row;
        }

        function row_cells($row_cells, $columns_headers, $columns_lengths)
        {
            $row = '';
            foreach ($columns_headers as $header) {
                $columnColor = "";
                if ($header == 'Color')
                {
                    $columnColor = "<i style='color: " . $row_cells[$header] . "'>";
                }
                $row .= $columnColor . LINE_Y_CHAR . str_repeat(' ', SPACING_X) . str_pad($row_cells[$header], SPACING_X + $columns_lengths[$header], ' ', STR_PAD_RIGHT) . "</i>";
            }
            $row .= LINE_Y_CHAR;

            return $row;
        }
    ?>
    <br><br><br><br><br>
    <div class="main_wrapper">
        <div class="main_container">
            <h2 class="main_title">PHP</h2>
            <div class="flex_body_wrapper">
                <? draw_table($data); ?>
            </div>
        </div>
    </div>

</body>
</html>