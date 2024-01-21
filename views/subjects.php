<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PR 7</title>
</head>
<body>
    <ul>
        <li><a href="/Pr8/">Students</a></li>
        <li><a href="/Pr8/index.php/subjects">Subjects</a></li>
        <li><a href="/Pr8/index.php/progress">Progress</a></li>
    </ul>
    <form action="/Pr8/index.php/subjects/addSubject" method="POST">
        <input type="text" name="name" placeholder="Name" required /><br>

        <input type="submit" value = "Отправить"/>
    </form>


    <?php  
      if ($subjects) {
    ?>
        <form method="POST" action="/Pr8/index.php/subjects/actions">
            <table>
                <tr>
                    <th>Имя</th>
                    <th>Действие</th>
                </tr>
        <?php 
        foreach($subjects as $s) {
            ?>
            <tr>
                <td><input type="text" name="name[<?php echo $s['id']; ?>]" placeholder="Name" value="<?php echo $s['name']; ?>" required /></td>

                
                <td><button type="submit" name="delete" value="<?php echo $s['id']; ?>">Delete</button></td>
                <td><button type="submit" name="update" value="<?php echo $s['id']; ?>">Update</button></td>
            </tr>
        <?php  }?>

        </table>
        </form>
    <?php  }?>

</body>
</html>
