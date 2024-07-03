<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <script src="hhapi.js"></script>
  <title>Document</title>
</head>

<body>
  <div id="vacancy-container" class="vacancy-block-container">
    <div class="swiper mySwiper">
      <div class="swiper-wrapper">
        <?php include 'hhapi.php'; ?>
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </div>



</body>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
  var swiper = new Swiper(".mySwiper", {
    slidesPerView: 3,
    spaceBetween: 30,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
  });
</script>

</html>