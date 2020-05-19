<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/styles/application.css');
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>

<!-- Вешаем cookie для определения использования JavaScript у пользователя: -->
<script>
	var antispam = $.cookie('antispam');
	console.log ('Antispam: ON '+antispam);
	if (antispam !== '1') {
		console.log ('111111');
		$.cookie('antispam', '1');
		window.location.reload();
	}
</script>
 <? if ($_COOKIE['antispam'] == 1) {?>


<div class="CApplication">
	<?php if ($arResult['OK_MESSAGE']) { ?>
	<div style="text-align: center;"><br><h3><?= $arResult['OK_MESSAGE'] ?></h3></div>
	<?php } else { ?>
		<form id="iblock_add" action="<?=POST_FORM_ACTION_URI?>" method="POST">
			<?=bitrix_sessid_post()?>
			<!-- <h2><?//= $arResult['TITLE'] ?></h2> -->
			<input type="text" required="required" placeholder="Ваше имя" name="user_name" value="<?=$arResult["AUTHOR_NAME"]?>" maxlength="50">

			<input type="email" required="required" placeholder="Email" name="user_email" value="<?=$arResult["AUTHOR_EMAIL"]?>" maxlength="50">

			<input type="tel" required="required" placeholder="Телефон" name="user_phone" value="<?=$arResult["AUTHOR_PHONE"]?>" maxlength="50">

			<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">

			<button type="submit" name="submit" value="<?=GetMessage("MFT_SUBMIT")?>" class="btn btn-danger" style="margin-left: 35px;">Перезвоните мне</button>
		</form>
	<?php } ?>
</div>

<script>
	//Добавляем проверку наведения курсора на поле Имя:
	var checkField = "1";

	$( document ).ready(function() {

		$('input[name="user_name"]').mouseenter(function(){
		checkField = ('Курсор мыши был проведен над полем');
		});
		$('input[name="user_name"]').focus(function(){
			checkField = ('Курсор мыши был проведен над полем');
		})
	});

	//Подключаем обработчик отправки:
	$("#iblock_add").submit(function () {

	if (checkField == 1) { // Если курсор не вводился в поле Имя, скрываем форму

	$("#iblock_add").hide();
	setTimeout( function(){alert('Благодарим вас за ваше сообщение!');}, 500 );

	return false; //Завершение
	} else {
		return true;
	}
	});
</script>

<?}?>