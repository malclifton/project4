<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./index.css" />
  <title>HubbleHome</title>
</head>

<body class="landing">
  <div class="taskbar">
    <h2>HubbleHome</h2>
    <div class="task_buttons" id="taskButtons">
      <button id="login" onclick="window.location.href = './signUp.html';">
        SIGN UP
      </button>
      <button id="signup" onclick="window.location.href = './signIn.html';">
        SIGN IN
      </button>
    </div>
  </div>
  <div class="page">
    <h1>
      The best place<br />
      is right here.
    </h1>
    <div class="page_buttons">
      <button id="about" onclick="window.location.href = './about.html';">
        ABOUT
      </button>
      <button
        id="view"
        onclick="window.location.href = './propertiesList.php';">
        VIEW HOMES
      </button>
    </div>
  </div>

  <!-- Popup -->
  <div class="popup-overlay" id="popupOverlay"></div>
  <div class="popup" id="popupMessage">
    <p id="popupText"></p>
    <button id="closePopupButton" onclick="closePopup()">Ok</button>
  </div>
  <script>
    function getQueryParams() {
      return new URLSearchParams(window.location.search);
    }

    function removeQueryParams() {
      const url = new URL(window.location.href);
      url.search = "";
      window.history.replaceState({}, document.title, url.toString());
    }

    const isLoggedIn = <?php echo json_encode($_SESSION['logged_in'] ?? false); ?>;
    const username = <?php echo json_encode($_SESSION['username'] ?? ''); ?>;

    function manageButtons() {
      const taskButtons = document.getElementById("taskButtons");

      if (isLoggedIn) {
        taskButtons.innerHTML = `
            <span>Welcome, ${username}!</span>
            <button onclick="window.location.href = './logout.php';">LOG OUT</button>
          `;
      } else {
        taskButtons.innerHTML = `
            <button id="login" onclick="window.location.href = './signUp.html';">SIGN UP</button>
            <button id="signup" onclick="window.location.href = './signIn.html';">SIGN IN</button>
          `;
      }
    }

    function showPopup() {
      const params = getQueryParams();
      const popupText = document.getElementById("popupText");

      if (params.get("signin") === "success") {
        const username = params.get("username") || "User";
        popupText.textContent = `Sign in successful. Welcome, ${username}!`;
      } else if (params.get("logout") === "success") {
        popupText.textContent = "Goodbye! You have been logged out.";
      } else {
        return;
      }

      document.getElementById("popupOverlay").classList.add("visible");
      document.getElementById("popupMessage").classList.add("visible");
      removeQueryParams();
    }

    function closePopup() {
      document.getElementById("popupOverlay").classList.remove("visible");
      document.getElementById("popupMessage").classList.remove("visible");
    }

    document.addEventListener("DOMContentLoaded", () => {
      manageButtons();
      showPopup();
    });
  </script>
</body>

</html>