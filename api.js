const axios = require('axios'); // Example of using axios for API calls

exports.handler = async (event, context) => {
  try {
    // Example: Fetch data from an external API
    const response = await axios.get('https://api.example.com/data');
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
