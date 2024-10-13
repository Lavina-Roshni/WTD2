// netlify/functions/apiHandler.js
exports.handler = async (event) => {
    if (event.httpMethod === 'POST') {
        const body = JSON.parse(event.body);
        // Perform actions similar to your PHP logic here
        // For example, save to a database or return a response
        return {
            statusCode: 200,
            body: JSON.stringify({ message: 'Data processed successfully', data: body }),
        };
    }
    return {
        statusCode: 405,
        body: JSON.stringify({ error: 'Method not allowed' }),
    };
};
