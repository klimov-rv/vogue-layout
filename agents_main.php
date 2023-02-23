<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
<? if ($APPLICATION->GetCurPage(false) === '/agentam/') { ?>

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
                                                    while ($ar_res = $res->GetNextElement()) {
                                                        $arFields = $ar_res->GetFields();
                                                        $arProps = $ar_res->GetProperties();
                                                    ?>
                                                        <tr>
                                                            <td><?= $arFields['CREATED_DATE'] ?></td>
                                                            <td><?= $arProps['PROP_EXCHANGE_RATE_DOLLAR']['VALUE'] ?></td>
                                                            <td><?= $arProps['PROP_EXCHANGE_RATE_EURO']['VALUE'] ?></td>
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
                            foreach ($arSectItem['ELEMENTS'] as $key => $arItem) {
                    ?>
                                <input type="button" class="tabs__btn <?php if ($key == 0) {
                                                                            echo 'tabs__btn_active';
                                                                        } ?>" data-id="<?php echo $arItem['CODE']; ?>" value="<?= $arItem['NAME']; ?>" />
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
                            foreach ($arSectItem['ELEMENTS'] as $key => $arItem) {
                    ?>
                                <div class="tabs__pane <?php if ($key == 0) {
                                                            echo 'tabs__pane_show';
                                                        } ?>"><?= $arItem['~DETAIL_TEXT']; ?></div>
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

<? } else { ?>
    <section class="info-page content-block">
        <div class="container">
            <h4 class="accentuated">Агентам</h4>
            <style>
                /* Style the tab */
                .tab {
                    overflow: hidden;
                    display: flex;
                    justify-content: center;
                }

                /* Style the buttons inside the tab */
                .tab button {
                    background-color: inherit;
                    float: left;
                    border: none;
                    outline: none;
                    cursor: pointer;
                    padding: 14px 16px 13px;
                    transition: 0.3s;
                    font-size: 17px;
                    border-bottom: 2px solid transparent;
                }

                /* Change background color of buttons on hover */
                .tab button:hover {
                    background-color: #ddd;
                }

                /* Create an active/current tablink class */
                .tab button.active {
                    /* background-color: #fd780f;
	                color: white;*/
                    border-bottom: 2px solid #319ba5;
                    cursor: default;
                    font-weight: 600;
                }

                /* Style the tab content */
                .tabcontent {
                    display: none;
                    padding: 37px 0px;
                    border-top: none;
                }
            </style>
            <script>
                function openCity(evt, cityName) {
                    var i, tabcontent, tablinks;
                    tabcontent = document.getElementsByClassName("tabcontent");
                    for (i = 0; i < tabcontent.length; i++) {
                        tabcontent[i].style.display = "none";
                    }
                    tablinks = document.getElementsByClassName("tablinks");
                    for (i = 0; i < tablinks.length; i++) {
                        tablinks[i].className = tablinks[i].className.replace(" active", "");
                    }
                    document.getElementById(cityName).style.display = "block";
                    evt.currentTarget.className += " active";
                }
            </script>
            <div class="tab">
                <button class="sub_title tablinks active" onclick="openCity(event, 'tab1')">РЕКЛАМНЫЕ ТУРЫ</button>
                <button class="sub_title tablinks" onclick="openCity(event, 'tab2')">Оплата туров</button>
                <button class="sub_title tablinks" onclick="openCity(event, 'tab3')">Страхование</button>
                <button class="sub_title tablinks" onclick="openCity(event, 'tab4')">Обучение</button>
                <button class="sub_title tablinks" onclick="openCity(event, 'tab5')">СОТРУДНИЧЕСТВО</button>
            </div>
            <div id="tab1" class="tabcontent" style="display: block">
                <div class="content-inner">
                    <div class="content-block__biglist">
                        <ol>
                            <li><span>
                                    <b>Бонусы</b> начисляются в момент бронирования заявки, но имеют статус
                                    <b>«неактивные»;</b>
                                </span></li>
                            <li><span>
                                    <b>Бонусы</b> становятся доступными (<b>«активными»</b>) в день начала тура по
                                    заявке, если
                                    заявка была вовремя оплачена в соответствии с условиями оплаты;
                                </span></li>
                            <li><span>
                                    <b>Бонусы</b> начисляются на заявки, забронированные как полным пакетным туром, так
                                    и на заявки, включающие только услугу проживание;
                                </span></li>
                            <li><span>
                                    <b>Бонусы</b> не начисляются на заявки, которые не содержат услугу проживание;
                                </span></li>
                            <li><span>
                                    <b>Бонусы</b> начисляются на все агентство и ими может воспользоваться любой
                                    менеджер агентства, документально подтвердив, что он является сотрудником данного
                                    агентства;
                                </span></li>
                            <li><span>
                                    <b>Бонусы</b> начисляются пропорционально в соотношении <b>1 бонус = 300 у.е.</b> от
                                    продажи туда (сумма к оплате оператору);
                                </span></li>
                            <li><span>
                                    Использование <b>бонусов</b> происходит по курсу <b>1 бонус = 1 у.е.</b>;
                                </span></li>
                            <li><span>
                                    Активные <b>бонусы</b> можно использовать на оплату рекламного тура, при условии
                                    покрытия не более 50% от стоимости рекламного тура;
                                </span></li>
                            <li><span>
                                    Срок действия <b>бонусов</b> — <b>2 года (24 месяца)</b> с даты их начисления.
                                    Неиспользованные <b>бонусы</b> сгорают.
                                </span></li>
                        </ol>
                    </div>
                </div>
            </div>

            <div id="tab2" class="tabcontent">
                <div class="content-inner">
                    <div class="content-block__biglist">
                        <ol>
                            <li><span>Оплата тура производится в белорусских рублях по установленному на сайте
                                    <b> <a href="http://vtravel.by/">http://vtravel.by/</a> </b> курсу на день оплаты, запросив счет на почту
                                    <b> <a href="mailto:svetlana@vtravel.by">svetlana@vtravel.by</a></b></span></li>
                            <li><span><strong>30%</strong> - первая часть подлежит оплате в срок не позднее <b>3-х банковских
                                        дней</b> со дня подтверждения тура, если более короткий срок не предусмотрен
                                    условиями приобретения авиабилета <b>(time-limit)</b>.</span></li>
                            <li><span><strong>70%</strong> - вторая часть, полная оплата стоимости тура подлежит оплате в срок не
                                    позднее <b> 15 календарных дней</b> до вылета, запросив счет на почту <b><a href="mailto:svetlana@vtravel.by">svetlana@vtravel.by</a></b></span></li>
                            <li><span>При бронировании тура менее чем за <b>15 дней</b> до даты вылета, <strong>100%</strong>
                                    оплата должна быть произведена в течение суток после подтверждения.</span></li>
                            <li><span>Оплата GDS-туров должна быть произведена в размере <strong>100%</strong> после подтверждения
                                    брони в течении <b>1 банковского дня.</b></span></li>
                            <li><span>Заявки по визовым направлениям оплачиваются в размере <strong>100%</strong>, документы
                                    принимаются после полной оплаты туров.</span></li>
                            <li><span>При нарушении сроков оплаты компания <b>ООО "Вог Тревел"</b> оставляет за собой
                                    право снизить агентское вознаграждение, аннулировать заявку или пересчитать ее
                                    стоимость по контрактным ценам.</span></li>
                            <li><span>Туроператор имеет право изменять внутренний курс в <b> одностороннем
                                        порядке.</b></span></li>
                            <li><span>По всем вопросам касательно оплаты просьба писать на почту <b><a href="mailto:svetlana@vtravel.by">svetlana@vtravel.by</a></b> <b><a href="tel:+375295599872">+375 29 5599872</a></b></span></li>
                        </ol>
                    </div>
                </div>
            </div>

            <div id="tab3" class="tabcontent">

                <div class="content-inner">
                    <p>
                        <b>Основными обязанностями туристической компании являются предоставление клиентам качественных
                            услуг и обеспечение их безопасности. Приобретая тур в ООО «Вог Тревел», Вы можете быть
                            спокойны, так как каждый наш клиент застрахован от недоброкачественного отдыха.</b>
                    </p>
                    <p>
                        <b>Нашим партнером является:</b>
                    </p>
                    <p>
                        Закрытое акционерное страховое общество «Имклива Иншуранс»
                        <br>
                        Юридический адрес: Республика Беларусь, г. Минск, 220004, ул. Клары Цеткин, 24,
                        10 этаж
                    </p>

                    <div class="content-block__grid">
                        <div class="content-block__col content-block__col-16">
                            <b class="mb-30">График работы:</b>
                            <br>
                            <span class="mb-25 intext-icon content-block__icon-time">
                                Пн-Чт: 8:30 - 17:30
                            </span>
                            <br>
                            <span class="mb-25 intext-icon content-block__icon-time">
                                Пт: 08:30 - 16:15
                            </span>
                            <br>
                            <span class="mb-25 intext-icon content-block__icon-time">
                                Пт: 08:30 - 16:15
                            </span>
                            <br>
                            <span class="mb-25 intext-icon content-block__icon-time">
                                Сб-Вс: Выходной
                            </span>
                            <br>
                        </div>
                        <div class="content-block__col content-block__col-16">
                            <b class="mb-30">Визовый отдел:</b>
                            <br>
                            <span class="mb-25 intext-icon content-block__icon-mail">
                                <a href="mailto:vera@vtravel.by">vera@vtravel.by</a>
                            </span>
                            <br>
                            <span class="mb-25 intext-icon content-block__icon-time">
                                <a href="tel:+375447737878">+375 44 773-78-78</a>
                            </span>
                            <br>
                        </div>
                        <div class="content-block__col content-block__col-46">
                            <b class="mb-30">Совместно с нашим партнером мы предоставляем следующие услуги:</b>
                            <ol>
                                <li>Страхование от несчастных случаев и болезней на время поездки за границу.</li>
                                <li>Страхование от невылета.</li>
                            </ol>
                            <p>
                                Стоимость услуги страхования от несчастных случаев и болезней на время поездки за
                                границу входит в стоимость тура (за исключением туров, предлагающих только наземное
                                обслуживание).
                            </p>
                            <p>
                                Стоимость услуги страхования от невылета не входит в общую стоимость туров. Ее можно
                                добавить в личном кабинете при бронировании тура, только в момент бронирования тура.
                            </p>
                            <p>
                                При оформлении заявки за 5 и менее дней до вылета добавить страховку нельзя.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div id="tab4" class="tabcontent info-page__education">
                <div class="content-inner">
                    <div class="content-block__grid">
                        <div class="content-block__col content-block__col-46">
                            <div class="content-block__col-inner pr-30">
                                <p>
                                    <b>Уважаемые коллеги, приглашаем Вас в наш авторский релакс-тур в Рас-эль-Хайма
                                        (ОАЭ).
                                        Проживание в лучших отелях эмирата.
                                        В программе тура Вас ждёт много приятных сюрпризов!</b>
                                </p>
                                <p>
                                    <b>Нашим партнером является:</b>
                                </p>
                                <p>
                                    Закрытое акционерное страховое общество «Имклива Иншуранс»
                                    <br>
                                    Юридический адрес: Республика Беларусь, г. Минск, 220004, ул. Клары Цеткин, 24,
                                    10 этаж
                                </p>
                                <div class="content-block__subgrid">
                                    <div class="content-block__col pr-30">
                                        <b class="mb-25">Даты тура:</b>
                                        <br>
                                        <span class="intext-icon content-block__icon-time">
                                            04.12.2022 – 11.12.2022
                                        </span>
                                    </div>
                                    <div class="content-block__col ">
                                        <b class="mb-25">Стоимость:</b>
                                        <br>
                                        <span class="intext-icon content-block__icon-price">
                                            690 USD
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content-block__col content-block__col-26">
                            <p>
                                <b>Почему именно с нами? </b>
                            </p>
                            <p>Мы — туристический оператор, который работает честно как по отношению с агентами, так и с
                                клиентами. Удобство, Качество, Безопасность, ВЫГОДА - то, что определяет наше
                                сотрудничества с Вами!
                            </p>
                            <button class="content-block___button">
                                Подписаться
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tab5" class="tabcontent info-page__education">
                <div class="content-inner">

                    <div class="content-block__grid">
                        <div class="content-block__col content-block__col-36">
                            <div class="content-block__col-inner pr-30">
                                <p>
                                    <b>Уважаемые коллеги!</b>
                                </p>
                                <p>
                                    Туроператор Vogue Travel, лидер в Беларуси по организации путешествий
                                    премиум-класса, благодарит Вас за проявленный интерес к нашей компании и мы будем
                                    рады сотрудничеству.
                                </p>

                                <p>
                                    Выбирая Vogue Travel в качестве надежного партнера, Вы делаете заведомо правильное
                                    решение!
                                </p>

                                <p>
                                    Для начала успешного сотрудничества необходимо:
                                </p>


                                <div class="content-block__biglist content-block__biglist-standart2 ">
                                    <ol>


                                        <li><span class="lh-65">
                                                <b>Зарегистрировать
                                                    <a href="http://online.vtravel.by/register_agency"><span style="color: rgb(253, 120, 15);"><u>Личный Кабинет</u></span></a>
                                                </b>
                                            </span></li>
                                        <li><span>
                                                <b class="mb-10">Заключить ДОГОВОР о сотрудничестве.</b>
                                                <p class="fs-15">
                                                    <a href="/upload/2023_наш с Агентами.docx">- Договор поручения (Договор сотрудничества с ООО "Вог Тревел")</a>
                                                    <br>
                                                    <a href="/upload/ФОРМА_ДОГОВОРА_с_туристами_от_Вог_Тревел.docx">- ПРИЛОЖЕНИЕ 1. Договор оказания туристических услуг от имени ООО "Вог Тревел"</a>
                                                    <br>
                                                    <a href="/upload/Приложение_2_Отчет_к_договору_поручения.docx">- ПРИЛОЖЕНИЕ 2. Акт - отчет </a>
                                                    <br>
                                                    <a href="/upload/ДОВЕРЕННОСТЬ от Вог Тревел 2023.docx">- Доверенность.</a>
                                                    <br>
                                                </p>
                                            </span></li>
                                        <li><span>
                                                <b>Отправить пакет документов по почте. Подписанный договор в 2-х
                                                    экземплярах и копию свидетельства о государственной регистрации с
                                                    печатью по адресу: РБ, 220002, г. Минск, пл. Свободы, 23-21а.</b>
                                            </span></li>
                                    </ol>
                                </div>


                                <p>
                                    <b>Поздравляем, Вы наш Партнер!</b>
                                </p>
                                <p>
                                    Также рекомендуем:
                                </p>

                                <p>
                                    - <a href="#" target="_blank">Скачать Отчет Комиссионера</a>, в дальнейшей работе
                                    Вам он точно пригодится!
                                </p>

                                <p>
                                    - Подписаться на РАССЫЛКУ наших предложений, будьте в курсе наших АКЦИЙ!
                                </p>

                                <p>
                                    - По всем интересующим Вас вопросам просьба писать на почту операторского отдела
                                    <a href="mailto:agent@vtravel.by">agent@vtravel.by</a>
                                </p>
                                <form class="form-subscription">
                                    <div class="header-form">
                                        <b class="form-subscription__title">Хотите получать наши новости?</b>
                                    </div>
                                    <div class="body-form form-row justify-content-center">
                                        <div class="form-input col-auto">
                                            <input type="email" name="email" maxlength="85" required placeholder="Email...">
                                        </div>
                                        <div class="form-subscription__col-button">

                                            <button type="submit" class="button-subscription">
                                                Подписаться
                                            </button>
                                        </div>
                                    </div>
                                    <div class="footer-form">
                                        <div class="user_agreement">
                                            <p>Нажимая кнопку, я принимаю <a href="#" target="_blank">соглашение о конфиденциальности</a> и соглашаюсь с обработкой персональных данных
                                            </p>
                                        </div>
                                    </div>
                                </form>


                            </div>
                        </div>

                        <div class="content-block__col content-block__col-36">
                            <div class="tallphoto">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<? }  ?>
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