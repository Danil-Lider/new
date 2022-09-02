<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Главная');

// define("NEED_AUTH", true);

// if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0) 
//   LocalRedirect($backurl);


?> 

<div class="container">
<main class="form-signin">


  <form class="GetCupon" name="GetCupon" action="/cupon/" method="POST">
  	<input type="hidden" name="GetCupon" value="1">
    <div class="succes green"></div>
    <button class="w-100 btn btn-lg btn-success mt-5 mb-3" type="submit">Получить скидку</button>
  </form>


   <form class="Check" name="Check" action="/cupon/" method="POST">
    <div class="form-floating">
      <input  name="CheckCupon" class="form-control" id="CheckCupon" placeholder="CheckCupon">
      <label for="CheckCupon"></label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Проверить скидку</button>
  </form>


</main>
</div>

<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>