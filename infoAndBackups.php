bitrix/templates/.default/components/bitrix/news/agent/bitrix/news.list/.default/template.php

<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<!-- agentam/index.php -->
<section class="operator_department">
    <div class="container">
        <div class="hotels_title">
            <h1>Агентам</h1>
        </div>
        <?php
        $res = CIBlockElement::GetList(
            [
                "ID" => "DESC"
            ],
            [
                'IBLOCK_ID' => 33,
                'ACTIVE' => 'Y'
            ],
            false,
            false,
            []
        );

        if ($res->SelectedRowsCount()) {
            ?>
            <div class="block_courses">
                <div class="content_courses" x-data="{modalShow: false}">
                    <div class="showCourses">
                        <input type="button" @click="modalShow = true" class="" value="Архив Курсов" />
                    </div>

                    <div x-show.transition.in.opacity.duration.500ms.out.duration.400ms="modalShow" class="pos-fixed pos0-l pos0-t h100 w100 z-index99 bg-op60" x-cloak>
                        <div @click.away="modalShow = false" class="pos-absolute w100 bg-white w600px-max" style="left: 50%; top: 7%; transform: translate(-50%, -50%); border-radius: 10px">
                            <div id="modalCourses">
                                <div class="courses">
                                    <div class="content">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Дата</th>
                                                <th>$</th>
                                                <th>€</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            while($ar_res = $res->GetNextElement()) {
                                                $arFields = $ar_res->GetFields();
                                                $arProps = $ar_res->GetProperties();
                                                ?>
                                                <tr>
                                                    <td><?=$arFields['CREATED_DATE']?></td>
                                                    <td><?=$arProps['PROP_EXCHANGE_RATE_DOLLAR']['VALUE']?></td>
                                                    <td><?=$arProps['PROP_EXCHANGE_RATE_EURO']['VALUE']?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <button class="close" title="Закрыть" @click="modalShow = false"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="tabs">
            <div class="tabs__nav tabs__nav_with-hash">
                <?php foreach ($arResult['ITEMS'] as $arSectItem) {
                    if ($arSectItem['ID'] == 219) {
                        foreach($arSectItem['ELEMENTS'] as $key => $arItem) {
                   ?>
                    <input type="button" class="tabs__btn <?php if($key == 0) { echo 'tabs__btn_active'; } ?>" data-id="<?php echo $arItem['CODE']; ?>" value="<?=$arItem['NAME'];?>" />
                <?php
                        }
                    } /*else { ?>
                        <input type="button" class="tabs__btn" data-id="<?php echo $arSectItem['CODE']; ?>" value="<?=$arSectItem['NAME'];?>" />
                   <?php } */
                } ?>
            </div>

            <div class="tabs__content">
                <?php foreach ($arResult['ITEMS'] as $arSectItem) {
                    if ($arSectItem['ID'] == 219) {
                        foreach($arSectItem['ELEMENTS'] as $key => $arItem) {
                    ?>
                       <div class="tabs__pane <?php if($key == 0) { echo 'tabs__pane_show'; } ?>"><?=$arItem['~DETAIL_TEXT'];?></div>
                    <?php }

                    } /*else { ?>
                        <div class="tabs__pane">
                            <div class="block_operator">
                               <?php foreach($arSectItem['ELEMENTS'] as $key => $arItem) {

                                    $image = '/images/dist/no_photo.png';

                                    if ($arItem['DETAIL_PICTURE']) {
                                        $image = $arItem['DETAIL_PICTURE']['SRC'];
                                    } ?>
                                    <div class="operator_item">
                                        <div class="photo">
                                            <img src="<?=$image?>" alt="<?=$arItem['ID']?>" />
                                        </div>
                                        <div class="description">
                                            <p class="name">
                                                <?=$arItem['NAME']?>
                                            </p>
                                            <p class="specialty">
                                                <?=$arItem['PROPERTIES']['SPECIALTY']['VALUE']?>
                                            </p>
                                            <p class="number">
                                                <?=$arItem['PROPERTIES']['SOC_NUMBER']['VALUE']?>
                                            </p>
                                            <p class="email">
                                                <a href="mailto:<?=$arItem['PROPERTIES']['PERSONAL_EMAIL']['VALUE']?>">
                                                    <?=$arItem['PROPERTIES']['PERSONAL_EMAIL']['VALUE']?>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                               <?php } ?>
                            </div>
                        </div>
                <?php } */
                } ?>
            </div>
        </div>
    </div>
</section>

<section id="formSubscription" class="form-subscription">
    <div class="container form-subscription-container">
        <form id="agentSubscription" action="" method="POST">
            <div class="header-form">
                <h2 class="title">Хотите получать наши новости?</h2>
                <button id="sendAgentSubscription" class="button-subscription">
                    Подписаться
                </button>
            </div>
            <div class="body-form">
                <div class="form-input">
                    <input type="email" id="agent-email" name="email" maxlength="85" required placeholder="E-mail" />
                </div>
            </div>
            <div class="footer-form">
                <div class="user_agreement">
                    <p>Нажимая кнопку, я принимаю <a href="#" target="_blank">соглашение о конфиденциальности</a> и соглашаюсь с обработкой персональных данных</p>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- news/agent/news.php -->

<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<?if($arParams["USE_RSS"]=="Y"):?>
	<?
	if(method_exists($APPLICATION, 'addheadstring'))
		$APPLICATION->AddHeadString('<link rel="alternate" type="application/rss+xml" title="'.$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["rss"].'" href="'.$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["rss"].'" />');
	?>
	<a href="<?=$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["rss"]?>" title="rss" target="_self"><img alt="RSS" src="<?=$templateFolder?>/images/gif-light/feed-icon-16x16.gif" border="0" align="right" /></a>
<?endif?>

<?if($arParams["USE_SEARCH"]=="Y"):?>
<?=GetMessage("SEARCH_LABEL")?><?$APPLICATION->IncludeComponent(
	"bitrix:search.form",
	"flat",
	Array(
		"PAGE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["search"]
	),
	$component
);?>
<br />
<?endif?>
<?if($arParams["USE_FILTER"]=="Y"):?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.filter",
	"",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"FILTER_NAME" => $arParams["FILTER_NAME"],
		"FIELD_CODE" => $arParams["FILTER_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["FILTER_PROPERTY_CODE"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
	),
	$component
);
?>
<br />
<?endif?>

<? if ($APPLICATION->GetCurPage(false) === '/agentam/') {?> 

	<?$APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"",
		Array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"NEWS_COUNT" => $arParams["NEWS_COUNT"],
			"SORT_BY1" => $arParams["SORT_BY1"],
			"SORT_ORDER1" => $arParams["SORT_ORDER1"],
			"SORT_BY2" => $arParams["SORT_BY2"],
			"SORT_ORDER2" => $arParams["SORT_ORDER2"],
			"FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
			"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
			"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
			"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
			"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
			"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
			"SET_TITLE" => $arParams["SET_TITLE"],
			"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
			"MESSAGE_404" => $arParams["MESSAGE_404"],
			"SET_STATUS_404" => $arParams["SET_STATUS_404"],
			"SHOW_404" => $arParams["SHOW_404"],
			"FILE_404" => $arParams["FILE_404"],
			"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_FILTER" => $arParams["CACHE_FILTER"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
			"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
			"PAGER_TITLE" => $arParams["PAGER_TITLE"],
			"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
			"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
			"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
			"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
			"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
			"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
			"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
			"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
			"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
			"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
			"PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
			"ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
			"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
			"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
			"FILTER_NAME" => $arParams["FILTER_NAME"],
			"HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
			"CHECK_DATES" => $arParams["CHECK_DATES"],
		),
		$component
	);?>
<?} else { ?>
<div class="dev123">dev</div>

	<?$APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"",
		Array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"NEWS_COUNT" => $arParams["NEWS_COUNT"],
			"SORT_BY1" => $arParams["SORT_BY1"],
			"SORT_ORDER1" => $arParams["SORT_ORDER1"],
			"SORT_BY2" => $arParams["SORT_BY2"],
			"SORT_ORDER2" => $arParams["SORT_ORDER2"],
			"FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
			"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
			"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
			"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
			"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
			"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
			"SET_TITLE" => $arParams["SET_TITLE"],
			"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
			"MESSAGE_404" => $arParams["MESSAGE_404"],
			"SET_STATUS_404" => $arParams["SET_STATUS_404"],
			"SHOW_404" => $arParams["SHOW_404"],
			"FILE_404" => $arParams["FILE_404"],
			"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_FILTER" => $arParams["CACHE_FILTER"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
			"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
			"PAGER_TITLE" => $arParams["PAGER_TITLE"],
			"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
			"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
			"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
			"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
			"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
			"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
			"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
			"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
			"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
			"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
			"PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
			"ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
			"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
			"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
			"FILTER_NAME" => $arParams["FILTER_NAME"],
			"HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
			"CHECK_DATES" => $arParams["CHECK_DATES"],
		),
		$component
	);?>
<? } ?> 