<?php 
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<h1>Import catalog</h1>
<form method="post" accept-charset="utf-8" class="list-form noajax" name="exportForm" enctype="multipart/form-data">
<br />
<table class="import table-w-800">
<tr>
 <td>Select import file</td>
 <td><input type="file" name="file" size="40" /></td>
</tr>
<tr>
 <td>Delimiter</td>
 <td>
<select name="delimiter">
  <option value=",">Comma</option>
  <option value=";">Semicolon</option>
  <option value="tab">Tab</option>
</select>
 </td>
</tr>
<tr>
 <td></td>
 <td><button type="submit">Import</button></td>
</tr>
</table>

</form>

<br /><br />

<b>To make import file, first export and see how it should look.</b>

<br /><br />

<span class="star">*</span> You can use URLs as any image path in the import file. It will be downloaded and added to your collection
<br />
<br />
<span class="star">*</span><span class="star">*</span> Existing images, or if you just wish, should be uploaded manually as into the "/var/import_export/" and separate folders. Folders names are:<br /><br />
<table>
<tr>
 <td style="width:150px">categories_banners</td>
 <td>Categories banners</td>
</tr>
<tr>
 <td>products_images</td>
 <td>Products images</td>
</tr>
<tr>
 <td>variants_images</td>
 <td>Variants images</td>
</tr>
</table>
<br />
File name must be as in import file.
<br /><br />
Categories banners, products images, variants images - if you import them for specific category/product/variant, old images removed and replaced by new.
<br />
<br />
<br />
<span class="star">*</span><span class="star">*</span><span class="star">*</span> You can use SKU instead of !PRODUCT_ID in the following tables:<br />
<ul>
 <li>Products images</li>
 <li>Products options</li>
 <li>Variants</li>
 <li>Wholesale prices</li>
</ul>


<span class="star">*</span><span class="star">*</span><span class="star">*</span><span class="star">*</span> You can also use SKU instead of !VARIANT_ID

<br /><br />

<span class="star">*</span><span class="star">*</span><span class="star">*</span><span class="star">*</span><span class="star">*</span> Import support importing new items. Just insert new ID's. Categories does not support to add them.

<br /><br />

<span class="star">*</span><span class="star">*</span><span class="star">*</span><span class="star">*</span><span class="star">*</span><span class="star">*</span> Import headers are must be. Import fields header is not recognized yet so import rows must include all fields.