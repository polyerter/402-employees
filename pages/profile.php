<?php
    require_once('../connect.php');

    $emp_no = $_GET['emp_no'] ?? 10001;
    $query = $conn->query("SELECT * FROM `employees` 
                            LEFT JOIN titles ON titles.emp_no = employees.emp_no
                        WHERE employees.emp_no = $emp_no
    ");
    $employee = $query->fetch(); // Одна запись

    $salaryQuery = $conn->query("SELECT * FROM salaries WHERE emp_no = $emp_no");
    $salaries = $salaryQuery->fetchAll();

    $salaryChart = [];
    foreach($salaries as $key => $salary) {
        $salaryChart[] = $salary['salary'];
    }

    // print_r($salaryChart);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сотрудники</title>

    <script src="https://code.highcharts.com/highcharts.js"></script>
</head>
<body>
    <div>
        <p><strong>Имя:</strong> <?php echo $employee['first_name'] ?></p>
        <p><strong>Фамилия:</strong> <?php echo $employee['last_name'] ?></p>
        <p><strong>Должность:</strong> <?php echo $employee['title'] ?></p>
    </div>

    <div>
        <table border="1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Зарплата</th>
                    <th>С</th>
                    <th>По</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($salaries as $key => $value) { ?>
                    
                <tr>
                    <td><?php echo $key + 1 ?></td>
                    <td><?php echo $value['salary'] ?></td>
                    <td><?php echo $value['from_date'] ?></td>
                    <td><?php echo $value['to_date'] ?></td>
                </tr>

                <?php } ?>
            </tbody>
        </table>

    </div>

    <div id="container"></div>

    <script>
        Highcharts.chart('container', {
            title: {
                text: 'Logarithmic axis demo'
            },

            xAxis: {
                tickInterval: 1,
                type: 'logarithmic',
                accessibility: {
                    rangeDescription: 'Range: 1 to 10'
                }
            },

            yAxis: {
                type: 'logarithmic',
                minorTickInterval: 0.1,
                accessibility: {
                    rangeDescription: 'Range: 0.1 to 1000'
                }
            },

            tooltip: {
                headerFormat: '<b>{series.name}</b><br />',
                pointFormat: 'x = {point.x}, y = {point.y}'
            },

            series: [{
                data: [<?php echo implode(',', $salaryChart); ?>],
                pointStart: 1
            }]
            });
    </script>

</body>
</html>