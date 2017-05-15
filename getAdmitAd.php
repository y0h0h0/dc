<?

function getAdmitAd($place, $limit, $offers, $query) {
  $src = json_decode(@file_get_contents('http://widget.admitad.com/market/search?place='.$place.'&offers='.$offers.'&limit='.$limit.'&q='.$query.'&partner=m&ip='.$_SERVER['REMOTE_ADDR']), true);

  for($i=0;$i<count($src['result']);$i++) {

      $data[$i] = array(
        'photo'=>$src['result'][$i]['photo']['url'],
        'name'=>$src['result'][$i]['name']
      );

      for($n=0;$n<count($src['result'][$i]['offers']);$n++) {
        $data[$i]['offers'][$n] = array(
          'price' =>  $src['result'][$i]['offers'][$n]['price'],
          'currency' =>  $src['result'][$i]['offers'][$n]['currencyName'],
          'shop' =>  $src['result'][$i]['offers'][$n]['shop']['name'],
          'rating' =>  $src['result'][$i]['offers'][$n]['shop']['rating']*20,
          'url' =>  $src['result'][$i]['offers'][$n]['url']
        );
      }
  }
  return $data;
}

$galaxy = getAdmitAd('21082', 1, 3, 'galaxy s8'); // 1 товар, 3 магазина.

$galaxy_list = getAdmitAd('21082', 6, 1, 'Samsung galaxy s8'); // 6 товаров по одному магазину для каждого.
