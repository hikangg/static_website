import querystring from "querystring";

exports.handler = function(event, context, callback) {
    const params = querystring.parse(event.body);
    const queries = querystring.parse(event.queryStringParameters);
    callback(null, {
        statusCode: 200,
        body: 'No worries, all is working fine!'
    })
}