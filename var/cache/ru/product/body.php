<?php if ($config['General']['recaptcha_key']) {?>
<script src='https://www.google.com/recaptcha/api.js?onload=recaptchaOnload&render=explicit' async defer></script>
<?php } ?>

<div id="dcart"><img src="<?php echo $current_location;?>/images/dcart.png" alt="" /><br />Переместить товар сюда</div>
 <h1 class="fn title product-title"><?php echo $product['name'];?></h1>
 <h1 class="fntitle hidden"><?php echo $product['name'];?></h1>
<br />
<table class="product">
<tr>
 <td class="photo">
 <div id="zoom">
<?php 
$image = $photos[0];
$image['new_width'] = 2000;
$image['new_height'] = 4000;
$image['link'] = 'Y';
include SITE_ROOT . '/includes/image.php';

$image['only_url'] = 'Y';
ob_start();
include SITE_ROOT . '/includes/image.php';
$image_url = ob_get_clean();
echo '<meta property="og:image" content="'.$image_url.'" />';

?>
</div>
<table>
<?php if (count($photos) > 1) {?> <?php foreach ($photos as $k=>$v) {?>  <?php if ($k == 0 || $k == 4 || $k == 9) {?>
<tr>
<?php } ?>
 <td>
<?php $image = $v;
$image['new_width'] = 95;
$image['new_height'] = 95;
$image['link'] = 'Y';
$image['blank'] = 'Y';
include SITE_ROOT . '/includes/image.php';
?>
 </td>
  <?php if ($k == 3 || $k == 8) {?>
</tr>
  <?php } ?>
 <?php } ?>

</tr>
<?php } ?>
</table>
<script>
<?php if ($oid == 1) {?>
oid = 1;
qadd = '.product_popup ';
product_price_ql = "<?php echo price_format_currency($product['price']); ?>";
product_weight_ql = "<?php echo $product['weight'];?>";
<?php } else  { ?>
<?php $oid = 0;; ?>
oid = 0;
qadd = '';
product_price = "<?php echo price_format_currency($product['price']); ?>";
product_weight = "<?php echo $product['weight'];?>";
<?php } ?>
var product_avail = [];
product_avail[<?php echo $oid;?>] = <?php echo $product['avail'];?>;
</script>
 </td>
 <td class="details">
<?php if ($oid == 1) {?> <div class="see_all"><a class="ajax_link" href="<?php echo $current_location;?>/<?php echo $product['cleanurl'] ? $product['cleanurl'].'.html' : 'product/'.$product['productid'];; ?>">Подробнее</a></div>
<?php } ?>
<form name="product-details" action="<?php echo $current_location;?>/cart/add" onsubmit="return add_to_cart();">
<input type="hidden" name="productid" value="<?php echo $product['productid'];?>" />

<br />

<script>
<?php if ($wholesale) {?>
w_prices[<?php echo $oid;?>] = [];
 <?php foreach ($wholesale as $k=>$v) {?>
w_prices[<?php echo $oid;?>][<?php echo $k;?>] = [<?php echo $v['quantity'];?>, <?php echo $v['price'];?>];
 <?php } ?><?php } else  { ?>
w_prices[<?php echo $oid;?>] = [];
<?php } ?>

<?php if ($options_ex) {?>
 <?php foreach ($options_ex as $k=>$v) {?>exceptions[<?php echo $oid;?>][<?php echo $k;?>] = [];
  <?php foreach ($v as $g=>$o) {?>
exceptions[<?php echo $oid;?>][<?php echo $k;?>][<?php echo $g;?>] = <?php echo $o;?>;
  <?php } ?>
 <?php } ?>
<?php } else  { ?>
exceptions[<?php echo $oid;?>] = [];
<?php } ?>
</script>
<?php /* ?>
<h3>Подробности о товаре</h3>
<?php */ ?>
<table id="product-details">
<?php if ($average_rating) {?>
<tr>
 <td class="name">Рейтинг:</td>
 <td class="value"><div class="rating-votes"><div style="width: <?php echo $average_rating;?>%;"></div></div></td>
</tr>
<?php } ?>

<tr>
 <td class="name">SKU:</td>
 <td class="value product-sku"><?php echo $product['sku'];?></td>
</tr>
<?php if ($product['list_price'] > $product['price']) {?>
<?php $save_price = $product['list_price'] - $product['price'];; ?>
<?php $save_percentage = round(100 - 100 * $product['price'] / $product['list_price']);; ?>
<tr>
 <td class="name">Цена по прейскуранту:</td>
 <td class="value product-list-price"><s><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($product['list_price']); ?></s>, save <b><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($save_price); ?> (<?php echo $save_percentage;?>%)</b></td>
</tr>
<?php } ?>
<tr<?php if (!$product['weight']) {?> class="hidden"<?php } ?>>
 <td class="name">Вес:</td>
 <td class="value product-weight"><?php echo price_format($product['weight']).' <span class="weight-symbol">lbs</span>'; ?></td>
</tr>
</table>

<?php if ($option_groups) {?><h3>Параметры товара</h3>
<?php } ?>

<?php if ($variants) {?><div class="variants-data display-none">
<table><tbody><tr></tr></tbody></table>
</div>
<span id="hasVariants"></span>
<script>
<?php foreach ($variants as $k=>$v) {?> <?php $k = $v['variantid'];; ?>variants[<?php echo $oid;?>][<?php echo $k;?>] = ["<?php echo escape($v['sku'], 2);; ?>", <?php echo price_format_currency($v['price']); ?>, <?php echo $v['weight'];?>, <?php echo $v['avail'];?>, {}, [], <?php echo $v['variantid'];?>, [], "<?php echo escape($v['title'], 2);; ?>"];
 <?php if ($v['options']) {?>
  <?php foreach ($v['options'] as $k2=>$v2) {?>
variants[<?php echo $oid;?>][<?php echo $k;?>][4][<?php echo $v2['groupid'];?>] = <?php echo $v2['optionid'];?>;
  <?php } ?>
 <?php } ?>

 <?php if ($v['images']) {?>
  <?php foreach ($v['images'] as $k2=>$v2) {?>
<?php 
$image = $v2;
$image['new_width'] = 95;
$image['new_height'] = 95;
$image['only_url'] = 'Y';
ob_start();
include SITE_ROOT . '/includes/variant_image.php';
$image_url = ob_get_clean();
?>
variants[<?php echo $oid;?>][<?php echo $k;?>][5][<?php echo $k2;?>] = "<a href='<?php echo $current_location;?>/photos/variant/<?php echo $v2['variantid'];?>/<?php echo $v2['imageid'];?>/<?php echo $v2['file'];?>' onclick='javascript: return switch_photo($(this));' rev='width: <?php echo $v2['x'];?>, height: <?php echo $v2['y'];?>'><img src='<?php echo $image_url;?>' alt='<?php echo escape($v2['alt'], 3);; ?>' /></a>";
  <?php } ?>
 <?php } ?>

 <?php if ($v['wholesale']) {?>
  <?php foreach ($v['wholesale'] as $k2=>$v2) {?>
variants[<?php echo $oid;?>][<?php echo $k;?>][7][<?php echo $k2;?>] = [<?php echo $v2['quantity'];?>, <?php echo price_format_currency($v2['price']); ?>];
  <?php } ?>
 <?php } ?>
<?php } ?>
</script>
<?php } else  { ?><script>
variants[<?php echo $oid;?>] = [];
</script>
<?php } ?>

<?php if ($option_groups) {?><script>
<?php foreach ($option_groups as $k=>$v) {?>groups[<?php echo $oid;?>][<?php echo $v['groupid'];?>] = [<?php echo $v['groupid'];?>, <?php echo $v['variant'];?>, "<?php echo $v['type'];?>", {}];
 <?php if ($v['options']) {?>  <?php foreach ($v['options'] as $o) {?>options[<?php echo $oid;?>][<?php echo $o['optionid'];?>] = "<?php echo escape($o['name'], 2);; ?>";
groups[<?php echo $oid;?>][<?php echo $v['groupid'];?>][3][<?php echo $o['optionid'];?>] = [<?php  if ($o['price_modifier_type'] == '$') echo price_format_currency($o['price_modifier']); else  echo $o['price_modifier'];  ?>, "<?php echo $o['price_modifier_type'];?>", <?php echo $o['weight_modifier'];?>, "<?php echo $o['weight_modifier_type'];?>"];
  <?php } ?> <?php } ?><?php } ?>
</script>
<table class="product-options">
<?php $cnt = 0;; ?>
<?php foreach ($option_groups as $k=>$v) {?> <?php if ($cnt == 0) {?>
<tr>
 <?php } ?>

 <td class="product-option"><strong class="subtitle"><?php echo $v['fullname'] ? $v['fullname'] : $v['name'];; ?><span id="pot-<?php echo $v['groupid'];?>"></span> <a href="javascript: void(0);" class="clear_option" id="poa-<?php echo $v['groupid'];?>">Очистить</a></strong><br />
 <?php if ($v['view_type'] == 's' && $v['options']) {?><select name="product_options[<?php echo $v['groupid'];?>]" id="po-<?php echo $v['groupid'];?>" class="product_options<?php if (!$v['variant']) {?> novar<?php } ?>">
 <option></option>
<?php foreach ($v['options'] as $o) {?>
 <option value="<?php echo $o['optionid'];?>"<?php if ($preselected[$v['groupid']] == $o['optionid']) {?> selected<?php } ?>><?php echo $o['name'];?>
 <?php if (!$v['variant']) {?>
  <?php if ($o['price_modifier'] != "0.00") {?>	<?php if ($o['price_modifier_type'] == '%') {?>
<?php $modifier = $o['price_modifier'] * $product["price"] / 100;; ?>(+<?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($modifier); ?>)
    <?php } else if ($o['price_modifier_type'] == '$') {?>(+<?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($o['price_modifier']); ?>)
    <?php } ?>   <?php } ?>
  <?php } ?>
  </option>
<?php } ?>
</select>

<?php } else if ($v['view_type'] == 'p' && $v['options']) {?><div class="options_container<?php if (!$v['variant']) {?> novar<?php } ?>" id="pog-<?php echo $v['groupid'];?>">
 <?php foreach ($v['options'] as $o) {?><div class="option-name" id="poi-<?php echo $o['optionid'];?>" data-title="<?php echo escape($o['name'], 2);; ?>"><?php echo $o['name'];?>
  <?php if (!$v['variant']) {?>
   <?php if ($o['price_modifier'] != "0.00") {?>
	<?php if ($o['price_modifier_type'] == '%') {?><?php $modifier = $o['price_modifier'] * $product["price"] / 100;; ?>
(+<?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($modifier); ?>)
    <?php } else if ($o['price_modifier_type'] == '$') {?>
(+<?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($o['price_modifier']); ?>)
    <?php } ?>
   <?php } ?>
  <?php } ?>
</div>
 <?php } ?>
<div class="clear"></div>
</div>
<input type="hidden" name="product_options[<?php echo $v['groupid'];?>]" value="<?php echo $preselected[$v['groupid']] ? $preselected[$v['groupid']] : "";; ?>" id="po-<?php echo $v['groupid'];?>" />
<?php /* ?>
<?php 
		} else if ($v['view_type'] == 'r' && $v['options']) {?>
<ul id="po-<?php echo $v['groupid'];?>">
<?php 
			foreach ($v['options'] as $k2=>$o) {
?>
  <li>
    <input type="radio" id="product_option_<?php echo $o['optionid'];?>" name="product_options[<?php echo $v['groupid'];?>]" value="<?php echo $o['optionid'];?>"<?php if ($preselected[$v['groupid']] == $o['optionid']) {?> checked<?php } ?> class="product_options" />
    <label for="product_option_<?php echo $o['optionid'];?>">
      <?php echo $o['name'];?>
<?php 
    			if (!$v['variant']) {
					if ($o['price_modifier'] != "0.00") {
						if ($o['price_modifier_type'] == '%') {
							echo '(+$'.price_format($o['price_modifier'] * $product["price"] / 100).')';
						} else if ($o['price_modifier_type'] == '$') {
							echo '(+$'.$o['price_modifier'].')';
						}
					}
				}
?>
    </label>
  </li>
<?php 
			}
?>
</ul>
<?php */ ?>
<?php } else if ($v['view_type'] == 't') {?><textarea name="product_options[<?php echo $v['groupid'];?>]"><?php echo $preselected[$v['groupid']];?></textarea>
<?php } else if ($v['view_type'] == 'i') {?>
<input type="text" name="product_options[<?php echo $v['groupid'];?>]" value="<?php echo escape($preselected[$v['groupid']], 2);; ?>" />
<?php } ?>
</td>
 <?php $cnt++;; ?>
 <?php if ($cnt == 2) {?>  <?php $cnt = 0;; ?>
</tr>
 <?php } ?>
<?php } ?>

<?php /* ?><?php if ($cnt < 2) {?><?php */ ?>
</table>
<?php } else  { ?>
<script>
groups[<?php echo $oid;?>] = [];
options[<?php echo $oid;?>] = [];
</script>
<?php } ?>
<br />
<table class="product-to-cart">
<tr class="options-error">
 <td colspan="7" align="left">Пожалуйста, выберите все опции.</td>
</tr>

<tr class="product-details-tr">
 <td colspan="4" class="product-details-price" nowrap>
<input type="hidden" name="nongstprice" value="<?php echo $product['price'];?>" />
<span class="product-details-price"><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($product['price']); ?></span>
<?php if ($product['list_price'] > $product['price']) {?>
<?php $save_price = $product['list_price'] - $product['price'];; ?>
<?php $save_percentage = round(100 - 100 * $product['price'] / $product['list_price']);; ?>
<s class="product-details-list-price"><?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($product['list_price']); ?></s>
<?php } ?>
 </td>
<?php if ($oid) {?>
</tr>
<tr>
<?php } ?>
<?php if ($product['avail'] > 0) {?>
 <td id="quantity" class="quantity-box-container"><input type="text" size="3" name="amount" class="min[1],max[<?php echo $product['avail'];?>]" value="1" /></td>
 <td id="out_of_stock"<?php if ($product['avail'] < 1) {?> class="shown"<?php } ?>>Нет в наличии</td>
 <td>
<input type="hidden" name="options_ex" value="" />
 <button class="add2cart add2cart-product" id="productid-<?php echo $product['productid'];?>">Купить<span><svg><use xlink:href="/images/sprite.svg#cart"></use></svg></span></button>
 </td>
<?php } else  { ?>
 <td class="out-of-stock" colspan="3"> &nbsp; Нет в наличии</td>
<?php } ?>
<?php if ($oid) {?>
</tr>
<tr>
 <td colspan="4"><a class="main-button" onclick="javascript: return <?php if ($login) {?>add_wishlist(<?php echo $product['productid'];?>);<?php } else  { ?>login_popup('W');<?php } ?>" href="javascript: void(0);">Добавить в список желаний</a></td>
<?php } else  { ?>
 <td><a class="add-to-wl-product" onclick="javascript: return <?php if ($login) {?>add_wishlist(<?php echo $product['productid'];?>);<?php } else  { ?>login_popup('W');<?php } ?>" href="javascript: void(0);"><svg><use xlink:href="/images/sprite.svg#favorite"></use></svg></a></td>
<?php } ?>
</tr>
</table>
 </td>
 <td class="more-details">
<div class="more-details-border">
Бренд: 
<a class="main-button buy-with-one-click" onclick="javascript: buy_one_click(<?php echo $product['productid'];?>);" href="javascript: void(0);">Купить в один клик</a>
<br /><br />
<a href="/ticket?productid=<?php echo $product['productid'];?>" class="ajax_link link-button">Задать вопрос об этом товаре</a>
<br /><br /><br />
<div class="price-breaks">
<span>Оптовые цены</span>
<div><table></table><img src="/images/spacer.gif" alt="" /></div>
</div>

<?php if (false && !$oid) {?>
<div class="social-buttons">
<?php $href = $http_location.'/'.$_SERVER['REQUEST_URI']; ?>
	<div class="soc-item">
		<div class="fb-like" data-href="<?php echo $href;?>" data-send="true" data-layout="button_count" data-show-faces="false"></div><?php /* ?><div class="fb-send" data-href="<?php echo $href;?>"></div><?php */ ?>
	</div>

	<div class="soc-item">
		<a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php echo $href;?>" data-count="horizontal">Tweet</a>
	</div>
</div>
<?php } ?>
</div>
 </td>
</tr>
</table>
</form>
<?php if ($oid == 0) {?>

<?php /* ?> Page container assign <?php */ ?>
</div>
</div>
<div class="clear"></div>
</div></div></div>

<div id="product-tabs">
<ul class="product-tabs">
 <li class="tab-1 active" data-tab="1">Описание</li>
 <li class="tab-5" data-tab="5">Отзывы</li>
<?php if ($related_products) {?>
 <li class="tab-2" data-tab="2">Похожие товары</li>
<?php } ?>
<?php /* ?>
<?php if ($recommends) {?>
 <li class="tab-3" data-tab="3">Рекомендуемые товары</li>
<?php } ?>
<?php */ ?>
 <li class="tab-4" data-tab="4">Отправить другу</li>
</ul>
</div>

<div class="page-container page-container-product">
<div class="content">
	<div id="center" class="no_left_menu">

<div class="tab-content tab-description product-tab" id="tab-1">
<h3 class="its4mobile">Описание</h3>
<?php echo func_eol2br($product['descr']);; ?>
</div>

<div class="tab-content hidden product-tab max-mob-width" id="tab-5">
<h3 class="its4mobile">Отзывы</h3>
<?php if ($reviews) {?>
<div class="reviews-list">
<?php foreach ($reviews as $r) {?>
<div class="rating-votes"><div style="width: <?php echo $r['rating'] * 100 / 5;; ?>%;"></div></div>
<b><?php echo $r['name'];?></b>
<div class="message">
<?php echo func_eol2br($r['message']);; ?>
</div>
<?php } ?>
</div>
<br />
<?php } else  { ?>
<h4 class="no-reviews-h4">No reviews yet. Be first.</h4>
<br />
<?php } ?>

<div class="add-review-form">
<h3>Add your review</h3>
<br />
<form method="POST">
<input type="hidden" name="mode" value="add_review" />
<input type="hidden" id="review_rating" name="rating" />
<input type="hidden" name="review_productid" value="<?php echo $product['productid'];?>" />
<table cellspacing="10">
    <tr>
      <td class="name"></td>
      <td class="star">*</td>
      <td><div class="rating"><span class="r1"></span><span class="r2"></span><span class="r3"></span><span class="r4"></span><span class="r5"></span></div></td>
    </tr>

    <tr>
      <td class="name"></td>
      <td class="star">*</td>
      <td>
    <div class="group">
      <input type="text" name="name" required />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Ваше имя</label>
    </div>
      </td>
    </tr>

    <tr>
      <td class="name"></td>
      <td class="star">*</td>
      <td>
    <div class="group">
      <textarea cols="40" rows="4" name="message"></textarea>
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Ваше сообщение</label>
    </div>
      </td>
    </tr>
<?php if ($config['General']['recaptcha_key']) {?>
	<tr>
		<td colspan="2"></td>
		<td><div id="recaptcha_reviews" data-sitekey="<?php echo $config['General']['recaptcha_key'];?>"></div></td>
	</tr>
<?php } ?>
    <tr>
      <td colspan="2"></td>
      <td><br /><button type="button" onclick="javascript: add_review();">Добавить отзыв</td>
    </tr>
</table>
</form>
</div>
</div>

<?php if ($related_products) {?>
<div class="tab-content hidden product-tab" id="tab-2">
<h3 class="its4mobile">Похожие товары</h3>
<?php $products = $related_products; $per_row = 4;; ?>
<?php include SITE_ROOT."/var/cache/ru/common/products.php";?>
</div>
<?php } ?>

<div class="tab-content hidden product-tab max-mob-width" id="tab-4">
<h3 class="its4mobile">Отправить другу</h3>
<form method="POST" id="send_to_friend">
<input type="hidden" name="mode" value="send_to_friend" />

  <table>
    <tr>
      <td class="name" width="170"></td>
      <td class="star">*</td>
      <td>
    <div class="group">
      <input type="text" name="name" required value="<?php echo escape($send_to_friend['name'], 2);; ?>" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Ваше имя</label>
    </div>
      </td>
    </tr>

    <tr>
      <td class="name"></td>
      <td class="star">*</td>
      <td>
    <div class="group">
      <input type="text" name="email" required value="<?php echo escape($send_to_friend['email'], 2);; ?>" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Ваш E-mail</label>
    </div>
      </td>
    </tr>

    <tr>
      <td class="name"></td>
      <td class="star">*</td>
      <td>
    <div class="group">
      <input type="text" name="friend" required value="<?php echo escape($send_to_friend['friend'], 2);; ?>" />
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Электронная почта друга</label>
    </div>

      </td>
    </tr>

    <tr>
      <td colspan="2"></td>
      <td id="send_message_box"><label><input type="checkbox" id="is_msg" name="is_msg" value="1" onclick="javascript: $('.message-box').toggle();" value="Y"<?php if ($send_to_friend['is_msg']) {?> checked<?php } ?> />Добавить личное сообщение</label>
        <div class="message-box<?php if (!$send_to_friend['is_msg']) {?> hidden<?php } ?>">
<br /><br />
    <div class="group">
      <textarea name="message"><?php echo $send_to_friend['message'];?></textarea>
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Ваше сообщение</label>
    </div>


        </div>
      </td>
    </tr>

<?php if ($config['General']['recaptcha_key']) {?>
	<tr>
		<td colspan="2"></td>
		<td><div id="recaptcha_s2f" data-sitekey="<?php echo $config['General']['recaptcha_key'];?>"></div></td>
	</tr>
<?php } ?>

    <tr>
      <td colspan="2">&nbsp;</td>
      <td><br /><button type="button" onclick="javascript: send_to_friend();">Отправить другу</td>
    </tr>
  </table>
</form>
</div>
<?php } ?>

<?php if ($recommends) {?>
<?php /* ?> End page container <?php */ ?>
<br /><br />
</div>
</div>
<div class="clear"></div>
</div>

<div id="home-tabs">
<ul class="home-tabs">
 <li class="tab-1 active" data-tab="1">You may also like</li>
</ul>
</div>

<?php /* ?> Start page container <?php */ ?>
<div class="page-container page-container-2">
<div class="content">
	<div id="center" class="no_left_menu">
<div class="carousel-pr" id="carousel-4">
  <div class="controls">
    <div class="button-left">
      <div class="icon">
        <span></span>
      </div>
    </div>
    <div class="button-right">
      <div class="icon">
        <span></span>
      </div>
    </div>
  </div>
  <div class="carousel-wrapper">
    <div class="content-pr">
<?php $products = $recommends; $per_row = 4;; ?>
<?php include SITE_ROOT."/var/cache/ru/common/products.php";?>
     </div>
  </div>
</div>
<?php } ?>