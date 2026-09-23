<?php
use FuzzyWuzzy\Fuzz;
use FuzzyWuzzy\Process;
use \Nullform\Fuzzio\Fuzzio;
use \Nullform\Fuzzio\FuzzioString;

$file = file(SITE_ROOT.'/var/fuzzy_keywords.txt');
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

if ($meant) {
   echo '<pre>';
   echo '<h3>'.lng('Did you mean?').'</h3>';
   echo print_R($meant).'<hr>';
}

function sortByLength($a,$b){
    return strlen($b)-strlen($a);
}

$result = array();
foreach ($tmp as $k=>$v) {
    $word = $v['item']['name'];
				$score = $v['score'];
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

    $result[$product_id] = 'Score: '.$score.'. '.$word.' - '.$count.'<br /><a href="/product/'.$product_id.'" target="_blank">Product</a><hr>';
    if (count($result) > 20)
        break;
}

if (count($result) < 20) {
   $file = file(SITE_ROOT.'/var/fuzzy_keywords_descr.txt');
	$file = array_map('trim', $file);
   $array_of_counts = array();
   $list = array();
   foreach ($file as $word) {
       $tmp = explode(':::', $word);
      $tmp[1] = str_replace("\n", " ", $tmp[1]);
      $tmp[1] = str_replace("\r", " ", $tmp[1]);
         if (!trim(trim($tmp[1])))
            continue;

       $array_of_counts[$tmp[0]] = $tmp[1];
       $list[] = array(
          'id' => trim($tmp[0]),
          'name'  => trim($tmp[1]),
       );
   }

   $fuse = new \Fuse\Fuse($list, $options);
   $tmp = $fuse->search($_GET['fuzzy_search']);
   foreach ($tmp as $k=>$v) {
      $word = $v['item']['name'];
      $score = $v['score'];
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

      $result[$product_id] = 'Score: '.$score.'. '.$word.' - '.$count.'<br /><a href="/product/'.$product_id.'" target="_blank">Product</a><hr>';
      if (count($result) > 20)
         break;
   }
}
exit;