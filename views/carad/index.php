<?php
/** @var string $title */
/** @var string $pagination */
/** @var string $total_count_of_found_ads */
/** @var array $data */
/** @var array $auto_complete */

use core\Core;

Core::getInstance()->pageParams['title'] = $title;
?>
<main class="main main-car-ad-index d-flex flex-column justify-content-between" style="row-gap: 30px">
    <div class="container container-car-ad-index " >
        <?php if (!empty($data["ads"])): ?>
            <div class="mb-3 d-flex align-items-start align-items-md-center justify-content-md-between gap-3 flex-column flex-md-row flex" >
                <button data-bs-toggle="modal" data-bs-target="#filter-open-modal" type="button" class="btn btn-success btn-filter fw-bold"><i class="fa-solid fa-filter pe-1"></i>Фільтрація та сортування</button>
                <p class="m-0 h4 fw-bold">За Вашим запитом знайдено оголошень: <span style="font-weight: 1000"><?=$total_count_of_found_ads?></span></p>
            </div>
            <div class="modal modal-filter-open-modal fade" id="filter-open-modal" tabindex="-1" aria-hidden="false">
                <div class="modal-dialog modal-dialog-centered" style="max-width: 800px !important;" >
                    <form action="" method="post" style="border-radius: 25px;" class="modal-content">
                        <div class="modal-header py-2">
                            <h5 class="modal-title">Фільтрація</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body py-3 d-flex flex-column flex-md-row ">
                            <div class="col-12 col-md-6 pe-md-3">
                                <div class="mb-2">
                                    <select name="car_brand_id"  class="form-select" id="inputCarBrand" >
                                        <option value="-1" disabled selected>Марка</option>
                                        <?php foreach ($data["car_brands"] as $item) : ?>
                                            <?php if ($auto_complete["car_brand_id"] == $item["id"]) : ?>
                                                <option selected value="<?=$item["id"]?>"><?=$item["name"]?></option>
                                            <?php else : ?>
                                                <option value="<?=$item["id"]?>"><?=$item["name"]?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <select name="car_model_id"  class="form-select" id="inputCarModel" >
                                        <option value="-1" disabled selected >Оберіть модель</option>
                                        <?php if (!empty($auto_complete["car_models"])) : ?>
                                            <?php foreach ($auto_complete["car_models"] as $item) : ?>
                                                <?php if ($auto_complete["car_model_id"] == $item["id"]) : ?>
                                                    <option selected value="<?=$item["id"]?>"><?=$item["name"]?></option>
                                                <?php else : ?>
                                                    <option value="<?=$item["id"]?>"><?=$item["name"]?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="mb-2 mb-md-0">
                                    <select name="region_id"  class="form-select" id="inputRegion" >
                                        <option value="-1" disabled selected >Область</option>
                                        <?php foreach ($data["regions"] as $item) : ?>
                                            <?php if ($auto_complete["region_id"] == $item["id"]) : ?>
                                                <option selected value="<?=$item["id"]?>"><?=$item["name"]?></option>
                                            <?php else : ?>
                                                <option value="<?=$item["id"]?>"><?=$item["name"]?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-2">
                                <div class="mb-2 d-flex gap-1 align-items-center">
                                    <label for="inputYearFrom" class="form-label m-0">Рік:&nbsp;</label>
                                    <select name="year_from"  class="form-select" id="inputYearFrom" >
                                        <option value="-1" disabled selected >Від</option>
                                        <?php for ($i = date("Y"); $i >= 1900; $i--) : ?>
                                            <?php if ($auto_complete["year_from"] == $i) : ?>
                                                <option selected value="<?=$i?>"><?=$i?></option>
                                            <?php else : ?>
                                                <option value="<?=$i?>"><?=$i?></option>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </select>
                                    <select name="year_to"  class="form-select" id="inputYearTo" >
                                        <option value="-1" disabled selected >До</option>
                                        <?php for ($i = date("Y"); $i >= 1900; $i--) : ?>
                                            <?php if ($auto_complete["year_to"] == $i) : ?>
                                                <option selected value="<?=$i?>"><?=$i?></option>
                                            <?php else : ?>
                                                <option value="<?=$i?>"><?=$i?></option>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="mb-2 d-flex gap-1 align-items-center">
                                    <label for="inputPriceFrom" class="form-label m-0">Ціна&nbsp;$:&nbsp;</label>
                                    <input  value="<?=$auto_complete['price_from']?>" name="price_from" type="text" placeholder="Від" class="form-control inputPrice" id="inputPriceFrom" >
                                    <input  value="<?=$auto_complete['price_to']?>" name="price_to" type="text" placeholder="До" class="form-control inputPrice" id="inputPriceTo" >
                                </div>
                                <div class="d-flex align-items-center">
                                    <label for="inputPriceFrom" class="form-label m-0">Сортувати&nbsp;за:&nbsp;</label>
                                    <select name="order_by"  class="form-select" id="inputOrderBy" >
                                        <option <?php if (!isset($_GET["order_by"])) : ?>selected<?php endif;?> value="default" >По замовчуванню</option>
                                        <option <?php if (isset($_GET["order_by"]) && $_GET["order_by"] == "price-low-high") : ?>selected<?php endif;?> value="price-low-high" >Від дешевих до дорогих</option>
                                        <option <?php if (isset($_GET["order_by"]) && $_GET["order_by"] == "price-high-low") : ?>selected<?php endif;?> value="price-high-low" >Від дорогих до дешевих</option>
                                        <option <?php if (isset($_GET["order_by"]) && $_GET["order_by"] == "year-high-low") : ?>selected<?php endif;?> value="year-high-low" >Рік випуску, за зростанням</option>
                                        <option <?php if (isset($_GET["order_by"]) && $_GET["order_by"] == "year-low-high") : ?>selected<?php endif;?> value="year-low-high" >Рік випуску, за спаданням</option>
                                        <option <?php if (isset($_GET["order_by"]) && $_GET["order_by"] == "mileage-high-low") : ?>selected<?php endif;?> value="mileage-high-low" >Пробіг, за зростанням</option>
                                        <option <?php if (isset($_GET["order_by"]) && $_GET["order_by"] == "mileage-low-low") : ?>selected<?php endif;?> value="mileage-low-low" >Пробіг, за спаданням</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer py-2">
                            <button type="button" class="btn btn-no-action primary-color-bg primary-color-hover" data-bs-dismiss="modal">Відмінити</button>
                            <a href="/" class="btn btn-warning btn-reset">Скинути</a>
                            <button type="submit" class="btn btn-primary btn-yes">Застосувати</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>
        <div class="row row-cols-xxl-3 g-xxl-5 row-cols-xl-3 g-xl-3 row-cols-lg-2 g-lg-3 row-cols-md-2 g-md-4 row-cols-1 g-5">
            <?php if (empty($data["ads"])): ?>
                <div class="h1 fw-bold text-center w-100">Наразі оголошень немає або їх не знайдено</div>
            <?php else: ?>
                <?php foreach ($data["ads"] as $ad): ?>
                    <div class="col">
                        <div class="card h-100" >
                            <div class="card-wrapper h-100">
                                <div class="car-top">
                                    <div class="m-2 image-wrapper ">
                                        <a href="/carad/view/<?=$ad['id']?>">
                                            <img src="/files/car/<?=$ad['main_image']?>" class="card-img-top " alt="<?=$ad['title']?>">
                                        </a>
                                    </div>
                                    <div class="card-body pb-0">
                                        <a href="/carad/view/<?=$ad['id']?>" class="card-title h5 mb-2"><?=$ad['title']?></a>
                                        <p class="card-text card-price mb-2"><?=$ad['price']." ".$ad['type_of_currency_sign']?></p>
                                        <div class="row row-cols-sm-2 row-cols-1 mb-3 gy-1">
                                            <div class="col">
                                                <div class="info">
                                                    <i class="bi bi-speedometer"></i>
                                                    <p class="m-0"><?=$ad['mileage']?> тис. км.</p>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="info">
                                                    <i class="bi bi-fuel-pump-fill"></i>
                                                    <?php if ($ad['fuel_name'] == "Електро"):?>
                                                        <p class="m-0"><?=$ad['fuel_name']?></p>
                                                    <?php else:?>
                                                        <p class="m-0"><?=$ad['fuel_name'].", ".$ad['engine_capacity']?> л.</p>
                                                    <?php endif;?>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="info">
                                                    <i class="bi bi-gear-wide"></i>
                                                    <p class="m-0"><?=$ad['transmission_name']?></p>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="info">
                                                    <i class="bi bi-vinyl-fill"></i>
                                                    <p class="m-0"><?=$ad['wheel_drive_name']?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-bottom">
                                    <div class="card-body pt-0">
                                        <a href="/carad/view/<?=$ad['id']?>" class="btn btn-view primary-color-bg primary-color-hover w-100">Переглянути</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <?php if (!empty($data["ads"])): ?>
        <div class="container container-car-ad-index d-flex justify-content-center">
            <?=$pagination?>
        </div>
    <?php endif; ?>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script defer >
    $(document).ready(function () {
        const btnsPrice = document.querySelectorAll(".inputPrice");
        const btnPriceFrom = document.getElementById("inputPriceFrom");
        const btnPriceTo = document.getElementById("inputPriceTo");
        btnPriceFrom.addEventListener("change", (event) => {
            if (btnPriceTo.value != "" && Number(event.target.value) > Number(btnPriceTo.value)) {
                event.target.value = "";
            }
        });
        btnPriceTo.addEventListener("change", (event) => {
            if (btnPriceFrom.value != "" && Number(event.target.value) < Number(btnPriceFrom.value)) {
                event.target.value = "";
            }
        });
        btnsPrice.forEach(item => item.addEventListener("input", (event) => {
            event.target.value = event.target.value.replace(/[^\d]/g, '');
        }));
        const btnReset = document.querySelector(".btn-reset");
        const selectYearFrom = document.getElementById("inputYearFrom");
        const selectYearTo = document.getElementById("inputYearTo");
        selectYearFrom.addEventListener("change", (event) => {
            if (selectYearTo.value == -1) {
                let today = new Date();
                let yearNow = today.getFullYear();
                makeYearFromAndToSelect(event.target.value, yearNow, selectYearTo, "До");
            }
        });
        selectYearTo.addEventListener("change", (event) => {
            if (selectYearFrom.value == -1) {
                makeYearFromAndToSelect(1900, event.target.value, selectYearFrom, "Від");
            }
        });

        function makeYearFromAndToSelect(minYear, maxYear, select, title) {
            select.innerHTML = "";
            const option = document.createElement("option");
            option.setAttribute("value", "-1");
            option.setAttribute("disabled", "disabled");
            option.setAttribute("selected", "selected");
            option.innerHTML = title;
            select.appendChild(option);
            for (let i = maxYear; i >= minYear; i--) {
                const option = document.createElement("option");
                option.setAttribute("value", i);
                option.innerHTML = i;
                select.appendChild(option);
            }
        }

        btnReset.addEventListener("click", () => {
            const select = document.getElementById("inputCarModel");
            select.innerHTML = "";
            const option = document.createElement("option");
            option.setAttribute("value", "-1");
            option.setAttribute("disabled", "disabled");
            option.setAttribute("selected", "selected");
            option.innerHTML = "Оберіть модель";
            select.appendChild(option);
            let today = new Date();
            let yearNow = today.getFullYear();
            makeYearFromAndToSelect(1900, yearNow, selectYearFrom, "Від");
            makeYearFromAndToSelect(1900, yearNow, selectYearTo, "До");
        });


        function createCarModelsSelect(modelsList) {
            const select = document.getElementById("inputCarModel");
            if (modelsList !== null) {
                select.innerHTML = "";
                const option = document.createElement("option");
                option.setAttribute("value", "-1");
                option.setAttribute("disabled", "disabled");
                option.setAttribute("selected", "selected");
                option.innerHTML = "Оберіть модель";
                select.appendChild(option);
                for (let i = 0; i < modelsList.length; i++) {
                    const option = document.createElement("option");
                    option.setAttribute("value", modelsList[i].id);
                    option.innerHTML = modelsList[i].name;
                    select.appendChild(option);
                }
            } else {
                select.innerHTML = "";
                const option = document.createElement("option");
                option.setAttribute("value", "-1");
                option.setAttribute("disabled", "disabled");
                option.setAttribute("selected", "selected");
                option.innerHTML = "Оберіть модель";
                select.appendChild(option);
            }
        }
        let inputCarBrand = document.getElementById("inputCarBrand");
        inputCarBrand.addEventListener("change", () => {
            let value = inputCarBrand.value;
            $.ajax({
                url: "/site/index",
                method: "POST",
                data: {
                    ajax: 1,
                    car_brand_id: value
                },
                success: function (response) {
                    createCarModelsSelect(JSON.parse(response));
                },
                dataType: "text"
            });
        })
    });
</script>