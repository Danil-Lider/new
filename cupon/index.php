<?
define('STOP_STATISTICS', true);
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
$GLOBALS['APPLICATION']->RestartBuffer();






use Bitrix\Main\Loader; 

Loader::includeModule("highloadblock"); 

use Bitrix\Highloadblock as HL; 
use Bitrix\Main\Entity;


global $USER;
CModule::IncludeModule("iblock");


function debug($item){
	echo "<pre>";
	print_r($item);
	echo "</pre>";
}

function checkUserCupon(){

	global $USER;

	$rsUser = CUser::GetByID($USER->GetID());

	$arUser = $rsUser->Fetch();

	return $arUser['UF_CUPON'];
}

function getCuponNum(){
	return random_int(1, 50);
}

function genCuponString(){
	$razreshenniye_simvoli = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	return substr(str_shuffle($razreshenniye_simvoli), 0, 20);
}

function addInHighloadBlock($UF_KOD_CUPONA,$UF_NUM){

	$hlbl = 2; // Указываем ID нашего highloadblock блока к которому будет делать запросы.
	$hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch(); 

	$entity = HL\HighloadBlockTable::compileEntity($hlblock); 
	$entity_data_class = $entity->getDataClass(); 

   // Массив полей для добавления
   $data = array(
      "UF_KOD_CUPONA"=> $UF_KOD_CUPONA,
      "UF_NUM"=> $UF_NUM,
      "UF_DATE_GEN"=>date("d.m.Y H:i:s")
   );

   $result = $entity_data_class::add($data);

   return $result;

}

function addCuponForUser($cupon_id){
	global $USER;
	$user = new CUser;
	$USER_ID = $USER->GetID();
	$fields = Array(
		"UF_CUPON" => $cupon_id,
	 );

	$user->Update($USER_ID, $fields);
	$strError = $user->LAST_ERROR;

	return $strError;
}

// IF USER HAVE COUPON

function checkUserCuponDateById($ID){

	$hlbl = 2; // Указываем ID нашего highloadblock блока к которому будет делать запросы.
	$hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch(); 

	$entity = HL\HighloadBlockTable::compileEntity($hlblock); 
	$entity_data_class = $entity->getDataClass(); 

	$rsData = $entity_data_class::getList(array(
	   "select" => array("*"),
	   "order" => array("ID" => "ASC"),
	   "filter" => array("ID"=>$ID)  // Задаем параметры фильтра выборки
	));

	while($arData = $rsData->Fetch()){
	   $res[] = $arData;
	}

	return $res;
}

// END 


if($_REQUEST['GetCupon']){	
	// Проверка у пользователя наличия купона

	$userCuponId = checkUserCupon();

	if(empty($userCuponId)){

		$UF_KOD_CUPONA = genCuponString();
		$UF_NUM = getCuponNum();

		echo "Скидка доступна, скидка: ";
		echo $UF_NUM;
		echo "</br>Код скидки: ";
		echo $UF_KOD_CUPONA;
		echo "%";

		$res = addInHighloadBlock($UF_KOD_CUPONA,$UF_NUM);

		$cupon_id = $res->getId();

		$err = addCuponForUser($cupon_id);



	}else{



		$res = checkUserCuponDateById($userCuponId);
		$date = date($res[0]['UF_DATE_GEN']);

		// debug($date);

		$dateDeactivedCupon = date('d.m.Y H:i:s', strtotime($date. ' + 1 hours'));

		// debug($dateDeactivedCupon);

		$now_date = date('d.m.Y H:i:s');
		// strtotime

		// CHECK IF NOW DATE BIGGER THEN DateDeactivedCupon

		if(strtotime($now_date) > strtotime($dateDeactivedCupon)) {

			echo "Скидка недоступна";

		}else{

			// echo "У пользователя есть Купон, ID: " . $userCuponId;
			echo "</br>Скидка доступна:</	br>" . $res['0']['UF_NUM'] . '%  <br> код:' . $res['0']['UF_KOD_CUPONA'];	

		}
		

	}

	
}
























function CheckCuponByUfKodCupona($UF_KOD_CUPONA){

	$hlbl = 2; // Указываем ID нашего highloadblock блока к которому будет делать запросы.
	$hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch(); 

	$entity = HL\HighloadBlockTable::compileEntity($hlblock); 
	$entity_data_class = $entity->getDataClass(); 

	$rsData = $entity_data_class::getList(array(
	   "select" => array("*"),
	   "order" => array("ID" => "ASC"),
	   "filter" => array("UF_KOD_CUPONA"=>$UF_KOD_CUPONA)  // Задаем параметры фильтра выборки
	));

	while($arData = $rsData->Fetch()){
	   $res[] = $arData;
	}

	return $res;
}


if($_REQUEST['CheckCupon']){

	$UF_KOD_CUPONA = $_REQUEST['CheckCupon'];

	$res = CheckCuponByUfKodCupona($UF_KOD_CUPONA);

	if($res){

		$date = date($res[0]['UF_DATE_GEN']);

		$dateDeactivedCuponAlways = date('d.m.Y H:i:s', strtotime($date. ' + 3 hours'));

		$now_date = date('d.m.Y H:i:s');
		// strtotime

		// CHECK IF NOW DATE BIGGER THEN DateDeactivedCupon

		if(strtotime($now_date) > strtotime($dateDeactivedCuponAlways)) {

			echo "Скидка недоступна";

		}else{

			// echo "У пользователя есть Купон, ID: " . $userCuponId;
			echo "</br>Скидка доступна:</	br>" . $res['0']['UF_NUM'] . '%';	

		}

	}else{
		echo "Скидка недоступна(её нету, либо не правильно ввели)";
	}


}