const movie_names = ['Joker', 'Avengers', 'War', 'Saaho', 'Bahubali', 'Master', 'Parasite', 'Black Panther', 'Krack', 'Fight Club'];
for (let i = 0; i < movie_names.length; i++) {
    let s = `<div class="movie">
            <img class = "movie-image" src="images/${i + 1}.jpg">
            <p class="rating rating-${i + 1}">⭐</p>
            <p class="movie-name">${movie_names[i]}</p>
            <form method="post">
                <select name="user_rating_${i + 1}" class="user-rating user-rating-${i + 1}">
                    <option value="">Select Rating</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select><br>
                <button name ="submit" value ="${movie_names[i]}" class="rate-button rate-button-${i + 1}">Rate</button>
            </form>
            <input type ="text" class ="after_rating after_rating_${i + 1} hidden" value = "" readonly>
        </div>`
    document.querySelector('.mid-container').insertAdjacentHTML('beforeend', s);
}