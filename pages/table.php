<?php
    require_once('../connect.php');

    $query = $conn->query('SELECT * FROM employees LIMIT 25');
    $data = $query->fetchAll(); // все записи 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сотрудники</title>
</head>
<body>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Дата рождения</th>
                <th>Устроен от</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data as $key => $value) { ?>
                
            <tr>
                <td><?php echo $value['emp_no'] ?></td>
                <td><?php echo $value['first_name'] ?></td>
                <td><?php echo $value['last_name'] ?></td>
                <td><?php echo $value['birth_date'] ?></td>
                <td><?php echo $value['hire_date'] ?></td>
                <td>
                    <a href="/employees/pages/profile.php?emp_no=<?php echo $value['emp_no'] ?>">
                        <button>Просмотр</button>
                    </a>
                </td>
            </tr>

            <?php } ?>
        </tbody>
    </table>
</body>
</html>