// Nutrition Screen Functions

// Object containing predetermined foods and their calorie amounts
var predeterminedFoods = {
    "egg": 80,
    "toast": 100,
    "banana": 105,
    "sausage": 200,
    "cheeseburger": 700,
    "pizza": 150,
    "chicken breast": 200,
    "salmon": 500,
    // Add more foods here
};

function addFood(meal) {
    var inputId = meal + '-input';
    var listId = meal + '-list';
    var foodInput = document.getElementById(inputId);
    var food = foodInput.value.trim().toLowerCase(); // Convert input to lowercase for case-insensitive comparison
    var foodCalories = predeterminedFoods[food]; // Get the calorie amount for the entered food

    if (!food || !foodCalories) {
        alert("Please enter a valid food item.");
        return;
    }

    // Subtract calories from the remaining calories
    var remainingCaloriesElement = document.getElementById('remaining-calories');
    var remainingCalories = parseInt(remainingCaloriesElement.textContent);
    remainingCalories -= foodCalories;
    remainingCaloriesElement.textContent = remainingCalories;

    // Add the food item to the list
    var listItem = document.createElement('li');
    listItem.textContent = food + ' (' + foodCalories + ' calories)';
    document.getElementById(listId).appendChild(listItem);
    foodInput.value = '';
}

// Current Date Functions
var currentDate = new Date();

function formatDate(date) {
    var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    return date.toLocaleDateString('en-US', options);
}

function updateDateDisplay() {
    document.getElementById('current-date').textContent = formatDate(currentDate);
}

function changeDate(days) {
    currentDate.setDate(currentDate.getDate() + days);
    updateDateDisplay();
}

//Fitness screen Functions
function addExercise(type) {
    var nameInputId, timeInputId, setsInputId, repsInputId, weightInputId, listId;

    if (type === 'cardio') {
        nameInputId = 'cardio-input';
        timeInputId = 'time-input';
        listId = 'cardio-list';
    } else if (type === 'strength') {
        nameInputId = 'strength-input';
        setsInputId = 'sets-input';
        repsInputId = 'reps-input';
        weightInputId = 'weight-input';
        listId = 'strength-list';
    }

    var name = document.getElementById(nameInputId).value.trim();
    if (!name) {
        alert("Please enter exercise name.");
        return;
    }

    var listItem = document.createElement('li');

    if (type === 'cardio') {
        var time = document.getElementById(timeInputId).value.trim();
        listItem.textContent = name + ' (' + time + ' minutes)';
    } else if (type === 'strength') {
        var sets = document.getElementById(setsInputId).value.trim();
        var reps = document.getElementById(repsInputId).value.trim();
        var weight = document.getElementById(weightInputId).value.trim();
        listItem.textContent = name + ' (Sets: ' + sets + ', Reps: ' + reps + ', Weight: ' + weight + ')';
    }

    document.getElementById(listId).appendChild(listItem);

    // Clear input fields after adding exercise
    document.getElementById(nameInputId).value = '';
    if (timeInputId) document.getElementById(timeInputId).value = '';
    if (setsInputId) document.getElementById(setsInputId).value = '';
    if (repsInputId) document.getElementById(repsInputId).value = '';
    if (weightInputId) document.getElementById(weightInputId).value = '';
}

// Mental Health Page Functions
// Function to fetch a random quote from an API
function fetchRandomQuote() {
    fetch('https://api.quotable.io/random')
        .then(response => response.json())
        .then(data => {
            const quoteContainer = document.getElementById('quote-container');
            quoteContainer.innerHTML = `<blockquote>"${data.content}"<br>- ${data.author}</blockquote>`;
        })
        .catch(error => {
            console.error('Error fetching quote:', error);
        });
}

// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var images = document.querySelectorAll(".tabcontent img");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");

images.forEach(img => {
    img.onclick = function(){
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    }
});

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

function postComment() {
    var commentInput = document.getElementById("comment-input");
    var commentSection = document.getElementById("comment-section");
    if (commentInput.value.trim() !== "") {
        var newComment = document.createElement("p");
        newComment.textContent = commentInput.value;
        commentSection.appendChild(newComment);
        commentInput.value = "";  // Clear input after posting
    } else {
        alert("Please enter a comment before posting.");
    }
}

// Simulate adding a like
document.getElementById('likes').addEventListener('click', function() {
    var likesCount = document.getElementById('likes-count');
    var newCount = parseInt(likesCount.textContent) + 1;
    likesCount.textContent = newCount;
});

// Call the function to fetch and display a random quote when the page loads
fetchRandomQuote();

// Call updateDateDisplay initially to display the current date
updateDateDisplay();
