// Function to handle create account button click
function handleCreateAccountClick() {
    
    window.location.href = 'createAccount.html';
}



function handleClick() {
    try {
        // Get user input
        const userInput = document.getElementById('userInput').value;
        const passwordInput = document.getElementById('passwordInput').value;

        // Check if user and password are empty
        if (userInput === '' || passwordInput === '') {
            throw new Error('Incorrect user/email or password');
        }

        // Check if user and password are correct
        if (userInput === 'correctUser' && passwordInput === 'correctPassword') {
            // Access MongoDB database (placeholder)
            const databaseResult = accessMongoDB(); /// yeaaaaaah i dont know how to use mongodb so i just made a placeholder function

            // Navigates to 2-step authentication page
            window.location.href = 'twoStepAuth.html';
        } else {
            throw new Error('Incorrect user/email or password');
        }
    } catch (error) {
        // Handle incorrect user/email or password
        if (error.message === 'Incorrect user/email or password') {
            console.error('Incorrect user/email or password');
            // Display error message to the user
            document.getElementById('errorMessage').textContent = 'Incorrect user/email or password';
        } else {
            console.error('An error occurred:', error);
            // Display generic error message to the user
            document.getElementById('errorMessage').textContent = 'An error occurred';
        }
    }
}

//idk how to use mongodb so i just made a placeholder function
function accessMongoDB() {
    
    console.log('Accessing MongoDB database...');
    
    return 'Database result';
}