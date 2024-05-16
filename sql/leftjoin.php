SELECT Name 
FROM student 
LEFT JOIN student_guardian ON student.Name = student_guardian.student_id;