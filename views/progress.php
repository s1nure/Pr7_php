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
    <form action="/Pr8/index.php/progress/addProgress" method="POST">
        <input type="number" name="mark" placeholder="Mark" required /><br>

        <select name="student_id">
            <?php foreach($students as $s){?>
                <option value="<?php echo $s['id'];?>">
                    <?php echo $s['name'];?>
                </option>
            <?php }?>
        </select><br>
        
        <select name="subject_id">
            <?php foreach($subjects as $subject){?>
                <option value="<?php echo $subject['id'];?>">
                    <?php echo $subject['name'];?>
                </option>
            <?php }?>
        </select><br>
        <input type="submit" value = "Отправить"/>
    </form>


    <?php  
      if ($progress) {
    ?>
        <form method="POST" action="/Pr8/index.php/progress/actions">
            <table>
                <tr>
                    <th>Имя</th>
                    <th>Предмет</th>
                    <th>Оценка</th>
                    <th>Действие</th>
                </tr>
        <?php 
        foreach($progress as $p) {
            ?>
            <tr>
                <td>
                    <select name="student_id[<?php echo $p['id'];?>]">
                        <?php foreach($students as $s){?>
                            <option value="<?php echo $s['id'];?>" <?php if ($s['id'] == $p['student_id']) {
                                  echo 'selected';}?>>
                                <?php echo $s['name'];?>
                            </option>
                        <?php }?>
                    </select>
                </td>
                <td>
                    <select name="subject_id[<?php echo $p['id'];?>]">
                        <?php foreach($subjects as $subject){?>
                            <option value="<?php echo $subject['id']; ?>" <?php if ($subject['id'] == $p['subject_id']) {
                                  echo 'selected';}?> >
                                <?php echo $subject['name'];?>
                            </option>
                        <?php }?>
                    </select>
                </td>
                <td><input type="text" name="mark[<?php echo $p['id']; ?>]" placeholder="mark" value="<?php echo $p['mark']; ?>" required /></td>

                <td><button type="submit" name="delete" value="<?php echo $p['id']; ?>">Delete</button></td>
                <td><button type="submit" name="update" value="<?php echo $p['id']; ?>">Update</button></td>
            </tr>
        <?php  }?>

        </table>
        </form>
    <?php  }?>

</body>
</html>
