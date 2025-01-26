import React, { useState, useEffect } from 'react';
import './trackingStyles.css'; // Import CSS file
import axios from 'axios';

const predeterminedFoods = {
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

function NutritionTracking() {
    // State for current date
    const [currentDate, setCurrentDate] = useState(new Date());
    const [remainingCalories, setRemainingCalories] = useState(2500);
    const [meals, setMeals] = useState({
        breakfast: [],
        lunch: [],
        dinner: []
    });

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

    // Function to add food
    const addFood = async (meal) => {
        const inputId = meal + '-input';
        const foodInput = document.getElementById(inputId);
        const food = foodInput.value.trim().toLowerCase();
        const foodCalories = predeterminedFoods[food];

        if (!food || !foodCalories) {
            alert("Please enter a valid food item.");
            return;
        }

        try {
            // Send food data to server
            await axios.post('/api/food', { food, calories: foodCalories });
            // Update remaining calories locally
            setRemainingCalories(prevCalories => prevCalories - foodCalories);
            // Clear input field
            foodInput.value = '';
        } catch (error) {
            console.error('Error adding food:', error);
            // Handle error
        }
    };

    useEffect(() => {
        // Update remaining calories when the component mounts
        setRemainingCalories(2500);
    }, []);

    return (
        <div>
            <main>
                <div className="calorie-tracker">
                    <div className="date-selector">
                        <button onClick={() => changeDate(-1)}>&#10094;</button>
                        <span id="current-date">{formatDate(currentDate)}</span>
                        <button onClick={() => changeDate(1)}>&#10095;</button>
                    </div>
                    <div className="calorie-goal">
                        <p>Calorie Goal: <span id="calorie-goal">2500</span></p>
                        <p>Remaining Calories: <span id="remaining-calories">{remainingCalories}</span></p>
                    </div>
                    <div className="meal-inputs">
                        <div className="meal">
                            <h2>Breakfast</h2>
                            <input type="text" id="breakfast-input" placeholder="Enter food" />
                            <button onClick={() => addFood('breakfast')}>Add Food</button>
                            <ul id="breakfast-list">
                                {meals.breakfast.map((item, index) => (
                                    <li key={index}>{item}</li>
                                ))}
                            </ul>
                        </div>
                        <div className="meal">
                            <h2>Lunch</h2>
                            <input type="text" id="lunch-input" placeholder="Enter food" />
                            <button onClick={() => addFood('lunch')}>Add Food</button>
                            <ul id="lunch-list">
                                {meals.lunch.map((item, index) => (
                                    <li key={index}>{item}</li>
                                ))}
                            </ul>
                        </div>
                        <div className="meal">
                            <h2>Dinner</h2>
                            <input type="text" id="dinner-input" placeholder="Enter food" />
                            <button onClick={() => addFood('dinner')}>Add Food</button>
                            <ul id="dinner-list">
                                {meals.dinner.map((item, index) => (
                                    <li key={index}>{item}</li>
                                ))}
                            </ul>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    );
}

export default NutritionTracking;
