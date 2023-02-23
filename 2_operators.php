<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Операторский отдел");
?>

<?php

$arRes = CIBlockElement::GetList(
    array('ID' => 'ASC'),
    array('IBLOCK_ID' => 31, 'SECTION_ID' => 221),
    false,
    false,
    array(
        'ID',
        'NAME',
        'DETAIL_PICTURE',
        'PROPERTY_SPECIALTY',
        'PROPERTY_SOC_NUMBER',
        'PROPERTY_PERSONAL_EMAIL',
    )
);

?>
<section class="operator-page content-block">
    <div class="container">
        <h1 class="accentuated"><?= $APPLICATION->ShowTitle() ?></h1>
        <div class="content-inner">
            <div class="block_operator">
                <?
                while ($arItem = $arRes->GetNext()) {

                    $image = '/images/dist/no_photo.png';

                    if ($arItem['DETAIL_PICTURE']) {
                        $image = CFile::GetPath($arItem['DETAIL_PICTURE']);
                    } ?>
                    <div class="operator_item">
                        <div class="photo">
                            <img src="<?= $image ?>" alt="<?= $arItem['NAME'] ?>" />
                            <p class="name"><?= $arItem['NAME'] ?> </p>
                        </div>
                        <div class="description">
                            <p class="specialty">
                                <?= $arItem['PROPERTY_SPECIALTY_VALUE'] ?>
                            </p>
                            <p class="number">
                                <?= $arItem['PROPERTY_SOC_NUMBER_VALUE'] ?>
                            </p>
                            <p class="email">
                                <a href="mailto:<?= $arItem['PROPERTY_PERSONAL_EMAIL_VALUE'] ?>">
                                    <?= $arItem['PROPERTY_PERSONAL_EMAIL_VALUE'] ?>
                                </a>
                            </p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>