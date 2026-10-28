<?php
$conn = new mysqli("db", "root", "root", "secureshop");
$conn->set_charset("utf8mb4");

function money($v) {
    return number_format($v, 2, ',', ' ') . ' €';
}

function card($p) {
    $s = $p['stock'] > 0
        ? '<span class="badge ok">En stock</span>'
        : '<span class="badge no">Rupture</span>';
    return '<a class="card" href="/product.php?id=' . $p['id'] . '">'
         . '<div class="tile">' . $p['icon'] . '</div>'
         . '<div class="body"><span class="cat">' . $p['category'] . '</span>'
         . '<h3>' . $p['name'] . '</h3>'
         . '<div class="row"><strong>' . money($p['price']) . '</strong>' . $s . '</div>'
         . '</div></a>';
}
