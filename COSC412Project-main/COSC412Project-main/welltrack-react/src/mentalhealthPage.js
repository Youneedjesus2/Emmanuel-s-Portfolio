import React, { useState, useEffect } from 'react';
import './trackingStyles.css'; // Import CSS file

const MentalHealthPage = () => {
    // State for current date
    const [currentDate, setCurrentDate] = useState(new Date());

    // Function to format date
    const formatDate = (date) => {
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        return date.toLocaleDateString('en-US', options);
    };

    // Function to change date
    const changeDate = (days) => {
        const newDate = new Date(currentDate);
        newDate.setDate(newDate.getDate() + days);
        setCurrentDate(newDate);
    };

    // Function to fetch a random quote from an API
    const fetchRandomQuote = async () => {
        try {
            const response = await fetch('https://api.quotable.io/random');
            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Error fetching quote:', error);
            return null;
        }
    };

    useEffect(() => {
        // Call updateDateDisplay initially to display the current date
        // You can call it here because React has rendered the component and the DOM is available
        updateDateDisplay();

        // Call the function to fetch and display a random quote when the page loads
        fetchRandomQuote().then(data => {
            const quoteContainer = document.getElementById('quote-container');
            if (quoteContainer && data) {
                quoteContainer.innerHTML = (
                    <blockquote>
                        "{data.content}"
                        <br />
                        - {data.author}
                    </blockquote>
                );
            }
        });
    }, []); // Empty dependency array means this effect runs only once after the component mounts

    // Function to update date display
    const updateDateDisplay = () => {
        setCurrentDate(new Date()); // Update currentDate state
    };

    return (
        <div className="calorie-tracker">
            <div className="mental-health-tracker">
                <div className="date-selector">
                    <button onClick={() => changeDate(-1)}>&#10094;</button>
                    <span>{formatDate(currentDate)}</span>
                    <button onClick={() => changeDate(1)}>&#10095;</button>
                </div>
                <div className="mood-input">
                    <label htmlFor="mood"><h2>How are you feeling today?</h2></label>
                    <select id="mood" name="mood">
                        <option value="happy">Happy</option>
                        <option value="sad">Sad</option>
                        <option value="stressed">Stressed</option>
                        <option value="anxious">Anxious</option>
                        <option value="content">Content</option>
                        <option value="angry">Angry</option>
                        <option value="calm">Calm</option>
                        <option value="empty">Empty</option>
                        {/* Add more mood options as needed */}
                    </select>
                </div>
                <div className="mental-health-notes">
                    <label htmlFor="mental-health-notes"><h2>Additional Notes</h2></label>
                    <textarea id="mental-health-notes" placeholder="Enter any additional notes about your mental health"></textarea>
                </div>
                <button>Save</button>
            </div>
            <br />
            <div id="quote-container">
                {/* Quote will be displayed here */}
            </div>
        </div>
    );
};

export default MentalHealthPage;
