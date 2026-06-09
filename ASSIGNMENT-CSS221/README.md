# MY NAME IS MWAJABU OMARI
# REG NUMBER 14325043/T.24 MICT-EDU 2A
STUDENT ATTENDANCE MANAGEMENT SYSTEM
1. System Overview
This is a web-based Student Attendance Management System developed using PHP (procedural style), MySQL, HTML, CSS, and JavaScript. It allows teachers to mark student attendance efficiently while ensuring data validation and preventing duplicate entries per student per day.
2. Technologies Used
i) PHP (Procedural)
ii) MySQL Database
iii) HTML
iv) CSS
v) JavaScript (Vanilla)
vi) AJAX (Fetch API)
3. User Roles
i) Admin: Creates teacher accounts and manages system access
ii) Teacher: Logs into system, Manages students (add, edit, delete), Marks attendance and Views reports
4. System Modules
i) Authentication Module - Login system for admin and teachers
ii) Student Management Module - Add, edit, delete students
iii) Attendance Module - Mark daily attendance (Present/Absent)
iii) Report Module - Filter attendance by class and date
5. Database Structure with ER Diagram
Tables used: users (id, full_name, username, password, role), students (student_id, full_name, class) and attendance (attendance_id, student_id, attendance_date, status, marked_by). Chech the table structure below. 
 
6. Key Features
i) Prevent duplicate attendance per student per day
ii) Bulk mark (All Present / All Absent)
iii) Reset attendance selection
iv) Validation: all students must be marked before submission
v) Smooth UI with responsive design
vi) Scroll-based feedback messages

7. Pages Structure
i) index.php: User authentication
ii) dashboard.php: Role-based dashboard
iii) students.php: Manage students
iv) add_student.php: Add new student
v) mark_attendance.php: Attendance marking system
vi) report.php: Attendance reports
vii) logout.php: End session
viii) save_attendance.php: save the attendance on the given day via AJAX API
8. Attendance Workflow
Teachers select Present or Absent for each student. The system validates that all students are marked before submission. Data is sent using Fetch API to PHP backend which stores or updates records in MySQL.
9. System Validation Rules
i) No student can be left unmarked
ii) Duplicate attendance for same student and date is prevented
iii) Invalid submissions are highlighted and blocked
10. Conclusion
This system provides a simple, efficient, and beginner-friendly solution for managing student attendance. It demonstrates CRUD operations, form validation, role-based access, and AJAX-based data handling.
