<h1>Привет,не судите строго)) писал около 4-5 часов</h1>

После прочтения тз, решил использовать Highload-блоки + 1 пользовательское для привязке к этим элементам.

Суть просто, создаем  Highload-блоки с 3 полями:UF_KOD_CUPONA(Строка),UF_NUM(Число) и UF_DATE_GEN(Дата со временем)

и 1 пользовательское поле UF_CUPON(Привязка к элементам highload-блоков) по ID

Далее делаем 2 формы,чисто html :
	1 форма для получения купона и скидки соотвественно
	2 форма для проверки купона

ну и делаем обработчик.

Если в кратце обработчик очень просто, т.к буквально используем время генерации Купона, и в зависимости от условий 
предоставляем данные.

<h2>Дополнительно</h2>

Дабы не делать что-то лишнее использовал стандартую авторизацию и регистраци.

Чтобы несного ускориться испльзовал пустой шаблон, jquery и bootsratp 

ссылка на сам сайт: http://apclean.ru/

псс.. Первый раз пишу сам файлик readmi.md
