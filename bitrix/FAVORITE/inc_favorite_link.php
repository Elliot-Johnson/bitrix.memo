<?php
require_once "CFavorite.php";
global $USER;
$attr_user_id = "";
if ($USER->isAuthorized()) {
    $attr_user_id = ' data_user_id="' . $USER->GetID() . '" ';
}
$product_id = isset($arResult['ID'])?$arResult['ID']:"";
if($product_id == ""){
    $product_id = isset($item['ID'])?$item['ID']:"";
}
if ($product_id) {
    $active = CFavorite::Check($product_id);
    $attr_product_id = ' data_product_id="' . $product_id . '" ';
    ?>
    <div class="favorite_link <?php if($active) echo 'active'; ?>" <?= $attr_user_id ?><?= $attr_product_id ?>>
        <span class="favorite_link_icon add"></span>
        <span class="favorite_link_icon delete"></span>
        <span class="favorite_link_text favorite_link_text_add">В избранное</span>
        <span class="favorite_link_text favorite_link_text_delete">В избранном</span>
    </div>
    <?php
}
?>