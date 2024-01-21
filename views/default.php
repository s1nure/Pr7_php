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
    <form action="/Pr8/index.php/students/addStudent" method="POST">
        <input type="text" name="name" placeholder="Name" required /><br>
        <select name="group_id">
           <?php
           if($groups ){
            foreach($groups as $g) {
                echo '<option value="'.$g['id'].'" required>
                    '.$g['name'].'
                </option>';
            }
           }
           
        ?> 
        </select>
        <input type="submit" value = "Отправить"/>
    </form>


    <?php  
      if ($students) {
    ?>
        <form method="POST" action="/Pr8/index.php/students/actions">
            <table>
                <tr>
                    <th>Имя</th>
                    <th>Группа</th>
                    <th>Действие</th>
                </tr>
        <?php 
        foreach($students as $s) {
            ?>
            <tr>
                <td><input type="text" name="name[<?php echo $s['id']; ?>]" placeholder="Name" value="<?php echo $s['name']; ?>" required /></td>

                <td>
                    <select name="group_id[<?php echo $s['id']; ?>]">
                        <?php  
                            if($groups ){
                                foreach($groups as $g) {
                                ?>
                                    <option 
                                        value="<?php echo $g['id']; ?>"  
                                        <?php 
                                            if ($g['id'] == $s['group_id']) 
                                                {
                                                    echo 'selected';
                                                }
                                        ?> 
                                        required>
                                        
                                        <?php echo $g['name']; ?>
                                    </option>';
                            <?php  }?>
                        <?php  }?>
                    </select>
                </td>
                
                <td><button type="submit" name="delete" value="<?php echo $s['id']; ?>">Delete</button></td>
                <td><button type="submit" name="update" value="<?php echo $s['id']; ?>">Update</button></td>
            </tr>
        <?php  }?>

        </table>
        </form>
    <?php  }?>

</body>
</html>
