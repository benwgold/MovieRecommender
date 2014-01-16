var express = require('express');
var app = express();

app.get('hello.txt', function(req, res){
	var body = "Hello World";
	res.setHeader('Content-Type', 'text/plain');
	res.setHeader('Content-Lenght', body.length);
	res.end(body);
});

app.listen(8080);
conole.log('Listening on port 8080')

// var http = require("http");
// var url = require("url");

// function start(route, handle) {
//   function onRequest(request, response) {
//     var pathname = url.parse(request.url).pathname;
//     console.log("Request for " + pathname + " received.");
//     route(handle, pathname, response, request);
//   }

//   http.createServer(onRequest).listen(8080);
//   console.log("Server has started.");
// }

// exports.start = start;