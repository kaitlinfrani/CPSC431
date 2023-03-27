<?php
# Kaitlin Frani
# CPSC431-02
# HW #3

# Create database
$host = 'localhost:3306';
$user = 'root';
$pass = '';
$db = 'hw3';
$conn = mysqli_connect($host, $user, $pass);
if(! $conn )
{ 
  die('Could not connect: ' . mysqli_connect_error());
} 
echo 'Connected successfully<br/>';

$sql = 'CREATE Database hw3';
if(mysqli_query( $conn,$sql)){
  echo "Database hw3 created successfully";
}else{
echo "Sorry, database creation failed ".mysqli_error($conn);
}
mysqli_close($conn);

$conn = mysqli_connect($host, $user, $pass, $db);
if(! $conn )
{ 
  die('Could not connect: ' . mysqli_connect_error());
} 
echo '<br/>Connected successfully<br/><br/>';


# Create Tables
$sql = "create table Sailors (
    sid INT,
    sname VARCHAR(100),
    rating INT,
    age decimal(3,1),
    PRIMARY KEY(sid)
)";
echo $sql ; 
echo "<br/>";
if(mysqli_query($conn, $sql)){  
 echo "Table Sailors created successfully";  
}else{  
echo "Could not create table: ". mysqli_error($conn);  
}  

echo "<br/>";
$sql = "create table Boats (
  bid INT,
  bname VARCHAR(100),
  color VARCHAR(100),
  PRIMARY KEY (bid)
)";
echo $sql ; 
echo "<br/>";
if(mysqli_query($conn, $sql)){  
 echo "Table Boats created successfully";  
}else{  
echo "Could not create table: ". mysqli_error($conn);  
}  

echo "<br/>";
$sql = "create table Reserves (
  sid INT,
  bid INT,
  day DATE,
  FOREIGN KEY (sid) REFERENCES Sailors(sid),
  FOREIGN KEY (bid) REFERENCES Boats(bid) 
)";
echo $sql ; 
echo "<br/>";
if(mysqli_query($conn, $sql)){  
 echo "Table Reserves created successfully<br/><br/>";  
}else{  
echo "Could not create table: ". mysqli_error($conn);  
}  


# Insert Records
$sql = "INSERT INTO Sailors (sid, sname, rating, age)
VALUES ('22', 'Dustin', '7', '45.0'),
('29', 'Brutus', '1', '33.0'),
('31', 'Lubber', '8', '55.5'),
('32', 'Andy', '8', '25.5'),
('58', 'Rusty', '10', '35.0'),
('64', 'Horatio', '7', '35.0'),
('71', 'Zorba', '10', '16.0'),
('74', 'Horatio', '9', '35.0'),
('85', 'Art', '3', '25.5'),
('95', 'Bob', '3', '63.5')";  
echo $sql ; 
if(mysqli_query($conn, $sql)){  
	echo "<br/>Record inserted successfully<br/>";  
}else{  
	echo "Could not insert record: ". mysqli_error($conn);  
} 

echo "<br/>";
$sql = "INSERT INTO Boats (bid, bname, color)
VALUES ('101', 'Interlake', 'blue'),
('102', 'Interlake', 'red'),
('103', 'Clipper', 'green'),
('104', 'Marine', 'red')
";  
echo $sql ; 
if(mysqli_query($conn, $sql)){  
	echo "<br/>Record inserted successfully<br/>";  
}else{  
	echo "Could not insert record: ". mysqli_error($conn);  
} 

echo "<br/>";
$sql = "INSERT INTO Reserves (sid, bid, day)
VALUES ('22', '101', '1998-10-10'),
('22', '102', '1998-10-10'),
('22', '103', '1998-10-08'),
('22', '104', '1998-10-07'),
('31', '102', '1998-11-10'),
('31', '103', '1998-11-06'),
('31', '104', '1998-11-12'),
('64', '101', '1998-09-05'),
('64', '102', '1998-09-08'),
('74', '103', '1998-09-08')
";  
echo $sql ; 
if(mysqli_query($conn, $sql)){  
	echo "<br/>Record inserted successfully<br/><br/>";  
}else{  
	echo "Could not insert record: ". mysqli_error($conn);  
} 

#Queries
$sql = 'SELECT S.sname
FROM Sailors S, Reserves R, Boats B 
WHERE S.sid = R.sid AND R.bid = B.bid
AND (B.color = "red" OR B.color = "green")';  
echo $sql;
$retval=mysqli_query($conn, $sql);  
  
if(mysqli_num_rows($retval) > 0){  
	echo "<br> Sailor Name: ";
 while($row = mysqli_fetch_assoc($retval)){  
    echo "<br> {$row['sname']}";  
 } //end of while  
}else{  
echo "0 results";  
}

echo "<br><br/>";
$sql = 'SELECT S.sname
FROM Sailors S, Reserves R1, Reserves R2, Boats B1, Boats B2 
WHERE S.sid = R1.sid AND R1.bid = B1.bid AND S.sid = R2.sid AND R2.bid = B2.bid AND B1.color = "red" AND B2.color = "green"';  
echo $sql;
$retval=mysqli_query($conn, $sql);  
  
if(mysqli_num_rows($retval) > 0){  
	echo "<br> Sailor Name: ";
 while($row = mysqli_fetch_assoc($retval)){  
	echo "<br> {$row['sname']}";  
 } //end of while  
}else{  
echo "0 results";  
}

echo "<br><br/>";
$sql = 'SELECT S.sname
FROM Sailors S, Reserves R 
WHERE S.sid = R.sid AND R.bid = 103';  
echo $sql;
$retval=mysqli_query($conn, $sql);  
  
if(mysqli_num_rows($retval) > 0){  
	echo "<br> Sailor Name: ";
 while($row = mysqli_fetch_assoc($retval)){  
	echo "<br> {$row['sname']}";  
 } //end of while  
}else{  
echo "0 results";  
}

echo "<br><br/>";
$sql = 'SELECT S.sid
FROM Sailors S 
WHERE S.rating >= ALL(SELECT S.rating FROM Sailors S)';  
echo $sql;
$retval=mysqli_query($conn, $sql);  
  
if(mysqli_num_rows($retval) > 0){  
	echo "<br> Sailor ID: ";  
 while($row = mysqli_fetch_assoc($retval)){  
    echo "<br> {$row['sid']}";
 } //end of while  
}else{  
echo "0 results";  
}

echo "<br><br/>";
$sql = 'SELECT S.sname
FROM Sailors S 
WHERE NOT EXISTS
(SELECT B.bid FROM Boats B EXCEPT SELECT R.bid FROM Reserves R WHERE R.sid = S.sid)';  
echo $sql;
$retval=mysqli_query($conn, $sql);  
  
if(mysqli_num_rows($retval) > 0){  
	echo "<br> Sailor Name: ";  
 while($row = mysqli_fetch_assoc($retval)){  
	echo "<br> {$row['sname']}";  
 } //end of while  
}else{  
echo "0 results";  
}

echo "<br><br/>";
$sql = 'SELECT S.sname, S.age
FROM Sailors S
WHERE S.age >= ALL(SELECT S1.age FROM Sailors S1)';  
echo $sql;
$retval=mysqli_query($conn, $sql);  
  
if(mysqli_num_rows($retval) > 0){  
 while($row = mysqli_fetch_assoc($retval)){  
    echo 
         "<br> Sailor Name: {$row['sname']}".  
		 "<br> Age: {$row['age']}";
 } //end of while  
}else{  
echo "0 results";  
}

echo "<br><br/>";
$sql = 'SELECT S.rating, AVG(S.age) AS averageage
FROM Sailors S 
GROUP BY S.rating
HAVING COUNT(*) > 1';  
echo $sql;
$retval=mysqli_query($conn, $sql);  
  
if(mysqli_num_rows($retval) > 0){  
 while($row = mysqli_fetch_assoc($retval)){  
    echo "<br> Rating : {$row['rating']}<br>".  
         "Average Age : {$row['averageage']}<br>".    
         "--------------------------------";  
 } //end of while  
}else{  
echo "0 results";  
}

echo "<br><br/>";
$sql = 'SELECT B.bid, COUNT(*) AS sailorcount
FROM Boats B, Reserves R 
WHERE R.bid = B.bid AND B.color = "red"
GROUP BY B.bid';  
echo $sql;
$retval=mysqli_query($conn, $sql);  
  
if(mysqli_num_rows($retval) > 0){  
 while($row = mysqli_fetch_assoc($retval)){  
    echo "<br> Boat ID : {$row['bid']}  <br> ".  
         "Sailor Count : {$row['sailorcount']} <br> ".    
         "--------------------------------";  
 } //end of while  
}else{  
echo "0 results";  
}

mysqli_close($conn);
?>