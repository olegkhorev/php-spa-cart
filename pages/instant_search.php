<?php
use FuzzyWuzzy\Fuzz;
use FuzzyWuzzy\Process;
use \Nullform\Fuzzio\Fuzzio;
use \Nullform\Fuzzio\FuzzioString;

if ($_GET['q']) {
	$_GET['fuzzy_search'] = $_SESSION['substring'] = $substring = $_GET['q'];
}

$file = file(SITE_ROOT.'/var/fuzzy_keywords.txt');
if ($file) {
	$file = array_map('trim', $file);
   $array_of_counts = array();
   $list = array();
   foreach ($file as $word) {
       $tmp = explode(':::', $word);
       $array_of_counts[$tmp[0]] = $tmp[1];
       $list[] = array(
          'id' => trim($tmp[0]),
          'name'  => trim($tmp[1]),
       );
   }

   $options = [
     'keys'              => ['name'],
     'includeScore'      => true,
     'includeMatches'    => true,
     'location'   => 0,
     'distance'   => 100,
     'ignoreLocation'   => true,
		'isCaseSensitive'			=> false,
//					'minMatchCharLength'	=> strlen($_GET['fuzzy_search']) > 3 ? 4 : 0 # can be needed in some cases
   ];

   $fuse = new \Fuse\Fuse($list, $options);
   $tmp = $fuse->search($_GET['fuzzy_search']);

   $file2 = file(SITE_ROOT.'/var/fuzzy_keywords_words.txt');
   $list2 = array();
   foreach ($file2 as $word) {
       $tmp3 = explode(':::', $word);
       $array_of_counts[$tmp3[0]] = $tmp3[1];
       $list2[] = array(
          'id' => trim($tmp3[1]),
          'name'  => trim($tmp3[0]),
       );
   }

   $fuse2 = new \Fuse\Fuse($list2, $options);
   $tmp2 = $fuse2->search($_GET['fuzzy_search']);
   $meant = array();
   foreach ($tmp2 as $k=>$v) {
      $word = $v['item']['name'];
      $score = $v['score'];
      if (count($meant) < 3 && $word != $_GET['fuzzy_search'] && $score < 0.4) {
         $meant[] = $word;
      }
   }

	function sortByLength($a,$b){
	    return strlen($b)-strlen($a);
	}

	$result = array();
	foreach ($tmp as $k=>$v) {
		$word = $v['item']['name'];
		$score = $v['score'];
		if ($score > 0.7)
			continue;

		$product_id = $v['item']['id'];
		$count = $array_of_counts[$word];
		$to_replace = array();
		foreach ($v['matches'][0]['indices'] as $rep) {
			$start = $rep[0];
			$end = $rep[1];
			$text = '';
			$found = false;
			for ($k2 = 0; $k2 < strlen($word); $k2++) {
				if ($k2 == $start) {
                $found = true;
            }

            if ($found)
                $text .= $word[$k2];

            if ($k2 == $end)
                $found = false;
        }

        $to_replace[] = $text;
		}

		usort($to_replace, 'sortByLength');
		 foreach ($to_replace as $k2=>$v2) {
	       $word = str_replace($v2, '<b>'.$v2.'</b>', $word);
	    }

	    $result[$product_id] = $word;
	    if (count($result) > 20)
	        break;
	}

	if ($meant) {
		$template['meant'] = $meant;
	}

	if ($result) {
		$products = array();
		foreach ($result as $pid=>$word) {
			$product = $db->row("SELECT * FROM products WHERE productid='".addslashes($pid)."' AND status='1'");
			if (!$product)
				continue;

			if ($product['photoid'])
				$product['photo'] = $db->row("SELECT * FROM products_photos WHERE photoid='".$product['photoid']."'");

			$product['name'] = $word;
			$products[] = $product;
		}

		$template['products'] = $products;
	}
} else {
	$sort_by = array(
		'2'		=> 'Name',
		'3'		=> 'Price',
		'4'		=> 'Bestsellers',
		'5'		=> 'Most viewed',
		'6'		=> 'Newest'
	);

	$template['sort_by'] = $sort_by;
	$template['bread_crumbs'][] = array('', "Search");
	$search_condition = array();
	$search_condition['substring'] = $_SESSION['substring'];
	$search_condition['orderby'] = 'p.sales_stats DESC, p.views_stats DESC, p.add_date DESC';
	if (!$_GET['sort']) {
		$_GET['sort'] = 2;
		$_GET['direction'] = 1;
		$is_sort = false;
	} else
		$is_sort = true;

	$search_condition['sort'] = $_GET['sort'];
	$search_condition['per_page'] = 10;
	include SITE_ROOT . '/includes/search.php';
	$template['products'] = $products;
}

$html = get_template_contents('common/instant_search.php');
echo $html;
exit;