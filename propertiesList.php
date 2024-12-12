<?php
$properties = file('./properties.txt', FILE_IGNORE_NEW_LINES);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./property.css" />
  <title>HubbleHome</title>
</head>

<body>
  <div class="container">
    <br /><br /><br />
    <div class="header">
      <h1>Properties</h1>
      <div class="header-right">
        <div class="header-buttons">
          <a onclick="window.location.href = './landingpage.html';">⌂</a>
          <a onclick="window.location.href = './account.html';">☺</a>
          <a onclick="window.location.href = './favorites.html';">♡</a>
        </div>
        <div class="property-search">
          <input
            type="search"
            placeholder="For Sale"
            id="propertySearch"
            name="propertySearch" />
          <button>⌕</button>
        </div>
      </div>
    </div>
    <br /><br /><br />
    <div class="carousel" id="carousel">
      <button class="carousel-button" id="prevButton">⪡</button>
      <div class="carousel-container">
        <?php foreach ($properties as $line):
          // Split the line into an array
          $details = explode('|', $line);

          //image path
          $image = array_pop($details);

          // join remaining details
          $address = $details[1];
          $tag = $details[0];
          $description = implode(' | ', array_slice($details, 2));
        ?>
          <div class="property-card">
            <div class="property-image">
              <img src="<?= htmlspecialchars($image) ?>" alt="Property">
            </div>
            <div class="property-info">
              <div class="tag"><?= htmlspecialchars($tag) ?></div>
              <h2><?= htmlspecialchars($address) ?></h2>
              <p><?= htmlspecialchars($description) ?></p>
            </div>
            <div class="favorite-icon">
              <button class="add-favorite" id="favorite-btn-<?= htmlspecialchars($address) ?>" data-address="<?= htmlspecialchars($address) ?>" data-description="<?= htmlspecialchars($description) ?>" data-image="<?= htmlspecialchars($image) ?>">❤</button>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <button class="carousel-button" id="nextButton">⪢</button>
    </div>
  </div>
  <script src="./index.js"></script>
</body>

</html>