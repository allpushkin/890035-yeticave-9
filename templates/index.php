<section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое
        эксклюзивное сноубордическое и
        горнолыжное снаряжение.</p>
    <ul class="promo__list">
        <?php foreach ($categories as $cat): ?>
            <li class="promo__item promo__item--boards">
                <a class="promo__link"
                   href="pages/all-lots.html"><?= $cat; ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</section>
<section class="lots">
    <div class="lots__header">
        <h2>Открытые лоты</h2>
    </div>
    <ul class="lots__list">
        <?php foreach ($lots as $lot): ?>
            <li class="lots__item lot">
                <div class="lot__image">
                    <img src="<?= $lot['image'] ?? null; ?>" width="350"
                         height="260"
                         alt="<?= $lot['name'] ?? null; ?>">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?= $lot['category'] ?? null; ?></span>
                    <h3 class="lot__title"><a class="text-link"
                                              href="pages/lot.html"><?= $lot['name'] ?? null; ?></a>
                    </h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>
                            <span class="lot__cost"><?= price_format($price = $lot['price'] ?? null); ?></span>
                        </div>
                        <div class="lot__timer timer">
                            <?= next_day_time(); ?>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</section>