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
    position: 'relative',
  },
  container: {
    backgroundColor: '#333',
    padding: 20,
    borderRadius: 8,
    boxShadow: '0 4px 8px rgba(0, 0, 0, 0.1)',
  },
  inputGroup: {
    marginBottom: 10,
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
};

function AccountRegistry() {
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    password: '',
  });

  const validateForm = () => {
    if (formData.name && formData.email && formData.password.length >= 8) {
      // Implement successful form submission behavior
      alert('Form submitted successfully!');
    } else {
      alert('Please fill out the form correctly.');
    }
    return false;  // Prevent default form submission behavior
  };

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData(prev => ({ ...prev, [name]: value }));
  };

  return (
    <div style={styles.body}>
      <div style={styles.container}>
        <div id="signupForm">
          <h1>Create an Account</h1>
          <form onSubmit={validateForm}>
            <div style={styles.inputGroup}>
              <label htmlFor="name">Name:</label>
              <input type="text" id="name" name="name" required style={styles.input} onChange={handleChange} />
            </div>

            <div style={styles.inputGroup}>
              <label htmlFor="email">Email:</label>
              <input type="email" id="email" name="email" required style={styles.input} onChange={handleChange} />
            </div>

            <div style={styles.inputGroup}>
              <label htmlFor="password">Password:</label>
              <input type="password" id="password" name="password" minLength="8" required style={styles.input} onChange={handleChange} />
            </div>

            <button type="submit" style={styles.button}>Sign Up</button>
            <button type="button" style={styles.button} onClick={() => window.location.href='loginPage.html'}>Return to Login Page</button>
          </form>
        </div>
      </div>
    </div>
  );
}

export default AccountRegistry;
