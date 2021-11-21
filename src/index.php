<?php
use Src\Lib\Main\Models\User;

require_once "../vendor/autoload.php";

$request = \Src\Lib\Main\Web\Http::getRequest();
var_dump($request->get('ok'));

//$sql = User::query()->where('id', 1)->setSelect(['*'])->fetch();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Форма</title>
</head>
<body>
<form action="/" method="post">
    <fieldset>
        <legend>Текстовые поля</legend>
        <label> Ваше имя:
            <input type="text" placeholder="Имя" name="firstname" id="firstname">
        </label>
        <label> Ваш email:
            <input type="email" placeholder="Email" name="email" id="email">
        </label>
        <label>Текст сообщения:</label>
        <div class="radio">
            <span>Пол</span>
            <label>
                <input type="radio" name="sex" id="sex" value="мужской">мужской
                <div class="radio-control male"></div><br>
            </label>
            <label>
                <input type="radio" name="sex" id="sex" value="женский">женский
                <div class="radio-control female"></div>
            </label>
        </div>
        <label for="country">Страна</label>
        <select name="country">
            <option>Выберите страну проживания</option>
            <option  value="Россия">Россия</option>
            <option value="Украина">Украина</option>
            <option value="Беларусь">Беларусь</option>
        </select>
        <label><textarea name="other" placeholder="Введите ваше сообщение"></textarea><label>
    </fieldset>
</form>
</body>
</html>

$first_name = $_POST['firstname'];
$email = $_POST['email'];
$sex = $_POST['sex'];
$country = $_POST['country'];
$other = $_POST['other'];