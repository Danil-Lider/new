<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Главная');

// define("NEED_AUTH", true);

// if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0) 
//   LocalRedirect($backurl);


?> 

<div class="container">
  <div class="w-100 mt-5 mb-3">перейти на страницу <a href="/cupon/">получения купона</a></div>
</div>

<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>