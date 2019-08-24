import querystring from "querystring";

exports.handler = function(event, context, callback) {
    const params = querystring.parse(event.body);
    const queries = querystring.parse(event.queryStringParameters);
    console.log(params, '~~~~~~~~~~')
    console.log(queries, '<<<<<<<<<<')
    console.log(context, '>>>>>>>>')
    callback(null, {
        statusCode: 200,
        body: 'No worries, all is working fine!'
    })
}