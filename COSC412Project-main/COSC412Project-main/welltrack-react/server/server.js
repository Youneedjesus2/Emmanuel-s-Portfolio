// server.js
const express = require('express');
const { MongoClient } = require('mongodb');
require('dotenv').config({ path: './config.env' });

const app = express();
const PORT = process.env.PORT || 5000;
const URI = process.env.ATLAS_URI;

const client = new MongoClient(URI, { useNewUrlParser: true, useUnifiedTopology: true });

// Connect to MongoDB
client.connect()
  .then(() => console.log('Connected to MongoDB'))
  .catch(err => console.error('Error connecting to MongoDB:', err));

// Middleware to parse JSON bodies
app.use(express.json());

// Route to store food data
app.post('/api/food', async (req, res) => {
  try {
    const db = client.db('nutritionDB');
    const collection = db.collection('foods');
    const result = await collection.insertOne(req.body);
    res.status(201).json({ message: 'Food stored successfully', insertedId: result.insertedId });
  } catch (err) {
    console.error('Error storing food:', err);
    res.status(500).json({ message: 'Internal server error' });
  }
});

// Start server
app.listen(PORT, () => console.log(`Server is running on port ${PORT}`));
