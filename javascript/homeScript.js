document.addEventListener("DOMContentLoaded", () => {
    // Initial References
    let movieNameRef = document.getElementById("movie-name");
    let searchBtn = document.getElementById("search-btn");
    let result = document.getElementById("result");
    let userGreeting = document.getElementById("user-greeting");

    // Your TMDb API key
    const key = "9a9d653a7ab7e5f532d70976d936ef5c"; // Replace with your TMDb API key

    // Function to fetch data from TMDb API
    let getMovie = () => {
        let movieName = movieNameRef.value;
        let url = `https://api.themoviedb.org/3/search/movie?query=${encodeURIComponent(movieName)}&api_key=${key}`;

        // If input field is empty
        if (movieName.length <= 0) {
            result.innerHTML = `<h3 class="msg">Please Enter A Movie Name</h3>`;
        }
        // If input field is NOT empty
        else {
            fetch(url)
                .then((resp) => resp.json())
                .then((data) => {
                    // If movie exists in database
                    if (data.results && data.results.length > 0) {
                        const movie = data.results[0];
                        let movieDetailsUrl = `https://api.themoviedb.org/3/movie/${movie.id}?api_key=${key}`;

                        fetch(movieDetailsUrl)
                            .then((resp) => resp.json())
                            .then((details) => {
                                result.innerHTML = `
                                    <div class="info">
                                        <img src="https://image.tmdb.org/t/p/w500${details.poster_path}" class="poster">
                                        <div>
                                            <h2>${details.title}</h2>
                                            <div class="rating">
                                                <img src="star-icon.svg">
                                                <h4>${details.vote_average}</h4>
                                            </div>
                                            <div class="details">
                                                <span>${details.release_date}</span>
                                                <span>${details.runtime} min</span>
                                            </div>
                                            <div class="genre">
                                                <div>${details.genres.map(genre => genre.name).join("</div><div>")}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <h3>Plot:</h3>
                                    <p>${details.overview}</p>
                                    <h3>Cast:</h3>
                                    <p id="cast"></p>
                                `;

                            })
                            .catch(() => {
                                result.innerHTML = `<h3 class="msg">Error Occurred While Fetching Details</h3>`;
                            });
                    } 
                    // If movie does NOT exist in database
                    else {
                        result.innerHTML = `<h3 class='msg'>Movie Not Found</h3>`;
                    }
                })
                // If error occurs
                .catch(() => {
                    result.innerHTML = `<h3 class="msg">Error Occurred</h3>`;
                });
        }
    };

    

    // Event listener for search button click
    searchBtn.addEventListener("click", getMovie);

    // Event listener for page load
    window.addEventListener("load", () => {
        getMovie(); // Call getMovie function on page load
        displayUserGreeting(); // Call displayUserGreeting function on page load
    });

});
