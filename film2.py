##const mongoose=require('mongoose');
##mongoose.connect('mongodb://localhost:27017/film');

##   * MongoDB port is 27017 by default.
##   * Assuming you have created mongoDB database named "film".

from pymongo import MongoClient
client = MongoClient('localhost:27017')

def my_function(mydb):
    db = client.get_database(mydb)
    return db.collection.find().count()

print(my_function('my_database'))
