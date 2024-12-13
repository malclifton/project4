// Function to initialize favorite buttons
function initializeFavoriteButtons() {
  const favoriteButtons = document.querySelectorAll(".add-favorite");

  favoriteButtons.forEach((button) => {
    // Check if the property is already in favorites
    const propertyCard = button.closest(".property-card");
    const address = propertyCard.querySelector("h2").textContent;
    const favorites = JSON.parse(localStorage.getItem("favorites")) || [];
    const isFavorite = favorites.some((fav) => fav.address === address);

    if (isFavorite) {
      button.classList.add("favorited");
      button.textContent = "❤";
    }

    button.addEventListener("click", () => {
      const tag = propertyCard.querySelector(".tag").textContent;
      const description = propertyCard.querySelector("p").textContent;
      const image = propertyCard.querySelector("img").src;

      const property = { tag, address, description, image };

      if (button.classList.contains("favorited")) {
        // Remove from favorites
        removeFromFavorites(address);
        button.classList.remove("favorited");
        button.textContent = "❤";
      } else {
        // Add to favorites
        addToFavorites(property);
        button.classList.add("favorited");
        button.textContent = "❤";
      }
    });
  });
}

// Function to add a property to favorites
// Add to favorites
function addToFavorites(property) {
  const favorites = JSON.parse(localStorage.getItem("favorites")) || [];

  // Avoid duplicates
  const alreadyExists = favorites.some(
    (fav) => fav.address === property.address
  );
  if (!alreadyExists) {
    favorites.push(property);
    localStorage.setItem("favorites", JSON.stringify(favorites));
  }
}

// Check if a property is in favorites
function checkIfFavorite(address) {
  const favorites = JSON.parse(localStorage.getItem("favorites")) || [];
  return favorites.some((fav) => fav.address === address);
}

// Function to remove a property from favorites
function removeFromFavorites(address) {
  const favorites = JSON.parse(localStorage.getItem("favorites")) || [];
  const updatedFavorites = favorites.filter((fav) => fav.address !== address);
  localStorage.setItem("favorites", JSON.stringify(updatedFavorites));
}

// Function to load favorites on the favorites page
function loadFavorites(containerSelector) {
  const favorites = JSON.parse(localStorage.getItem("favorites")) || [];
  const container = document.querySelector(containerSelector);

  if (favorites.length === 0) {
    container.innerHTML = "<p>No favorites yet.</p>";
    return;
  }

  favorites.forEach((favorite) => {
    const card = document.createElement("div");
    card.classList.add("property-card");
    card.innerHTML = `
      <div class="property-image">
        <img src="${favorite.image}" alt="Property">
      </div>
      <div class="property-info">
        <div class="tag">${favorite.tag}</div>
        <h2>${favorite.address}</h2>
        <p>${favorite.description}</p>
      </div>
    `;
    container.appendChild(card);
  });
}

// Initialize favorite buttons on page load
document.addEventListener("DOMContentLoaded", initializeFavoriteButtons);
