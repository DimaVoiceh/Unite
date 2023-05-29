<?php

$query_params = [
    'numberposts' => -1,
    "post_type" => "building",
    "fields" => "ids"
];


$agency_id = isset($_GET["agency_id"]) ?  $_GET["agency_id"] : null;
if ($agency_id && $agency_id !== "0") {
    $query_params['meta_query'][] = [
        'key' => 'building-agency',
        'value' =>  $agency_id,
        'compare' => "IN"
    ];
}

global $post;
$buildings = get_posts($query_params);

if ($buildings) {
    // $start = microtime(true);
?>
    <ul class="buildings-wrap__list">
        <?php
        foreach ($buildings as $post_id) {

            $trans_key = 'building_' . $post_id;
            $building = get_transient($trans_key);
            if (false === $building) {
                $building = get_building_data();
                set_transient($trans_key, $building, DAY_IN_SECONDS);
            }
        ?>
            <li>
                <div><strong><?php echo $building["title"]; ?></strong></div>
                <?php if (isset($building['area']) && $building['area']) : ?>
                    <div>Площадь - <?php echo $building['area']; ?> м²</div>
                <?php endif; ?>
                <?php if (isset($building['price']) && $building['price']) : ?>
                    <div>Стоимость - <?php echo $building['price']; ?>$</div>
                <?php endif; ?>
                <?php if (isset($building['address']) && $building['address']) : ?>
                    <div>Адрес - <?php echo $building['address']; ?></div>
                <?php endif; ?>
                <?php if (isset($building['living-area']) && $building['living-area']) : ?>
                    <div>Жилая площадь - <?php echo $building['living-area']; ?> м²</div>
                <?php endif; ?>
                <?php if (isset($building['floor']) && $building['floor']) : ?>
                    <div>Этаж - <?php echo $building['floor']; ?></div>
                <?php endif; ?>
            </li>
        <?php
        } ?>
    </ul>
<?php
} else {
    echo "Объектов не найдено";
}

// echo 'Время выполнения скрипта: ' . round(microtime(true) - $start, 4) . ' сек.';

?>