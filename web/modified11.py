import cv2
import numpy as np
import face_recognition
import os
import mysql.connector
from datetime import datetime

# Set up MySQL connection
mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="attendance"
)

mycursor = mydb.cursor()

# Load images and class names
path = 'C:/Users/DELL/PycharmProjects/pythonProject/AttendanceProjectBasicCode/AttendanceProjectBasicCode/ImageAttendance'
images = []
classNames = []
myList = os.listdir(path)
mycursor.execute('Select name from student_info')
for row in mycursor:
    data = row[0]
    print(data)
    classNames.append(data)
    curImg = cv2.imread(f'{path}/{data}.jpg')
    images.append(curImg)

# Find face encodings for known images
def findEncodings(images):
    encodeList = []
    for img in images:
        img = cv2.cvtColor(img, cv2.COLOR_BGR2RGB)
        encode = face_recognition.face_encodings(img)[0]
        encodeList.append(encode)
    return encodeList

encodeListKnown = findEncodings(images)

# Set up webcam
cap = cv2.VideoCapture(0, cv2.CAP_DSHOW)

# Set tolerance parameter for face match
tolerance = 0.5

while True:
    success, img = cap.read()
    imgS = cv2.resize(img, (0,0), None, 0.25, 0.25)
    imgS = cv2.cvtColor(imgS, cv2.COLOR_BGR2RGB)

    # Find faces in current frame
    facesCurFrame = face_recognition.face_locations(imgS)
    encodesCurFrame = face_recognition.face_encodings(imgS, facesCurFrame)

    for encodeFace, faceLoc in zip(encodesCurFrame, facesCurFrame):
        # Compare face encodings with known images
        matches = face_recognition.compare_faces(encodeListKnown, encodeFace,tolerance=tolerance)
        faceDis = face_recognition.face_distance(encodeListKnown, encodeFace)
        matchIndex = np.argmin(faceDis)

        if matches[matchIndex]:
            name = classNames[matchIndex].upper()
            print(name)
            y1, x2, y2, x1 = faceLoc
            y1, x2, y2, x1 = y1*4, x2*4, y2*4, x1*4
            cv2.rectangle(img, (x1, y1), (x2, y2), (0,255,0), 2)
            cv2.putText(img, name, (x1+6, y1-6), cv2.FONT_HERSHEY_COMPLEX, 1, (255,255,255), 2)

            # Insert attendance record into database
            mycursor.execute("SELECT name FROM student_att WHERE name = %s", (name,))
            result = mycursor.fetchone()

            if result is None:
                now = datetime.now()
                dtString = now.strftime('%Y-%m-%d %H:%M:%S')
                sql = "INSERT INTO student_att (name, time1) VALUES (%s, %s)"
                val = (name, dtString)
                mycursor.execute(sql, val)
                mydb.commit()
        else:
            name = "Unknown"
            print(name)
            y1, x2, y2, x1 = faceLoc
            y1, x2, y2, x1 = y1*4, x2*4, y2*4, x1*4
            cv2.rectangle(img, (x1, y1), (x2, y2), (0,0,255), 2)
            cv2.putText(img, name, (x1+6, y1-6), cv2.FONT_HERSHEY_COMPLEX, 1, (255,255,255), 2)

    cv2.imshow('Webcam', img)
    if cv2.waitKey(1) == ord('q'):
        break

cap.release()
cv2.destroyAllWindows()