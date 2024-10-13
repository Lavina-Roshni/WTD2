// netlify/functions/fetchData.js
const axios = require('axios');

exports.handler = async (event, context) => {
  try {
    const response = await axios.get('https://api.example.com/data'); // Replace with your API URL
    const data = response.data;

    return {
      statusCode: 200,
      body: JSON.stringify(data),
    };
  } catch (error) {
    return {
      statusCode: 500,
      body: JSON.stringify({ error: 'Error fetching data' }),
    };
  }
};
