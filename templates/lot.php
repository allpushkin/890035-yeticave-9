<main>
    <nav class="nav">
        <ul class="nav__list container">
            <?php foreach ($categories as $category): ?>
                <li class="nav__item">
                    <a href="/category.php?id=<?= $category['id']; ?>"><?= $category['name']; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
    <section class="lot-item container">
        <h2><?= $lot['name']; ?></h2>
        <div class="lot-item__content">
            <div class="lot-item__left">
                <div class="lot-item__image">
                    <img src="../<?= $lot['image']; ?>" width="730" height="548" alt="<?= ['name']; ?>">
                </div>
                <p class="lot-item__category">Категория: <span><?= $lot['category_name']; ?></span></p>
                <p class="lot-item__description"><?= $lot['content']; ?></p>
            </div>
            <div class="lot-item__right">
                <div class="lot-item__state">
                    <div class="lot-item__timer timer <?= is_timer_finishing($lot['end_time'], 1) ? 'timer--finishing' : ''; ?>">
                        <?= time_to_end($lot['end_time']); ?>
                    </div>
                    <div class="lot-item__cost-state">
                        <div class="lot-item__rate">
                            <span class="lot-item__amount">Текущая цена</span>
                            <span class="lot-item__cost"><?= $lot['start_price'] . RUB; ?></span>
                        </div>
                        <div class="lot-item__min-cost">
                            Мин. ставка <span><?= $lot['step_rate']; ?> р</span>
                        </div>
                    </div>
                    <?php /* ?>
                    <form class="lot-item__form" action="" method="post" autocomplete="off">
                        <p class="lot-item__form-item form__item form__item--invalid">
                            <label for="cost">Ваша ставка</label>
                            <input id="cost" type="text" name="cost" placeholder="12 000">
                            <span class="form__error">Введите наименование лота</span>
                        </p>
                        <button type="submit" class="button">Сделать ставку</button>
                    </form>
                    <?php */ ?>
                </div>
                <?php /* ?>
                <div class="history">
                    <h3>История ставок (<span>10</span>)</h3>
                    <table class="history__list">

                        <?php foreach ($bets as $bet): ?>
                            <tr class="history__item">
                                <td class="history__name"><?= strstr($bet['name'], ' ', true); ?></td>
                                <td class="history__price"><?= $bet['amount']; ?> р</td>
                                <td class="history__time"><?= $bet['create_time']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php */ ?>
            </div>
        </div>
    </section>
</main>
