{if $banners}
 {php $categoryid = 0;}
{include="common/banners.php"}
{/if}

<?php
if (lng('Site title'))
	echo "<h1>".lng('Site title')."</h1>";

if (lng('Site description'))
	echo "<br /><p>".lng('Site description')."</p>";
?>

{if $featured_products}
<h2>{lng[Featured products]}</h2>
{php $products = $featured_products;}
{include="common/products.php"}
{/if}