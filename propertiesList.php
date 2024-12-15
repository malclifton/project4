<?php
$host = "localhost";
$user = "mclifton6";
$pass = "mclifton6";
$dbname = "mclifton6";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
  die("Database connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, tag, address, description, image_path FROM properties";
$result = $conn->query($sql);
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
          <a onclick="window.location.href = './landingpage.php';">⌂</a>
          <a onclick="window.location.href = './propertiesList.php';">🕶</a>
          <a onclick="window.location.href = './favorites.html';">♡</a>
        </div>
        <div class="property-search">
          <input type="search" placeholder="For Sale" id="propertySearch" name="propertySearch" />
          <button>⌕</button>
        </div>
      </div>
    </div>
    <br /><br /><br />
    <div class="carousel" id="carousel">
      <button class="carousel-button" id="prevButton">⪡</button>
      <div class="carousel-container">
        <?php
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $tag = htmlspecialchars($row['tag']);
            $address = htmlspecialchars($row['address']);
            $description = htmlspecialchars($row['description']);
            $image = htmlspecialchars($row['image_path']);
            $propertyId = $row['id'];
        ?>
            <div class="property-card">
              <div class="property-image">
                <img src="<?= $image ?>" alt="Property">
              </div>
              <div class="property-info">
                <div class="tag"><?= $tag ?></div>
                <h2><?= $address ?></h2>
                <p><?= $description ?></p>
              </div>
              <div class="favorite-icon">
                <button class="add-favorite" data-property-id="<?= $propertyId ?>">❤</button>
              </div>
              <div class="details-button">
                <button class="infoButton" onclick="window.location.href='./property/p<?= $propertyId ?>.html';">View Property</button>
              </div>
            </div>
        <?php
          }
        } else {
          echo "<p>No properties found.</p>";
        }
        ?>
      </div>

      <button class="carousel-button" id="nextButton">⪢</button>
    </div>
  </div>
  <script src="./index.js"></script>
  <script src="./favorites.js"></script>
</body>

</html>

<?php
$conn->close();
?>