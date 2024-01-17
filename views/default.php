<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PR 7</title>
</head>
<body>
    <form action="/Pr7/index.php/students/addStudent" method="POST">
        <input type="text" name="name" placeholder="Name" required /><br>
        <input type="number" name="group_id" placeholder="Group id" min="1" max="2" required /><br>
        <input type="submit" value = "Отправить"/>
    </form>


  <?php 
      if ($students) {
        echo '<form method="POST" action="/Pr7/index.php/students/actions">
            <table>
                <tr>
                    <th>Имя</th>
                    <th>Группа</th>
                    <th>Действие</th>
                </tr>';

        foreach($students as $s) {
            echo '<tr>
                <td>'.$s['name'].'</td>
                <td>'.$s['group_id'].'</td>
                <td><button type="submit" name="delete" value="'.$s['id'].'">Delete</button></td>
            </tr>';
        }

        echo '</table>
        </form>';
    }
  ?>
</body>
</html>
