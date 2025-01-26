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
    padding: 20,
    display: 'flex',
    alignItems: 'center',
    justifyContent: 'center',
    height: '100vh',
  },
  container: {
    backgroundColor: '#333',
    padding: 20,
    borderRadius: 8,
    boxShadow: '0 4px 8px rgba(0, 0, 0, 0.1)',
  },
  input: {
    width: 'calc(100% - 22px)',
    padding: 10,
    marginTop: 5,
    border: 'none',
    borderRadius: 4,
    backgroundColor: '#222',
    color: 'white',
  },
  button: {
    backgroundColor: '#e91e63',
    color: 'white',
    border: 'none',
    padding: '8px 16px',
    cursor: 'pointer',
    width: '100%',
    borderRadius: 4,
    marginTop: 10,
  },
  buttonHover: {
    backgroundColor: '#c2185b',
  },
  link: {
    color: '#e91e63',
    textDecoration: 'none',
  },
  linkHover: {
    textDecoration: 'underline',
  },
};

function TwoStepAuthentication() {
  const [pinCode, setPinCode] = useState('');
  const [userEmail] = useState('user@example.com'); // Preset for demonstration

  const verifyPin = () => {
    if (pinCode === "1234") {
      alert("PIN code is correct");
    } else {
      alert("PIN code is incorrect");
    }
  };

  const resendEmail = () => {
    const newPinCode = generatePinCode();
    sendEmail(newPinCode);
    alert(`We sent a new verification link to ${userEmail}.`);
  };

  const generatePinCode = () => {
    const newPin = Math.floor(1000 + Math.random() * 9000);
    return newPin.toString();
  };

  const sendEmail = (pin) => {
    alert(`Your verification code is: ${pin}`);
  };

  return (
    <div style={styles.body}>
      <div style={styles.container}>
        <h1>Two-Step Authentication</h1>
        <p>We sent a verification link to <span>{userEmail}</span>.</p>
        <form>
          <input
            type="text"
            id="pinCode"
            placeholder="Enter 4-digit PIN code"
            style={styles.input}
            value={pinCode}
            onChange={(e) => setPinCode(e.target.value)}
          />
          <button type="button" style={styles.button} onClick={verifyPin}>Verify Email</button>
        </form>
        <p>Didn't receive the email? <button style={styles.link} onClick={resendEmail}>Click to resend</button></p>
        <a href="loginPage.html" style={styles.link}>Back to login</a>
      </div>
    </div>
  );
}

export default TwoStepAuthentication;
