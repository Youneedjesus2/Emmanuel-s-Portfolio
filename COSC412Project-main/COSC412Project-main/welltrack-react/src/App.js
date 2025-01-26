import React, {useState} from 'react';
import { BrowserRouter as Router, Route, Link, Routes } from 'react-router-dom';
import LoginPage from './loginPage';
import NutritionPage from './nutritionPage';
import FitnessPage from './fitnessPage';
import MentalHealthPage from './mentalhealthPage';
import ProfilePage from './userProfile';
import './trackingStyles.css'; // Import your CSS file
import Settings from './settings';
import CreateAccount from './createAccount'
import TwoStepAuth from './twoStepAuth';
const App = () => {

return (
  <Router>
      <switch>
      <div>
            <header>
                        <Link to="/nutrition" className="post-button">
                            Nutrition
                        </Link>
                        <br></br>
                        <Link to="/fitness" className="profile-button">
                            Fitness
                        </Link>
                        <br></br>
                        <Link to="/mental" className="settings-button">
                            Mental
                        </Link>
                        <br></br>
                        <Link to="/profile" className="messages-button">
                            Profile
                        </Link>
                        <Link to="/login" className="messages-button">
                            Login
                        </Link>
                        <Link to="/settings" className="messages-button">
                            Settings
                        </Link>
                        <Link to="/createAccount" className="messages-button">
                            createAccount
                        </Link>
                        <Link to="/twoStepAuth" className="messages-button">
                            twoStepAuth
                        </Link>
            </header>

            <Routes>
                    <Route path="/nutrition" element={<NutritionPage />} />
                    <Route path="/fitness" element={<FitnessPage />} />
                    <Route path="/mental" element={<MentalHealthPage />} />
                    <Route path="/profile" element={<ProfilePage />} />
                    <Route path="/login" element={<LoginPage />} />
                    <Route path="/settings" element={<Settings/>} />
                    <Route path="/createAccount" element={<CreateAccount />} />
                    <Route path="/twoStepAuth" element={<TwoStepAuth/>} />

            </Routes>

        </div>
      </switch>
  </Router>
);
};

export default App;

