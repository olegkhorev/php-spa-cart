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
<img src="{$current_location}/images/comments.gif" alt="" /> <a href="{$_REQUEST_URI}#comments">{lng[Go to comments|escape]}</a>&nbsp;
{/if}
<img src="{$current_location}/images/leave_comment.gif" alt="" /> <a href="{$REQUEST_URI}#leave_comment">{lng[Leave a comment]}</a>
</div>
<h1>{$blog['title']}</h1>
<br />
<img src="{$current_location}/images/blog_date.gif" alt="" /> {php echo date($datetime_format, $blog['date']);}
{if $blog['imageid']}
<div class="image">
{blog_image image=`$blog` new_width=750 new_height=400}
</div>
{/if}
<div class="fulldescr">{$blog['fulldescr']}</div>

<?php if ($comments) { ?>
<a id="comments"></a>
<h3><?php echo $blog["comments"]
    ? $blog["comments"]
    : "0"; ?> {lng[Blog comments]}</h3>

<div style="text-align:right">{include="common/navigation.php"}</div>

<div class="blog_comments">
{foreach $comments as $k=>$v}
<div class="author">
<div class="quote">
<img src="{$current_location}/images/quote.gif" alt="" /> <a href="javascript: void(0);" onclick="javascript: quote_comment('{$v['commentid']}', '{php $name = $v['name'] ? $v['name'] : $v['firstname'].' '.$v['lastname']; $name = escape($name, 1); echo escape($name, 2);}');">{lng[Quote]}</a>
</div>
{lng[Comment from]} <b>{php echo $v['name'] ? $v['name'] : $v['firstname'].' '.$v['lastname'];}</b>. {lng[Commented on]} {php echo date($datetime_format, $v['date']);}.
</div>
<span id="comment_{$v['commentid']}" class="hidden">{$v['message']}</span>
<div class="comment">
{$v['bb_message']}
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
<form method="post" name="blogform">
<input type="hidden" name="blogid" value="<?php echo $blog["blogid"]; ?>">
<a onmouseover="javascript: bbhelp('b');" onmouseout="javascript: bbhelp();" href="javascript: bbcode('[b]','[/b]');"><img alt="" src="{$current_location}/images/bbcodes/b.png"></a>
<a onmouseover="javascript: bbhelp('i');" onmouseout="javascript: bbhelp();" href="javascript: bbcode('[i]','[/i]')"><img alt="" src="{$current_location}/images/bbcodes/i.png"></a>
<a onmouseover="javascript: bbhelp('u');" onmouseout="javascript: bbhelp();" href="javascript: bbcode('[u]','[/u]')"><img alt="" src="{$current_location}/images/bbcodes/u.png"></a>
<a onmouseover="javascript: bbhelp('s');" onmouseout="javascript: bbhelp();" href="javascript: bbcode('[s]','[/s]')"><img alt="" src="{$current_location}/images/bbcodes/s.png"></a>
<a onmouseover="javascript: bbhelp('url');" onmouseout="javascript: bbhelp();" href="javascript: bbcode('[url]','[/url]')"><img alt="" src="{$current_location}/images/bbcodes/url.png"></a>
<a onmouseover="javascript: bbhelp('email');" onmouseout="javascript: bbhelp();" href="javascript: bbcode('[email]','[/email]')"><img alt="" src="{$current_location}/images/bbcodes/email.png"></a>
<a onmouseover="javascript: bbhelp('img');" onmouseout="javascript: bbhelp();" href="javascript: bbcode('[img]','[/img]')"><img alt="" src="{$current_location}/images/bbcodes/img.png"></a>
<a onmouseover="javascript: bbhelp('list');" onmouseout="javascript: bbhelp();" href="javascript: bbcode('[list][*]','[/*][/list]')"><img alt="" src="{$current_location}/images/bbcodes/list.png"></a>
<a onmouseover="javascript: bbhelp('li');" onmouseout="javascript: bbhelp();" href="javascript: bbcode('[*]','[/*]')"><img alt="" src="{$current_location}/images/bbcodes/li.png"></a>
<a onmouseover="javascript: bbhelp('quote');" onmouseout="javascript: bbhelp();" href="javascript: bbcode('[quote]','[/quote]')"><img alt="" src="{$current_location}/images/bbcodes/quote.png"></a>
<a onmouseover="javascript: bbhelp('code');" onmouseout="javascript: bbhelp();" href="javascript: bbcode('[code]','[/code]')"><img alt="" src="{$current_location}/images/bbcodes/code.png"></a>

&nbsp;
<input id="helptext" type="hidden">
<br />

<textarea name="comment" cols="80" rows="15">{$new_comment['comment']}</textarea>
<br /><br />

{if !$login}
{lng[Name]} <span style="color:#880000">*</span>: <input type="text" size="30" name="new_name" value="{php echo escape($new_comment['new_name'], 2);}">
<br />
{if $config['General']['recaptcha_key']}
<br />
<div class="g-recaptcha" data-sitekey="{$config['General']['recaptcha_key']}"></div>
{/if}
<br />
{/if}

<button type="button" onclick="javascript: new_comment();">{lng[Add]}</button>
<br /><br />
</form>
<?php } ?>
</div>
{elseif $blogs}
{if $total_pages > 2}
<div style="text-align:right">{include="common/navigation.php"}</div>
<br />
{/if}
<div class="blogs">
{foreach $blogs as $b}
{php $url = $current_location.'/blog/'.($b['cleanurl'] ? $b['cleanurl'].'.html' : $b['blogid']);}
<div class="author">
<i>{$b['firstname']} {$b['lastname']}, {php echo $b['comments'] ? $b['comments'] : '0';} {lng[Comments]}</i>
<a href="{$url}" class="simple-button"><?php echo $b["title"]; ?></a>
</div>
<div class="image">
{if $b['imageid']}
<a href="{$url}">
{blog_image image=`$b` new_width=750 new_height=400}
</a>
{/if}
</div>
<div class="descr">
{$b['descr']}
<div style="text-align:right">
<img src="{$current_location}/images/read_more.gif" alt="{lng[Read blog|escape]}" /> <a href="{$url}">{lng[Read blog]}</a>&nbsp;
<img src="{$current_location}/images/leave_comment.gif" alt="{lng[Leave a comment|escape]}" /> <a href="{$url}#leave_comment">{lng[Leave a comment]}</a>
</div>
</div>
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