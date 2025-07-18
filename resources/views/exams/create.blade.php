<h1>Create New Exam</h1>
// creating a form to create a new exam
<form method="POST" action="/exams">
    @csrf
    <label>Title:</label>
    <input type="text" name="title" required><br>

    <label>Subject:</label>
    <input type="text" name="subject" required><br>

    <label>Date & Time:</label>
    <input type="datetime-local" name="exam_date" required><br>

    <label>Eligible Roles:</label>
    <select name="eligible_roles[]" multiple required>
        <option value="student">Student</option>
        <option value="lecturer">Lecturer</option>
    </select><br>

    <button type="submit">Create Exam</button>
</form>
