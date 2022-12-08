<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        require_once('connect.php');

        $query = $conn->query('SELECT * FROM departments');
        // $data = $query->fetch(); // первая запись
        $data = $query->fetchAll(); // все записи 
        // print_r($data);
    ?>

    <?php
        foreach($data as $key => $value) {
            echo "$key => " . $value['dept_name'] . " => ". $value['dept_no'] . '<br>';
        }
    ?>

    <p>
        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Hic dolorem, quod et dignissimos libero veniam excepturi, aut odio quam dicta at praesentium repellat animi natus officia! Consectetur earum asperiores pariatur?
    </p>
</body>
</html>