const prevButton = document.getElementById("prevButton");
const nextButton = document.getElementById("nextButton");
const carouselContainer = document.querySelector(".carousel-container");
let currentIndex = 0;
let filteredCards = [];
const cards = document.querySelectorAll(".property-card");
const cardsPerPage = 3;
const propertySearchInput = document.getElementById("propertySearch");

//update the carousel with visible cards
function updateCarousel() {
  //hide all cards at first
  cards.forEach((card) => {
    card.style.display = "none";
  });

  //only show filtered cards
  const start = currentIndex * cardsPerPage;
  const end = start + cardsPerPage;
  filteredCards.slice(start, end).forEach((card) => {
    card.style.display = "block";
  });
}

// show previous 3 cards
prevButton.addEventListener("click", () => {
  if (currentIndex > 0) {
    currentIndex--;
    updateCarousel();
  }
});

// show next 3 cards
nextButton.addEventListener("click", () => {
  if (currentIndex < Math.floor(filteredCards.length / cardsPerPage)) {
    currentIndex++;
    updateCarousel();
  }
});

// filter based on the search query
propertySearchInput.addEventListener("input", () => {
  const searchTerm = propertySearchInput.value.toLowerCase().trim();
  filteredCards = Array.from(cards).filter((card) => {
    const tag = card.querySelector(".tag").textContent.toLowerCase(); //details
    const address = card.querySelector("h2").textContent.toLowerCase(); //home address
    const description = card.querySelector("p").textContent.toLowerCase(); //details

    return (
      address.includes(searchTerm) ||
      description.includes(searchTerm) ||
      tag.includes(searchTerm)
    );
  });

  // reset the carousel to show the first filtered results
  currentIndex = 0;
  updateCarousel();
});

//all cards visible
filteredCards = Array.from(cards);
updateCarousel();
