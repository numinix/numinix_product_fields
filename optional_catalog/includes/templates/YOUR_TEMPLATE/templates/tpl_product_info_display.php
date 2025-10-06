<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=product_info.
 * Displays details of a typical product
 *
 * @copyright Copyright 2003-2024 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: lat9 2024 Sep 17 Modified in v2.1.0-beta1 $
 */
// -----
// Enabling this product-information template to be reused for other product
// types.
//
$product_info_html_id = $product_info_html_id ?? 'productGeneral';
$product_info_class = $product_info_class ?? 'productGeneral';
?>
<div class="centerColumn" id="<?= $product_info_html_id ?>">

<!--bof Form start-->
<?= zen_draw_form('cart_quantity', zen_href_link(zen_get_info_page($_GET['products_id']), zen_get_all_get_params(['action']) . 'action=add_product', $request_type), 'post', 'enctype="multipart/form-data" id="addToCartForm"') . "\n" ?>
<!--eof Form start-->
<?php
if ($messageStack->size('product_info') > 0) {
    echo $messageStack->output('product_info');
}
?>
<!--bof Category Icon -->
<?php
if ($module_show_categories != 0) {
/**
 * display the category icons
 */
    require $template->get_template_dir('/tpl_modules_category_icon_display.php', DIR_WS_TEMPLATE, $current_page_base, 'templates') . '/tpl_modules_category_icon_display.php';
}
?>
<!--eof Category Icon -->

<!--bof Prev/Next top position -->
<?php
if (PRODUCT_INFO_PREVIOUS_NEXT === '1' || PRODUCT_INFO_PREVIOUS_NEXT === '3') {
    /**
     * display the product previous/next helper
     */
    require $template->get_template_dir('/tpl_products_next_previous.php', DIR_WS_TEMPLATE, $current_page_base, 'templates') . '/tpl_products_next_previous.php';
}
?>
<!--eof Prev/Next top position-->

    <div id="prod-info-top">
<!--bof Product Name-->
        <h1 id="productName" class="<?= $product_info_class ?>"><?= $products_name ?></h1>
<!--eof Product Name-->

        <div id="pinfo-left" class="group">
<!--bof Main Product Image -->
<?php
if (!empty($products_image) || !empty($enable_additional_images_without_main_image)) {
    /**
     * display the main product image
     */
    require $template->get_template_dir('/tpl_modules_main_product_image.php', DIR_WS_TEMPLATE, $current_page_base, 'templates') . '/tpl_modules_main_product_image.php';
?>
<!--eof Main Product Image-->

<!--bof Additional Product Images -->
<?php
    /**
     * display the products additional images
     */
    require $template->get_template_dir('/tpl_modules_additional_images.php', DIR_WS_TEMPLATE, $current_page_base, 'templates') . '/tpl_modules_additional_images.php';
?>
<!--eof Additional Product Images -->
<?php
}
?>
        </div>
        <div id="pinfo-right" class="group grids">
<!--bof Product Price block -->
<!--bof Product details list  -->
<?php if ( (($flag_show_product_info_model == 1 and $products_model != '') or ($flag_show_product_info_weight == 1 and $products_weight !=0) or ($flag_show_product_info_quantity == 1) or ($flag_show_product_info_manufacturer == 1 and !empty($manufacturers_name))) ) { ?>
<ul id="productDetailsList">
  <?php echo (($flag_show_product_info_model == 1 and $products_model !='') ? '<li>' . TEXT_PRODUCT_MODEL . $products_model . '</li>' : '') . "\n"; ?>
  <?php echo (($flag_show_product_info_weight == 1 and $products_weight !=0) ? '<li>' . TEXT_PRODUCT_WEIGHT .  $products_weight . TEXT_PRODUCT_WEIGHT_UNIT . '</li>'  : '') . "\n"; ?>
  <!-- BEGIN NPF MODIFICATIONS -->
  <?php if ((!isset($flag_show_product_info_out_of_stock) || ($flag_show_product_info_out_of_stock == 1 && $products_out_of_stock == 0))) { ?>
  <!-- END NPF MODIFICATIONS -->
  <?php echo (($flag_show_product_info_quantity == 1) ? '<li>' . $products_quantity . TEXT_PRODUCT_QUANTITY . '</li>'  : '') . "\n"; ?>
  <!-- BEGIN NPF MODIFICATIONS -->
  <?php } ?>
  <?php
  if (!empty($numinix_fields_display)) {
    foreach ($numinix_fields_display as $field => $value) {
      $field_name = ucwords(str_replace('_', ' ', $field));
      echo '<li>' . $field_name . ': ' . $value . '</li>'; 
    }
  } 
  ?>
  <!-- END NPF MODIFICATIONS -->
  
  <?php echo (($flag_show_product_info_manufacturer == 1 and !empty($manufacturers_name)) ? '<li>' . TEXT_PRODUCT_MANUFACTURER . $manufacturers_name . '</li>' : '') . "\n"; ?>
  <!-- BEGIN NPF MODIFICATIONS -->
  <?php if(isset($flag_show_product_info_condition)) echo (($flag_show_product_info_condition == 1 and $products_condition != '') ? '<li>' . TEXT_PRODUCTS_CONDITION . $products_condition . '</li>' : '') . "\n"; ?>
  <?php if(isset($flag_show_product_info_upc)) echo (($flag_show_product_info_upc == 1 and $products_upc != '') ? '<li>' . TEXT_PRODUCTS_UPC . $products_upc . '</li>' : '') . "\n"; ?>  
  <?php if(isset($flag_show_product_info_isbn)) echo (($flag_show_product_info_isbn == 1 and $products_isbn != '') ? '<li>' . TEXT_PRODUCTS_ISBN . $products_isbn . '</li>' : '') . "\n"; ?>
  <?php if(isset($flag_show_product_info_sku)) echo (($flag_show_product_info_sku == 1 and $products_sku != '') ? '<li>' . TEXT_PRODUCTS_SKU . $products_sku . '</li>' : '') . "\n"; ?>
  <!-- END NPF MODIFICATIONS -->
</ul>
<?php
  }
?>

<!-- BEGIN NPF MODIFICATIONS -->
<!-- bof Product description 2 -->
<?php if ($products_description2 != '') { ?>
<div id="productDescription2" class="productGeneral biggerText"><?php echo stripslashes($products_description2); ?></div>
<br class="clearBoth" />
<?php } ?>
<!-- eof Product description 2 -->

<!-- bof Care Instructions  -->
<?php if ($care_instructions != '') { ?>
<div id="careInstructions" class="productGeneral biggerText"><?php echo stripslashes($care_instructions); ?></div>
<br class="clearBoth" />
<?php } ?>
<!-- eof Care Instructions -->
<!-- END NPF MODIFICATIONS -->

<!--eof Product details list -->

<?php
if ($flag_show_ask_a_question) {
?>
<!-- bof Ask a Question -->
            <br>
            <span id="productQuestions">
                <?= '<a href="' . zen_href_link(FILENAME_ASK_A_QUESTION, 'pid=' . $_GET['products_id'], 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_ASK_A_QUESTION, BUTTON_ASK_A_QUESTION_ALT, ' id="askAQuestionButton"') . '</a>' ?>
            </span>
            <br class="clearBoth">
            <br>
<!-- eof Ask a Question -->
<?php
}
?>

<!--bof free ship icon  -->
<?php
if (zen_get_product_is_always_free_shipping($products_id_current) && $flag_show_product_info_free_shipping) {
?>
            <div id="freeShippingIcon"><?= TEXT_PRODUCT_FREE_SHIPPING_ICON ?></div>
<?php
}
?>
<!--eof free ship icon  -->
        </div>

<?php
$add_to_cart_class = 'add-to-cart-' . zen_get_products_allow_add_to_cart((int)$_GET['products_id']);
?>
        <div id="cart-box" class="grids <?= $product_info_class . ' ' . $add_to_cart_class ?>">
<!--bof Product Price block -->
            <h2 id="productPrices" class="<?= $product_info_class ?>">
<?php
// base price
if ($show_onetime_charges_description == 'true') {
    $one_time = '<span>' . TEXT_ONETIME_CHARGE_SYMBOL . TEXT_ONETIME_CHARGE_DESCRIPTION . '</span><br>';
} else {
    $one_time = '';
}
echo $one_time . ((zen_has_product_attributes_values((int)$_GET['products_id']) && $flag_show_product_info_starting_at == 1) ? TEXT_BASE_PRICE : '') . zen_get_products_display_price((int)$_GET['products_id']);
?>
            </h2>
<!--eof Product Price block -->

<!--bof Attributes Module -->
<?php
if ($pr_attr->fields['total'] > 0) {
    /**
     * display the product attributes
     */
    require $template->get_template_dir('/tpl_modules_attributes.php', DIR_WS_TEMPLATE, $current_page_base, 'templates') . '/tpl_modules_attributes.php'; ?>
<?php
}
?>
<!--eof Attributes Module -->

<!--bof Quantity Discounts table -->
<?php
if ($products_discount_type != 0) {
    /**
     * display the products quantity discount
     */
    require $template->get_template_dir('/tpl_modules_products_quantity_discounts.php', DIR_WS_TEMPLATE, $current_page_base, 'templates') . '/tpl_modules_products_quantity_discounts.php';
}
?>
<!--eof Quantity Discounts table -->

<!--bof Add to Cart Box -->

<!-- BEGIN NPF MODIFICATIONS -->
<?php if ((!isset($flag_show_product_info_out_of_stock) || ($flag_show_product_info_out_of_stock == 1 && $products_out_of_stock == 0))) { ?>
<!-- END NPF MODIFICATIONS -->

<?php
if (CUSTOMERS_APPROVAL === '3' && TEXT_LOGIN_FOR_PRICE_BUTTON_REPLACE_SHOWROOM == '') {
  // do nothing
} else {
    
    $display_qty = (($flag_show_product_info_in_cart_qty == 1 && $_SESSION['cart']->in_cart($_GET['products_id'])) ? '<p>' . PRODUCTS_ORDER_QTY_TEXT_IN_CART . $_SESSION['cart']->get_quantity($_GET['products_id']) . '</p>' : '');
    if ($products_qty_box_status == 0 || $products_quantity_order_max == 1) {
        // hide the quantity box and default to 1
        $the_button = '<input type="hidden" name="cart_quantity" value="1">';
    } else {
        // show the quantity box
        $the_button =
            '<div class="max-qty">' .
                zen_get_products_quantity_min_units_display((int)$_GET['products_id']) .
            '</div>' .
            '<span class="qty-text">' . PRODUCTS_ORDER_QTY_TEXT . '</span>' .
            '<input type="text" name="cart_quantity" value="' . $products_get_buy_now_qty . '" maxlength="6" size="4" aria-label="' . ARIA_QTY_ADD_TO_CART . '">';
    }
    $the_button .= zen_draw_hidden_field('products_id', (int)$_GET['products_id']);
    $the_button .= zen_image_submit(BUTTON_IMAGE_IN_CART, BUTTON_IN_CART_ALT, ' id="addToCartButton"');
    $display_button = zen_get_buy_now_button($_GET['products_id'], $the_button);

    if ($display_qty != '' || $display_button != '') {
?>
            <div id="cartAdd">
                <?= $display_qty . $display_button ?>
            </div>
<?php
    } // display qty and button
} // CUSTOMERS_APPROVAL == 3
?>
<!-- BEGIN NPF MODIFICATIONS -->
<?php } else { ?>
    <p class="outofStock"><?php echo TEXT_PRODUCTS_OUT_OF_STOCK; ?></p>
<?php } // end out of stock ?>
<!-- END NPF MODIFICATIONS -->
<!--eof Add to Cart Box-->
        </div>
    </div>

<!--bof Product description -->
<?php
if ($products_description != '') {
?>
    <div id="productDescription" class="<?= $product_info_class ?> biggerText">
        <?= stripslashes($products_description) ?>
    </div>
<?php
}
?>
<!--eof Product description -->

<!--bof Prev/Next bottom position -->
<?php
if (PRODUCT_INFO_PREVIOUS_NEXT === '2' || PRODUCT_INFO_PREVIOUS_NEXT === '3') {
    /**
     * display the product previous/next helper
     */
    require $template->get_template_dir('/tpl_products_next_previous.php', DIR_WS_TEMPLATE, $current_page_base, 'templates') . '/tpl_products_next_previous.php'; ?>
<?php
}
?>
<!--eof Prev/Next bottom position -->

<!--bof Reviews button and count-->
<?php
if ($flag_show_product_info_reviews == 1) {
    // if more than 0 reviews, then show reviews button; otherwise, show the "write review" button
    if ($reviews->fields['count'] > 0 ) {
?>
    <div id="productReviewLink" class="buttonRow back">
        <a href="<?= zen_href_link(FILENAME_PRODUCT_REVIEWS, zen_get_all_get_params()) ?>">
            <?= zen_image_button(BUTTON_IMAGE_REVIEWS, BUTTON_REVIEWS_ALT) ?>
        </a>
    </div>
    <br class="clearBoth">
    <p class="reviewCount"><?= ($flag_show_product_info_reviews_count == 1 ? TEXT_CURRENT_REVIEWS . ' ' . $reviews->fields['count'] : '') ?></p>
<?php
    } else {
?>
    <div id="productReviewLink" class="buttonRow back">
        <a href="<?= zen_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, zen_get_all_get_params()) ?>">
            <?= zen_image_button(BUTTON_IMAGE_WRITE_REVIEW, BUTTON_WRITE_REVIEW_ALT) ?>
        </a>
    </div>
    <br class="clearBoth">
<?php
    }
}
?>
<!--eof Reviews button and count -->

<!--bof Product date added/available-->
<?php
if ($products_date_available > date('Y-m-d H:i:s')) {
    if ($flag_show_product_info_date_available == 1) {
?>
    <p id="productDateAvailable" class="<?= $product_info_class ?> centeredContent">
        <?= sprintf(TEXT_DATE_AVAILABLE, zen_date_long($products_date_available)) ?>
    </p>
<?php
    }
} elseif ($flag_show_product_info_date_added == 1) {
?>
    <p id="productDateAdded" class="<?= $product_info_class ?> centeredContent">
        <?= sprintf(TEXT_DATE_ADDED, zen_date_long($products_date_added)) ?>
    </p>
<?php
} // $flag_show_product_info_date_added
?>
<!--eof Product date added/available -->

<!--bof Product URL -->
<?php
if (!empty($products_url) && $flag_show_product_info_url == 1) {
?>
    <p id="productInfoLink" class="<?= $product_info_class ?> centeredContent">
        <?= sprintf(TEXT_MORE_INFORMATION, zen_href_link(FILENAME_REDIRECT, 'action=product&products_id=' . zen_output_string_protected($_GET['products_id']), 'NONSSL', true, false)) ?>
    </p>
<?php
} // $flag_show_product_info_url
?>
<!--eof Product URL -->

<!--bof also purchased products module-->
<?php require $template->get_template_dir('tpl_modules_also_purchased_products.php', DIR_WS_TEMPLATE, $current_page_base, 'templates') . '/tpl_modules_also_purchased_products.php'; ?>
<!--eof also purchased products module-->

<!--bof Form close-->
<?= '</form>' ?>
<!--bof Form close-->
</div>
