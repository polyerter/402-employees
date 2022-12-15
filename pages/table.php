<?php
    require_once('../connect.php');
    
    $limit = 25; // кол-во записей на странице
    // $offset = 0;

    $page = $_GET['page'] ?? 1; // номер страницы
    // только положительные зачения номера страницы
    if ($page <= 0) {
        $page = 1;
    }

    $offset = $limit * ($page - 1); // смещение 

    $prevPage = $page - 1; // пред. страница
    $nextPage = $page + 1; // след. страница

    /*
    page = 0
    offset = 25 * (0 - 1) = -25

    page = 1
    offset = 25 * (1 - 1) = 0

    page = 2
    offset = 25 * (2 - 1) = 25

    page = 3
    offset = 25 * (3 - 1) = 50
    */

    $queryCount = $conn->query("SELECT COUNT(*) as count FROM employees");
    $count = $queryCount->fetch();
    $countPage = round($count['count'] / $limit);

    // print_r($countPage);

    $countPage = 15;

    $query = $conn->query("SELECT * FROM employees LIMIT $offset, $limit");
    $data = $query->fetchAll(); // все записи 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сотрудники</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>

    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="/employees/pages/table.php?page=<?= $prevPage ?>">Previous</a></li>

            <?php for($i = 1; $i <= $countPage; $i++) { ?>

                <?php 
                    $class = '';

                    if ($page == $i) {
                        $class = 'active';
                    }
                ?>

                <li class="page-item"><a class="page-link <?= $class ?>" href="/employees/pages/table.php?page=<?= $i ?>"><?= $i ?></a></li>  

            <?php } ?>
            
            <li class="page-item"><a class="page-link" href="/employees/pages/table.php?page=<?= $nextPage ?>">Next</a></li>
        </ul>
    </nav>

    <table class="table">
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
                        <button class="btn btn-primary btn-sm">Просмотр</button>
                    </a>
                </td>
            </tr>

            <?php } ?>
        </tbody>
    </table>
</body>
</html>