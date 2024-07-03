<?php
// $url = file_get_contents(
//   "https://api.hh.ru/vacancies?employer_id=3468159",
//   0,
//   stream_context_create([
//     'http' => [
//       'method' => 'GET',
//       'header' =>
//       'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',
//     ],
//   ])
// );

// $data = json_decode($url, true);

$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, "https://api.hh.ru/vacancies?employer_id=3468159");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, [
  'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',
]);

$response = curl_exec($curl);
$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

curl_close($curl);

if ($httpCode === 200) {
  // Request successful, process the response
  $data = json_decode($response, true);
  // Do something with the data
} else {
  // Request failed, handle the error
  echo "Failed to fetch data. HTTP code: " . $httpCode;
}

$count = 0;
foreach ($data['items'] as $item) {
  if ($count >= 5) {
    break;
  }
  $experience = $item['experience']['id'] == 'noExperience' ? 'Без опыта' : $item['experience']['name'];
?>

  <div class="vacancy-block swiper-slide">
    <h4><?php echo $item['name']; ?></h4>
    <p class="vacancy-salarys"><?php if ((!$item['salary'])) {
                                  echo "По договоренности" . "<span>" . $experience . "</span>";
                                } else if ($item['salary']['from'] && !$item['salary']['to']) {
                                  echo $item['salary']['from'] . ' ₽ ' . "<span>" . $experience . "</span>";
                                } else {
                                  echo $item['salary']['from'] . ' ₽' . " - " . $item['salary']['to'] . ' ₽' . "<span>" .  $experience . "</span>";
                                }
                                ?></p>
    <p><?php echo $item['address']['raw']; ?></p>
    <p><?php echo $item['snippet']['responsibility']; ?></p>
  </div>

<?php
  $count++;
}
?>



<!-- print_r($data['items'][0]['name']);
print_r($data['items'][0]['address']);
print_r($data['items'][0]['snippet']['responsibility']);
print_r($data['items'][0]['experience']['name']);
print_r($data['items'][0]['schedule']['name']); 
-->