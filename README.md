# Facial Recognition Attendance System

This project is a facial recognition-based attendance system with admin access to view attendance logs. Students can enroll in the system and mark their attendance using facial recognition.

## Features

- **Student Enrollment**: Students can register using their name and facial image.
- **Automated Attendance**: Students can mark their attendance by showing their face to the camera.
- **Admin Access**: Administrators can view and manage attendance logs.
- **Unique Student IDs**: The system automatically generates a unique ID for each enrolled student.

## Technology Stack

- **Backend**: Python with Flask
- **Frontend**: HTML, CSS, PHP
- **Database**: MySQL
- **Facial Recognition**: OpenCV, face_recognition and numpy library


## Setup and Installation

1. Clone the repository
2. Install the required Python packages
3. Set up the MySQL database:
- Create a database named `attendance`
- Update the database connection details in `app.py`, `modified11.py` and `conn.php`

4. Run the Flask application

## Usage

### Student Enrollment
1. Navigate to the enrollment page.
2. Enter your name and capture your facial image using the webcam.

### Marking Attendance
1. Go to the attendance section.
2. Click on "Run Code" to start the facial recognition process.
3. Show your face to the camera.
4. The system will automatically mark your attendance if recognized.

### Admin Access
1. Log in to the admin panel (sign up if not already registered as an admin - maximum admin limit is 2).
2. View and manage attendance logs.

## File Structure

- `app.py`: Main Flask application
- `modified11.py`: Facial recognition algorithm
- `templates/`: HTML templates
- `ImageAttendance/`: Directory for storing student facial images
- `htdocs/`: PHP and HTML files for web interface
  - `adduser.html`: Confirmation page for adding a new student
  - `adduser.php`: Form for adding a new student to the system
  - `conn.php`: Database connection configuration
  - `login.php`: Admin login page
  - `q1.php`: Page to display student attendance records
  - `run_python.php`: Script to execute the Python facial recognition code
  - `signup.php`: New admin registration page


These files create a comprehensive web-based interface for administrators to manage the system, view attendance logs, and trigger the facial recognition process. The PHP scripts interact with the MySQL database and the Python backend to provide a full-featured attendance management system.


