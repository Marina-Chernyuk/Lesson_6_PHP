<?php
// занести в массив значение полей
$dataEntry = array(
    'nameUser' => $_POST['name'],
    'emailUser' => $_POST['email'],
    'commentUser' => $_POST['content']
);
$dl = '';
$website = "";

if ($dataEntry['nameUser'] && $dataEntry['emailUser'] && $dataEntry['commentUser']) {

    mail("name@yandex.ru", "заполнена форма site.ru", $dataEntry['nameUser'] . "\n" . $dataEntry['emailUser'] . "\n" . $dataEntry['commentUser']); // сообщение на ваш email о новом отзыве

    if (strpos($dataEntry['commentUser'], 'http://') === false) { // если в тексте отзыва нет http://
        $fp = fopen("comments.txt", "a+"); // режим записи
        $mytext = "<dt><a href='" . $dataEntry['emailUser'] . "'>" . $dataEntry['nameUser'] . "</a><dd>" . $dataEntry['commentUser'];
        $save = fwrite($fp, $mytext); // запись в файл
        fclose($fp); // закрытие файла
        Header("Location: " . $_SERVER['PHP_SELF']); // обновить страницу; обновлённая версия содержит опубликованный комментарий
        exit;
    } else { // если в тексте есть http://
        $website = test_input($_POST['content']);
        // проверьте, правильность синтаксиса URL-адреса
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
            $websiteErr = '<b style="color: red;">Ваш отзыв будет опубликован после проверки автором сайта</b>'; // показан этот текст
        }
    }

} else {

    $fp = @fopen("comments.txt", "r"); // режим чтения (fopen — открывает файл или URL)
    if ($fp) {
        while (!feof($fp)) { // feof — проверяет, достигнут ли конец файла
            $dl .= fgetss($fp, 8000, "<dl>,<dt>,<dd>"); // <dl>,<dt>,<dd> - это список тегов, разрешённых для публикации
        }
    }
    fclose($fp);

}
// функция fgetss устарела, но без неё код не работает
// функция strip_tags тормозит загрузку
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/styles2.css" type="text/css"/>
    <title>feedback</title>
</head>
<body>
<form method="post" class="feedback_form">
    <h1>Отзывы</h1>
    <label class="feedback_form_label">Как к Вам обращаться:</label>
    <input class="feedback_form_input" type='text' name='name' required/>
    <label class="feedback_form_label">Email (не публикуется):</label>
    <input class="feedback_form_input" type='email' name='email' required/>
    <label class="feedback_form_label">Oтзыв:</label>
    <textarea class="feedback_form_text" name='content' required rows="5"></textarea>
    <input class="feedback_form_publication" type='submit' value='публикация'/>
</form>

<dl>
    <? echo $dl; ?>
</dl>
</body>
</html>