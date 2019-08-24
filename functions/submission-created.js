import querystring from "querystring";

exports.handler = function(event, context, callback) {
    const params = querystring.parse(event.body);
    console.log(params, '~~~~~~~~~~')
    console.log(context, '>>>>>>>>')
    callback(null, {
        statusCode: 200,
        body: 'No worries, all is working fine!'
    })
}