import React, { useState, useEffect } from 'react';
import './trackingStyles.css'; // Import CSS file

const FitnessPage = () => {
    // State for current date
    const [currentDate, setCurrentDate] = useState(new Date());

    // State for exercise inputs
    const [cardioInput, setCardioInput] = useState('');
    const [timeInput, setTimeInput] = useState('');
    const [strengthInput, setStrengthInput] = useState('');
    const [setsInput, setSetsInput] = useState('');
    const [repsInput, setRepsInput] = useState('');
    const [weightInput, setWeightInput] = useState('');

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

    // Function to handle adding exercise
    const addExercise = (type) => {
        if (type === 'cardio') {
            // Handle cardio exercise
        } else if (type === 'strength') {
            // Handle strength exercise
        }
    };

    return (
        <div className="calorie-tracker">
            <div className="date-selector">
                <button onClick={() => changeDate(-1)}>&#10094;</button>
                <span>{formatDate(currentDate)}</span>
                <button onClick={() => changeDate(1)}>&#10095;</button>
            </div>
            <div className="calorie-goal">
                <p>Burned Calorie Goal: <span>200</span></p>
                <p>Remaining Calories: <span>200</span></p>
            </div>
            <div className="exercise-inputs">
                <div className="cardio">
                    <h2>Cardiovascular</h2>
                    <input type="text" value={cardioInput} onChange={(e) => setCardioInput(e.target.value)} placeholder="Enter Exercise Name" />
                    <br />
                    <input type="text" value={timeInput} onChange={(e) => setTimeInput(e.target.value)} placeholder="Enter Exercise time" />
                    <br />
                    <button onClick={() => addExercise('cardio')}>Add Exercise</button>
                    <ul></ul>
                </div>
                <div className="strength">
                    <h2>Strength Training</h2>
                    <input type="text" value={strengthInput} onChange={(e) => setStrengthInput(e.target.value)} placeholder="Enter Exercise Name" />
                    <br />
                    <input type="text" value={setsInput} onChange={(e) => setSetsInput(e.target.value)} placeholder="Enter Number of Sets" />
                    <br />
                    <input type="text" value={repsInput} onChange={(e) => setRepsInput(e.target.value)} placeholder="Enter Number of Reps" />
                    <br />
                    <input type="text" value={weightInput} onChange={(e) => setWeightInput(e.target.value)} placeholder="Enter Amount of Weight" />
                    <br />
                    <button onClick={() => addExercise('strength')}>Add Exercise</button>
                    <ul></ul>
                </div>
            </div>
            <div className="exercise-notes">
                <h2 className="notes-title">Todays Exercise Notes</h2>
                <textarea className="notes-form" id="noteContent" placeholder="notes" required></textarea>
            </div>
        </div>
    );
};

export default FitnessPage;
