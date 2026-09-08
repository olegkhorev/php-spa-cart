<div class="padding-page gift_cards">
<h1>Gift Cards</h1>

<h3>Purchase a new gift card</h3>
<input type="text" name="gift_card" id="gift_card" placeholder="Enter Gift Card amount $" />
<button>Add to cart</button>
<?php if ($gift_cards) {?>

<h3>Earlier purchased gift cards</h3>
<div>
<?php foreach ($gift_cards as $k=>$v) {?>
<p>Key prase: <?php echo $v['gcid'];?><br />Total: <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($v['amount']); ?><br />Amount left: <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($v['amount_left']); ?></p>
<hr />
<?php } ?>
</div>
<?php } ?>
