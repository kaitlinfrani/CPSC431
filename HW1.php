<!--- 
Kaitlin Frani
CPSC431-02
HW #1
2/8/23
--->

<?php
// define variables and set to empty values
$name = $dept = $comment = $choice = $topic = "";
?>

<center>
<h1></h1>
<h2>Student Interests Survey Form</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Enter your name: <input type="text" name="name" value="">
  <br><br>
  Enter your department: <input type="text" name="dept" value="">
  <br><br>
  Tell us a little about yourself: <textarea name="comment" rows="5" cols="40"></textarea>
  <br><br>
  Do you exercise at home?:
  <input type="radio" name="choice" value="Yes">Yes
  <input type="radio" name="choice" value="No">No
  <br><br>
  How do you like to read about your favorite topics?
  <br><br>
  <input type="checkbox" name="topic" value="books">Books
  <input type="checkbox" name="topic" value="online">Online resources
  <input type="checkbox" name="topic" value="phone">Phone apps
  <input type="checkbox" name="topic" value="magazines">Magazines
  <br><br>
  What genre of movies do you like?
  <select>
    <option value="comedy">comedy</option>
    <option value="romance">romance</option>
    <option value="thriller">thriller</option>
    <option value="horror">horror</option>
    <option value="biopic">biopic</option>
  </select>
  <br><br>
  <input type="submit" name="submit" value="Submit form">
</form>
</center>


