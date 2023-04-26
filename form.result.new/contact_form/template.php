<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>

<?=$arResult["FORM_NOTE"]?>

<?if ($arResult["isFormNote"] != "Y")
{
?>
    <div class="contact-form">
        <div class="contact-form__head">
            <?
            if ($arResult["isFormDescription"] == "Y" || $arResult["isFormTitle"] == "Y" || $arResult["isFormImage"] == "Y")
            {
                if ($arResult["isFormTitle"])
                {
                    ?>
                    <div class="contact-form__head-title"><?=$arResult["FORM_TITLE"]?></div>
                    <?
                } //endif ;

                if ($arResult["isFormImage"] == "Y")
                {
                    ?>
                    <a href="<?=$arResult["FORM_IMAGE"]["URL"]?>" target="_blank" alt="<?=GetMessage("FORM_ENLARGE")?>"><img src="<?=$arResult["FORM_IMAGE"]["URL"]?>" <?if($arResult["FORM_IMAGE"]["WIDTH"] > 300):?>width="300"<?elseif($arResult["FORM_IMAGE"]["HEIGHT"] > 200):?>height="200"<?else:?><?=$arResult["FORM_IMAGE"]["ATTR"]?><?endif;?> hspace="3" vscape="3" border="0" /></a>
                    <?//=$arResult["FORM_IMAGE"]["HTML_CODE"]?>
                    <?
                } //endif
                ?>
                <div class="contact-form__head-text"><?=$arResult["FORM_DESCRIPTION"]?></div>,
                <?
            } // endif
            ?>
        </div>
    <?=str_replace("<form", '<form class="contact-form__form" ', $arResult["FORM_HEADER"]);?>
        <form name="<?=$arResult["WEB_FORM_NAME"]?>" class="contact-form__form" action="<?=POST_FORM_ACTION_URI?>" method="POST">
            <input type="hidden" name="WEB_FORM_ID" value="<?=$arParams["WEB_FORM_ID"]?>">
            <?=bitrix_sessid_post()?>

            <div class="contact-form__form-inputs">
            <?
            foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
            {
                if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden')
                {
                    echo $arQuestion["HTML_CODE"];
                }
                else if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'textarea')
                {
                            continue;
                        }
                else
                    { ?>
                        <div class="input contact-form__input">
                            <label class="input__label" for="medicine_name">
                                <div class="input__label-text"><?=$arQuestion["CAPTION"]?></div>
                                    <?=$arQuestion["HTML_CODE"]?>

                                <? if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'text')
                                    { ?>
                                        <div class="input__notification">Поле должно содержать не менее 3-х символов</div>

                                <?} else if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'email')
                                    { ?>
                                        <div class="input__notification">Неверный формат почты</div>
                                    <? } ?>
                            </label>
                        </div>
                    <? }
                }
            ?>
            </div>
            <div class="contact-form__form-message">
                <div class="input"><label class="input__label" for="medicine_message">
                        <div class="input__label-text"><?=$arQuestion["CAPTION"]?></div>
                            <?=$arQuestion["HTML_CODE"]?>
                        <div class="input__notification"></div>
                    </label></div>
            </div>
            <div class="contact-form__bottom">
                <div class="contact-form__bottom-policy">Нажимая &laquo;Отправить&raquo;, Вы&nbsp;подтверждаете, что
                    ознакомлены, полностью согласны и&nbsp;принимаете условия &laquo;Согласия на&nbsp;обработку персональных
                    данных&raquo;.
                </div>
                <input class="form-button contact-form__bottom-button" <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" />
                <?if ($arResult["F_RIGHT"] >= 15):?>
                    &nbsp;<input type="hidden" name="web_form_apply" value="Y" /><input type="hidden" name="web_form_apply" value="<?=GetMessage("FORM_APPLY")?>" />
                <?endif;?>
            </div>
        </form>
    </div>
    <?=$arResult["FORM_FOOTER"]?>
    <?
}?>