import csv

#with open('The_Bad_Sleep_Well_1960.avi_P02.csv') as csvDataFile:
   # csvReader = csv.reader(csvDataFile)
    #for row in csvReader:
        #print(row)



import csv
 
dates = []
scores = []
 
with open('The_Bad_Sleep_Well_1960.avi_P02.csv') as csvDataFile:
    csvReader = csv.reader(csvDataFile)
    for row in csvReader:
        dates.append(row[0])
        scores.append(row[1])
 
print(dates)
print(scores)
