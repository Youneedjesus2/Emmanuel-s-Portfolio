import React, { useState } from 'react';

function LoginPage() {
    const [userInput, setUserInput] = useState('');
    const [passwordInput, setPasswordInput] = useState('');
    const [errorMessage, setErrorMessage] = useState('');

    const handleCreateAccountClick = () => {
        window.location.href = 'createAccount.html';
    };

    const accessMongoDB = () => {
        console.log('Accessing MongoDB database...');
        return 'Database result'; // Placeholder function
    };

    const handleClick = () => {
        try {
            // Check if user and password are empty
            if (userInput === '' || passwordInput === '') {
                throw new Error('Incorrect user/email or password');
            }

            // Check if user and password are correct
            if (userInput === 'correctUser' && passwordInput === 'correctPassword') {
                const databaseResult = accessMongoDB(); // Access the database
                console.log(databaseResult); // Log the database result
                window.location.href = 'twoStepAuth.html'; // Navigate to 2-step authentication page
            } else {
                throw new Error('Incorrect user/email or password');
            }
        } catch (error) {
            // Log and display errors
            console.error('An error occurred:', error);
            setErrorMessage(error.message);
        }
    };

    return (
        <div>
            <input
                type="text"
                id="userInput"
                value={userInput}
                onChange={(e) => setUserInput(e.target.value)}
                placeholder="Enter username/email"
            />
            <input
                type="password"
                id="passwordInput"
                value={passwordInput}
                onChange={(e) => setPasswordInput(e.target.value)}
                placeholder="Enter password"
            />
            <button onClick={handleClick}>Login</button>
            <button onClick={handleCreateAccountClick}>Create Account</button>
            <div id="errorMessage">{errorMessage}</div>
        </div>
    );
}




const styles = {
  body: {
    fontFamily: 'Arial, sans-serif',
    backgroundColor: '#121212',
    color: 'white',
    margin: 0,
    padding: 0,
    display: 'flex',
    flexDirection: 'column',
    alignItems: 'center',
    justifyContent: 'center',
    height: '100vh',
  },
  main: {
    backgroundColor: '#333',
    padding: 20,
    borderRadius: 8,
    boxShadow: '0 4px 8px rgba(0, 0, 0, 0.1)',
    width: 300,
    textAlign: 'center',
  },
  input: {
    width: '90%',
    padding: 10,
    marginTop: 10,
    border: 'none',
    borderRadius: 4,
    backgroundColor: '#222',
    color: 'white',
  },
  button: {
    backgroundColor: '#e91e63',
    color: 'white',
    border: 'none',
    padding: '10px 20px',
    cursor: 'pointer',
    borderRadius: 4,
    marginTop: 15,
    width: '100%',
    display: 'block',
  },
  buttonHover: {
    backgroundColor: '#c2185b',
  },
  title: {
    marginBottom: 20,
  },
  welcomeText: {
    fontSize: 16,
    marginBottom: 10,
  },
  footer: {
    marginTop: 20,
    fontSize: '0.8rem',
    textAlign: 'center',
    width: '100%',
  },
  link: {
    color: '#e91e63',
    textDecoration: 'none',
  },
  linkHover: {
    textDecoration: 'underline',
  }
};

function WellnessTrackApp() {
  return (
    <div style={styles.body}>
      <main style={styles.main}>
        <div style={styles.title}>
          <h1>Wellness Track App</h1>
        </div>
        
        <div style={styles.welcomeText}>Welcome back</div>
        
        <form>
          <label htmlFor="email">Email/User:</label>
          <input type="text" id="email" name="email" placeholder="Enter your email/user" style={styles.input} />
          
          <label htmlFor="password">Password:</label>
          <input type="password" id="password" name="password" placeholder="Enter your password" style={styles.input} />
          
          <button type="submit" style={styles.button}>Login</button>
        
          <button type="button" style={styles.button} onClick={() => window.location.href='createAccount.html'}>Create New Account</button>
        </form>
      </main>
      
      <footer style={styles.footer}>
        &copy; 2024 by <a href="https://www.thesoftwareguild.com/" style={styles.link}>The Software Guild</a>. All Rights Reserved. Wellness Track App
      </footer>
    </div>
  );
}

export default WellnessTrackApp;
