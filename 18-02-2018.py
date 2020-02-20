import json

{
  "name": "nodeMongo",
  "version": "1.0.0",
  "description": "Node.js and MongoDb tutorial.",
  "main": "Server.js",
  "scripts": {
    "test": "mocha"
  },
  "repository": {
    "type": "git",
    "url": "https://github.com/codeforgeek/Node-and-mongo-tutorial"
  },
  "keywords": [
    "Node.js",
    "mongoDb"
  ],
  "author": "Shahid Shaikh",
  "license": "ISC",
  "bugs": {
    "url": "https://github.com/codeforgeek/Node-and-mongo-tutorial/issues"
  },
  "homepage": "https://github.com/codeforgeek/Node-and-mongo-tutorial",
  "dependencies": {
    "body-parser": "^1.13.3",
    "express": "^4.13.3",
    "mongoose": "^4.1.2"
  }
}




var express     =   require("express");
var app         =   express();
var bodyParser  =   require("body-parser");
var router      =   express.Router();

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({"extended" : false}));

router.get("/",function(req,res){
    res.json({"error" : false,"message" : "Hello World"});
});

app.use('/',router);

app.listen(3000);
console.log("Listening to PORT 3000");
