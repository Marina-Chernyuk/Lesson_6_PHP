
<?php
// htmlspecialchars — преобразует специальные символы в HTML-сущности
$number1 = strip_tags(htmlspecialchars($_POST['number1']));
$number2 = strip_tags(htmlspecialchars($_POST['number2']));
$operation = $_POST['operation'];

if (isset($_POST['operation'])) {
    if ($number1 === "" || $number2 === "") {
        $result = "Введите корректные данные";
    }
    // Проверка на валидность
    if (!$operation || (!$number1 && $number1 != '0') || (!$number2 && $number2 != '0')) {
        $error_result = 'Не все поля заполнены';
    } else {

        if (!is_numeric($number1) || !is_numeric($number2)) {
            $error_result = "Операнды должны быть числами";
        } else {
            switch ($_POST['operation']) {
                case 'plus':
                    $result = $number1 + $number2;
                    break;
                case 'minus':
                    $result = $number1 - $number2;
                    break;
                case 'multiply':
                    $result = $number1 * $number2;
                    break;
                case 'divide':
                    if ($number2 == 0) {
                        $result = "На ноль делить нельзя";
                    } else {
                        $result = $number1 / $number2;
                    }
                    break;
                default:
                    $result = "Что-то пошло не так";
                    break;
            }
        }
    }

    var_dump($_POST);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/styles1.css" type="text/css" />
    <title>Calc2</title>
</head>
<body>

<form action='' method='post' class="calculate-form">
    <h1>КАЛЬКУЛЯТОР 2</h1>

    <input type="number" name="number1" value="<?= $number1 ?>" class="number_calculation" placeholder="Первое число">

    <input type="number" name="number2" value="<?= $number2 ?>" class="number_calculation" placeholder="Второе число">
    <div class="operations" name="operation">
        <input type="submit" name="operation" value="plus" class="calculation">
        <input type="submit" name="operation" value="minus" class="calculation">
        <input type="submit" name="operation" value="multiply" class="calculation">
        <input type="submit" name="operation" value="divide" class="calculation">
    </div>
    <div class='answer-text'><b>Результат: <?= $result ?></b></div>
</form>
</body>
</html>