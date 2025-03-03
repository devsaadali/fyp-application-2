const express = require('express');
const mongoose = require('mongoose');
const cors = require('cors');

const app = express();
app.use(cors());
app.use(express.json());

// Connect to MongoDB
mongoose
  .connect('mongodb://mongo:27017/moviesdata', { useNewUrlParser: true, useUnifiedTopology: true })
  .then(() => console.log('Connected to MongoDB'))
  .catch((err) => console.error('MongoDB connection error:', err));

// Define Movie schema and model
const movieSchema = new mongoose.Schema({
  title: String,
  genre: String,
  year: Number,
});

const Movie = mongoose.model('Movie', movieSchema);

// Seed data
app.get('/seeddata', async (req, res) => {
  try {
    await Movie.create([
      { title: 'Inception', genre: 'Sci-Fi', year: 2010 },
      { title: 'The Dark Knight', genre: 'Action', year: 2008 },
      { title: 'Interstellar', genre: 'Sci-Fi', year: 2014 },
    ]);
    res.send('Movie data seeded!');
  } catch (error) {
    console.error('Error seeding data:', error);
    res.status(500).send('Failed to seed data');
  }
});

// API endpoint to retrieve movies
// localhost:3000/moviesdetail
app.get('/moviesdetail', async (req, res) => {
  try {
    const movies = await Movie.find();
    res.json(movies);
  } catch (error) {
    console.error('Error retrieving movies:', error);
    res.status(500).send('Failed to fetch movies');
  }
});

// Start the server
const PORT = 3000;
app.listen(PORT, () => console.log(`Backend running on port ${PORT}`));
