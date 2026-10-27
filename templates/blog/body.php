<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
{if $blog}

{if $config['General']['recaptcha_key']}
<script src='https://www.google.com/recaptcha/api.js'></script>
{/if}

<div class="blog">
<div class="actions">
{if $comments}
<svg><use xlink:href="/images/sprite_3.svg#go_to_comments"></use></svg> <a href="javascript: void(0);" onclick="javascript: go_to_comments();">{lng[Go to comments|escape]}</a>&nbsp;
{/if}
<svg><use xlink:href="/images/sprite_3.svg#leave_comment"></use></svg> <a href="javascript: void(0);" onclick="javascript: leave_comments();">{lng[Leave a comment]}</a>
</div>
<h1>{$blog['title']}</h1>
<br />
<svg class="post_date_icon"><use xlink:href="/images/sprite_3.svg#calendar"></use></svg> &nbsp; {php echo date($datetime_format, $blog['date']);}
{if $blog['imageid']}
<div class="image">
{blog_image image=`$blog` new_width=750 new_height=400}
</div>
{/if}
<div class="fulldescr">{$blog['fulldescr']}</div>

<?php if ($comments) { ?>
<h3 id="blog_comments_section"><?php echo $blog["comments"]
    ? $blog["comments"]
    : "0"; ?> {lng[Blog comments]}</h3>

<div style="text-align:right">{include="common/navigation.php"}</div>

<div class="blog_comments">
{foreach $comments as $k=>$v}
<div class="author">
<div class="quote">
<svg><use xlink:href="/images/sprite_3.svg#quote"></use></svg> <a href="javascript: void(0);" onclick="javascript: quote_comment_html('{$v['commentid']}', '{php $name = $v['name'] ? $v['name'] : $v['firstname'].' '.$v['lastname']; $name = escape($name, 1); echo escape($name, 2);}');">{lng[Quote]}</a>
</div>
{lng[Comment from]} <b>{php echo $v['name'] ? $v['name'] : $v['firstname'].' '.$v['lastname'];}</b>. {lng[Commented on]} {php echo date($datetime_format, $v['date']);}.
</div>
<span id="comment_{$v['commentid']}" class="hidden">{$v['message']}</span>
<div class="comment">
{$v['message']}
</div>
{/foreach}
</div>
{else}
<br /><div style="text-align:center">{lng[No comments yet]}</div><br /><br />
{/if}

<a id="leave_comment"></a>
<h3>{lng[Leave a comment]}</h3>

{if !$login && $config['Blog']['blog_guests'] != "Y"}
<br />
<div style="text-align:center">{lng[You should be a registered user to leave a comment.]}</div>
<br /><br />
{else}
<form method="post" name="blogform" class="ajax-form">
<input type="hidden" name="blogid" value="<?php echo $blog["blogid"]; ?>">
<table id="blog_bb_buttons">
<tbody>
<tr>
 <td><button type="button" onclick="javascript: iBold();"><b>B</b></button></td>
 <td><button type="button" onclick="javascript: iItalic();"><i>I</i></button></td>
 <td><button type="button" onclick="javascript: iUnderline();"><u>U</u></button></td>
 <td><button type="button" id="iLinkClickA" onclick="javascript: iLinkClick();">&nbsp;&#128279;&nbsp;</button></td>
</tr>
</tbody>
</table>

<div id="newrecord" contenteditable="true">{if $new_comment}{$new_comment['comment']}{/if}</div>
<textarea name="comment" cols="80" rows="15">{if $new_comment}{$new_comment['comment']}{/if}</textarea>

{if $login}
<br />
{else}
<div class="group">
  <input type="text" size="30" required name="new_name"{if $new_comment} value="{php echo escape($new_comment['new_name'], 2);}"{/if}>
  <span class="highlight"></span>
  <span class="bar"></span>
  <label>{lng[Your name]}</label>
</div>
{if $config['General']['recaptcha_key']}
<div class="g-recaptcha" data-sitekey="{$config['General']['recaptcha_key']}"></div>
{/if}
<br />
{/if}

<button type="button" onclick="javascript: new_comment();">{lng[Add]}</button>
<br /><br />
</form>
<?php } ?>
{elseif $blogs}
<h1>{lng[Blog]}</h1><br />
{if $total_pages > 2}
<div style="text-align:right">{include="common/navigation.php"}</div>
<br />
{/if}
<div class="blogs news-item news-item-page">
{foreach $blogs as $b}
{php $url = $current_location.'/blog/'.($b['cleanurl'] ? $b['cleanurl'].'.html' : $b['blogid']);}
<div class="image">
{if $b['imageid']}
<a href="{$url}" class="ajax_link">
{blog_image image=`$b` new_width=250 new_height=250}
</a>
{/if}
</div>
<div class="descr">
 <h2>
<span class="date"><?php echo date(
    $date_format,
    $b["date"],
); ?></span> 
 <a href="{$url}" class="ajax_link simple-button">{$b['title']}</a></h2>
 <div class="message-box">{$b['descr']}</div>
 <div style="text-align:right"><a class="ajax_link link-button" href="{$url}">{lng[See full post]}</a>&nbsp;</div>
</div>
<div class="clear"></div>
<br />
{/foreach}
</div>
{if $total_pages > 2}
<div style="text-align:right">{include="common/navigation.php"}</div>
<br />
{/if}
{else}
<br />
<div style="text-align:center">{lng[No topics yet]}</div>
{/if}