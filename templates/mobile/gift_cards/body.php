<div class="padding-page gift_cards">
<h1>{lng[Gift Cards]}</h1>

<h3>Purchase a new gift card</h3>
<input type="text" name="gift_card" id="gift_card" placeholder="Enter Gift Card amount $" />
<button>{lng[Add to cart]}</button>
{if $gift_cards}

<h3>{lng[Earlier purchased gift cards]}</h3>
<div>
{foreach $gift_cards as $k=>$v}
<p>Key prase: {$v['gcid']}<br />Total: {price $v['amount']}<br />Amount left: {price $v['amount_left']}</p>
<hr />
{/foreach}
</div>
{/if}
