<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Главная');

global $USER;
?>

<? if ($USER->IsAuthorized()){?> 

<div class="container">
<main class="form-signin">
  <form class="GetCupon" name="GetCupon" action="/cupon/cupon_model.php" method="POST">
  	<input type="hidden" name="GetCupon" value="1">
    <div class="succes green"></div>
    <button class="w-100 btn btn-lg btn-success mt-5 mb-3" type="submit">Получить скидку</button>
  </form>
   <form class="Check" name="Check" action="/cupon/cupon_model.php" method="POST">
    <div class="form-floating">
      <input  name="CheckCupon" class="form-control" id="CheckCupon" placeholder="CheckCupon">
      <label for="CheckCupon"></label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Проверить скидку</button>
  </form>
</main>
</div>

<? }else{ ?>

  <div class="container">
    Вы не авторизованы, чтобы получить скидку <a href="/auth/">авторизуйтесь</a>
  </div>

<? } ?>



<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>