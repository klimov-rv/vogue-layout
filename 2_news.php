<?   ?> 
<!-- novosti/index.php -->

<!-- <section id="news" class="news">
        <div class="container"> -->
            
<!-- меняем на  -->


<!-- <section class="news-page content-block">
            <div class="container"> -->
                <?  $news_number = 0; 
                ?>

<h4 class="accentuated">Новости</h4>

<div class="content-inner news-block">

    <div class="news-block__itemslist">
        <?if($arParams["DISPLAY_TOP_PAGER"]):?>
            <?=$arResult["NAV_STRING"]?><br />
        <?endif;?>
        <div class="content-block__grid">
            <div class="content-block__col content-block__col-46">
            <?foreach($arResult["ITEMS"] as $arItem):?>
            <?
            $news_number++;
            if ($news_number == 8) { ?>
                </div>
                <div class="content-block__col content-block__col-26"> 
            <? }
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
                <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])) {
                    $FILE = CFile::GetFileArray($arItem["PREVIEW_PICTURE"]["ID"]);
                    $renderImg = CFile::ResizeImageGet($FILE , Array("width" => 900, "height" => 500), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false);
                    ?> 
                <div class="news-block news-block__bg" style="background-image: url('<?=$renderImg["src"]?>');">
                <? } else { ?>
                <div class="news-block news-block__bg" style="background-image: url('<?=$renderImg["src"]?>');">
                <? } ?>
                    <div class="news-block__img-filter"></div>
                    <div class="content-block content-block__inner">
                        <div class="news-block__info">
                            <h5 class="sub_title">
                                <?echo $arItem["NAME"]?>
                            </h5>
                            <p class="sub_text">
                                <?echo strip_tags($arItem["PREVIEW_TEXT"]);?>
                            </p>
                            
                        </div>
                        <div class="news-block___button-wrap">
                            <a class="news-block___button" href="<?=$arItem["DETAIL_PAGE_URL"]?>">Подробнее</a>
                        </div>
                    </div>
                </div>  
            <?endforeach;?>
            </div>  
        </div>
    </div>
</div>
<?   ?>