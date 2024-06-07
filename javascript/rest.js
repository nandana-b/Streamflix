// Define the showMovieInfo function to display movie details in modal
function showMovieInfo(movie) {
    // Get modal elements
    const modal = document.getElementById("modal");
    const modalPoster = document.getElementById("modal-poster");
    const modalTitle = document.getElementById("modal-title");
    const modalRating = document.getElementById("modal-rating");
    const modalOverview = document.getElementById("modal-overview");

    // Set modal content based on movie data
    if (movie.poster_path) {
        modalPoster.src = "https://image.tmdb.org/t/p/w500" + movie.poster_path; // Set poster image from TMDb API
    } else {
        modalPoster.src = "default_poster.jpg";  // Fallback poster image if poster_path is not available
    }
    modalTitle.textContent = movie.title || 'No title available'; // Set movie title or default if not available
    modalRating.textContent = "Rating: " + (movie.vote_average || 'N/A'); // Set movie rating or N/A if not available
    modalOverview.textContent = movie.overview || 'No overview available'; // Set movie overview or default if not available

    // Show modal
    modal.style.display = "block";
}

// Attach event listeners after the DOM content is loaded
document.addEventListener("DOMContentLoaded", function() {
    const closeBtn = document.querySelector(".modal .close"); // Get close button element

    // Close modal when close button is clicked
    closeBtn.onclick = function() {
        const modal = document.getElementById("modal"); // Get modal element
        modal.style.display = "none"; // Hide modal
    }

    // Close modal when clicking outside the modal
    window.onclick = function(event) {
        const modal = document.getElementById("modal"); // Get modal element
        if (event.target === modal) {
            modal.style.display = "none"; // Hide modal
        }
    }
});
