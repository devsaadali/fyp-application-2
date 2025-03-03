
const express = require('express');
const app = express();

app.use(express.json());

app.get('/log', (req, res) => {
    const logData = req.body;
    console.log('Received log:', logData);
    res.status(200).send('Log received');
});

app.listen(5002, () => {
    console.log('Logging service is running on port 5002');
});
