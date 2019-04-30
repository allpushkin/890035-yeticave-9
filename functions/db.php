<?php
$yeticave_db = mysqli_connect(
    $config['db']['host'],
    $config['db']['user'],
    $config['db']['password'],
    $config['db']['db_name']
);
mysqli_set_charset($yeticave_db, 'utf8');


$isAuth = rand(0, 1);
$userName = 'Vova';

$title = 'Yeticave - main page';

$categories = [
    'Доски и лыжи',
    'Крепления',
    'Ботинки',
    'Одежда',
    'Инструменты',
    'Разное',
];

$lots = [
    [
        'name'     => '2014 Rossignol District Snowboard',
        'category' => 'Доски и лыжи',
        'price'    => 10999,
        'image'    => 'img/lot-1.jpg',
    ],
    [
        'name'     => 'DC Ply Mens 2016/2017 Snowboard',
        'category' => 'Доски и лыжи',
        'price'    => 159999,
        'image'    => 'img/lot-2.jpg',
    ],
    [
        'name'     => 'Крепления Union Contact Pro 2015 года размер L/XL',
        'category' => 'Крепления',
        'price'    => 8000,
        'image'    => 'img/lot-3.jpg',
    ],
    [
        'name'     => 'Ботинки для сноуборда DC Mutiny Charocal',
        'category' => 'Ботинки',
        'price'    => 10999,
        'image'    => 'img/lot-4.jpg',
    ],
    [
        'name'     => 'Куртка для сноуборда DC Mutiny Charocal',
        'category' => 'Одежда',
        'price'    => 7500,
        'image'    => 'img/lot-5.jpg',
    ],
    [
        'name'     => 'Маска Oakley Canopy',
        'category' => 'Разное',
        'price'    => 5400,
        'image'    => 'img/lot-6.jpg',
    ],
];


/**
 * Создает подготовленное выражение на основе готового SQL запроса и переданных данных
 *
 * @param       $link mysqli Ресурс соединения
 * @param       $sql  string SQL запрос с плейсхолдерами вместо значений
 * @param array $data Данные для вставки на место плейсхолдеров
 *
 * @return mysqli_stmt Подготовленное выражение
 */
function db_get_prepare_stmt($link, $sql, $data = [])
{
    $stmt = mysqli_prepare($link, $sql);

    if ($stmt === false) {
        $errorMsg = 'Не удалось инициализировать подготовленное выражение: '
            . mysqli_error($link);
        die($errorMsg);
    }

    if ($data) {
        $types = '';
        $stmt_data = [];

        foreach ($data as $value) {
            $type = 's';

            if (is_int($value)) {
                $type = 'i';
            } else {
                if (is_string($value)) {
                    $type = 's';
                } else {
                    if (is_double($value)) {
                        $type = 'd';
                    }
                }
            }

            if ($type) {
                $types .= $type;
                $stmt_data[] = $value;
            }
        }

        $values = array_merge([$stmt, $types], $stmt_data);

        $func = 'mysqli_stmt_bind_param';
        $func(...$values);

        if (mysqli_errno($link) > 0) {
            $errorMsg
                = 'Не удалось связать подготовленное выражение с параметрами: '
                . mysqli_error($link);
            die($errorMsg);
        }
    }

    return $stmt;
}


/**
 * Получение записей из БД
 *
 * @param       $link mysqli Ресурс соединения
 * @param       $sql  string SQL запрос с плейсхолдерами вместо значений
 * @param array $data Данные для вставки на место плейсхолдеров
 *
 * @return array
 */
function db_fetch_data($link, $sql, $data = [])
{
    $result = [];
    $stmt = db_get_prepare_stmt($link, $sql, $data);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    if ($res) {
        $result = mysqli_fetch_all($res, MYSQLI_ASSOC);
    }

    return $result;
}

/**
 * Добавление / Обновление / Удаление записей в БД
 *
 * @param       $link mysqli Ресурс соединения
 * @param       $sql  string SQL запрос с плейсхолдерами вместо значений
 * @param array $data Данные для вставки на место плейсхолдеров
 *
 * @return boolean
 */
function db_insert_data($link, $sql, $data = []) {
    $stmt = db_get_prepare_stmt($link, $sql, $data);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        $result = mysqli_insert_id($sql);
    }

    return $result;
}
