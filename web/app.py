#implementation
import subprocess
from flask import Flask, render_template, request
import cv2
import os
import mysql.connector
mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="attendance"
)
mycursor = mydb.cursor()

def capture(name):
    folder_name = 'C:/Users/DELL/PycharmProjects/pythonProject/AttendanceProjectBasicCode/AttendanceProjectBasicCode/ImageAttendance'
    cap = cv2.VideoCapture(0, cv2.CAP_DSHOW)

    # keep taking pictures until 'q' is pressed
    count = 0
    while True:
        # read a frame from the video capture
        ret, frame = cap.read()

        # show the frame on screen
        cv2.imshow('frame', frame)

        # check for key press
        key = cv2.waitKey(1)
        if key == ord('q'):
            filename = f"{folder_name}/{name}.jpg"
            cv2.imwrite(filename, frame)
            count += 1
            break
        
    # release video capture and close all windows
    cap.release()
    cv2.destroyAllWindows()

app = Flask(__name__)

@app.route('/')
def home():
    return render_template('ui1.html')

@app.route("/run", methods=["GET", "POST"])
def run_code():
    if request.method == "POST" and "run_code" in request.form:
        # Replace "script.py" with the path to your specific Python script
        script_path = "C:/Users/DELL/PycharmProjects/pythonProject/AttendanceProjectBasicCode/AttendanceProjectBasicCode/web/modified11.py"
        
        try:
            result = subprocess.run(["python", script_path], capture_output=True, shell=True, text=True)
            if result.returncode == 0:
                # Script executed successfully
                return "<h1 align=\"center\">You have marked your attendance successfully.</h1>"
            else:
                # Script execution failed
                return "Script execution failed. Error: " + result.stderr
        except Exception as e:
            # Exception occurred during script execution
            return "An error occurred: " + str(e)
    else:
        return """
        <form action="/run" method="POST">
          <button type="submit" name="run_code">Run Code</button>
        </form>
    """

@app.route('/form', methods=['GET', 'POST'])
def form():
    if request.method == 'POST':
        name = request.form['name']
        capture(name)
        sql = "INSERT INTO student_info (name) VALUES (%s)"
        mycursor.execute(sql, [name, ])
        # Commit changes to the database
        mydb.commit()

# Print the number of rows affected
        print(mycursor.rowcount, "record inserted.")
        return "<h1 align=\"center\">Thanks for submitting form.</h1>"
        
    return render_template('form.html')
if __name__ == '__main__':
    app.run(debug=True)
