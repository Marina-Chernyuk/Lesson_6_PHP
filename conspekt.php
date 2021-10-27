<?php
echo '</pre>';
    //var_dump($_GET);
    // var_dump($_POST);
    var_dump($_FILES);
echo '</pre>';
?>

<!-- <form method ="get" action="index2.php">
    <input type="text" name="first_name"><br/>
    <input type="text" name="last_name"><br/>
    <input type="submit" value="Send">
</form> -->

<!--<form method ="post" action="index2.php">
    <input type="text" name="first_name"><br/>
    <input type="text" name="last_name"><br/>
    <input type="submit" value="Send">
</form>  -->

<!--<form method ="post" action="index2.php">
    /* автоматическая подставка значения при переотправке (верхнего значения first_name),
    то есть проверка на null. Если такое поле существует, то отдастся его значение или пустая строка */
    <input type="text" name="first_name" value="<?php echo $_POST['first_name'] ?? ''; ?>"><br/>
    <input type="text" name="last_name"><br/>
    <input type="submit" value="Send">
</form> -->

<form enctype="multipart/form-data" method ="post" action="index2.php">
    <!-- отправка файлов -->
    <input type="file" name="filefromuser[]"><br/>
    <input type="file" name="filefromuser[]"><br/>
    <input type="submit" value="Send">
</form>
