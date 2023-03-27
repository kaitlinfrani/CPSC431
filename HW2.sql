-- Kaitlin Frani
-- CPSC431-02
-- HW #2

-- Create Tables
-- Sailors Instance
CREATE TABLE Sailors (
    sid INT,
    sname VARCHAR(100),
    rating INT,
    age decimal(3,1),
    PRIMARY KEY(sid)
);

-- Boats Instance
CREATE TABLE Boats (
    bid INT,
    bname VARCHAR(100),
    color VARCHAR(100),
    PRIMARY KEY (bid)
);

-- Reserves Instance
CREATE TABLE Reserves (
    sid INT,
    bid INT,
    day DATE,
    FOREIGN KEY (sid) REFERENCES Sailors(sid),
    FOREIGN KEY (bid) REFERENCES Boats(bid) 
);

-- Populate Data
-- Sailors Data
INSERT INTO Sailors (sid, sname, rating, age)
VALUES ('22', 'Dustin', '7', '45.0');

INSERT INTO Sailors (sid, sname, rating, age)
VALUES ('29', 'Brutus', '1', '33.0');

INSERT INTO Sailors (sid, sname, rating, age)
VALUES ('31', 'Lubber', '8', '55.5');

INSERT INTO Sailors (sid, sname, rating, age)
VALUES ('32', 'Andy', '8', '25.5');

INSERT INTO Sailors (sid, sname, rating, age)
VALUES ('58', 'Rusty', '10', '35.0');

INSERT INTO Sailors (sid, sname, rating, age)
VALUES ('64', 'Horatio', '7', '35.0');

INSERT INTO Sailors (sid, sname, rating, age)
VALUES ('71', 'Zorba', '10', '16.0');

INSERT INTO Sailors (sid, sname, rating, age)
VALUES ('74', 'Horatio', '9', '35.0');

INSERT INTO Sailors (sid, sname, rating, age)
VALUES ('85', 'Art', '3', '25.5');

INSERT INTO Sailors (sid, sname, rating, age)
VALUES ('95', 'Bob', '3', '63.5');

-- Boats Data
INSERT INTO Boats (bid, bname, color)
VALUES ('101', 'Interlake', 'blue');

INSERT INTO Boats (bid, bname, color)
VALUES ('102', 'Interlake', 'red');

INSERT INTO Boats (bid, bname, color)
VALUES ('103', 'Clipper', 'green');

INSERT INTO Boats (bid, bname, color)
VALUES ('104', 'Marine', 'red');


-- Reserves Data
INSERT INTO Reserves (sid, bid, day)
VALUES ('22', '101', '1998-10-10');

INSERT INTO Reserves (sid, bid, day)
VALUES ('22', '102', '1998-10-10');

INSERT INTO Reserves (sid, bid, day)
VALUES ('22', '103', '1998-10-08');

INSERT INTO Reserves (sid, bid, day)
VALUES ('22', '104', '1998-10-07');

INSERT INTO Reserves (sid, bid, day)
VALUES ('31', '102', '1998-11-10');

INSERT INTO Reserves (sid, bid, day)
VALUES ('31', '103', '1998-11-06');

INSERT INTO Reserves (sid, bid, day)
VALUES ('31', '104', '1998-11-12');

INSERT INTO Reserves (sid, bid, day)
VALUES ('64', '101', '1998-09-05');

INSERT INTO Reserves (sid, bid, day)
VALUES ('64', '102', '1998-09-08');

INSERT INTO Reserves (sid, bid, day)
VALUES ('74', '103', '1998-09-08');


-- Queries
-- Find the names of sailors who have reserved a red or a green boat.
SELECT S.sname
FROM Sailors S, Reserves R, Boats B 
WHERE S.sid = R.sid AND R.bid = B.bid
AND (B.color = 'red' OR B.color = 'green')

-- Find the names of sailors who have reserved both a red and a green boat.
SELECT S.sname
FROM Sailors S, Reserves R1, Reserves R2, Boats B1, Boats B2 
WHERE S.sid = R1.sid AND R1.bid = B1.bid AND S.sid = R2.sid AND R2.bid = B2.bid AND B1.color = 'red' AND B2.color = 'green'

-- Find the names of sailors who have reserved boat 103.
SELECT S.sname
FROM Sailors S, Reserves R 
WHERE S.sid = R.sid AND R.bid = 103

-- Find the sailors with the highest rating.
SELECT S.sid
FROM Sailors S 
WHERE S.rating >= ALL(SELECT S.rating FROM Sailors S)

-- Find the names of sailors who have reserved all boats.
SELECT S.sname
FROM Sailors S 
WHERE NOT EXISTS
(SELECT B.bid FROM Boats B EXCEPT SELECT R.bid FROM Reserves R WHERE R.sid = S.sid)

-- Find the name and age of the oldest sailor.
SELECT S.sname, S.age
FROM Sailors S
WHERE S.age >= ALL(SELECT S1.age FROM Sailors S1)

-- Find the average age of sailors for each rating level that has at least two sailors.
SELECT S.rating, AVG(S.age) AS averageage
FROM Sailors S 
GROUP BY S.rating
HAVING COUNT(*) > 1

-- For each red boat, find the number of reservations for this boat.
SELECT B.bid, COUNT(*) AS sailorcount
FROM Boats B, Reserves R 
WHERE R.bid = B.bid AND B.color = 'red'
GROUP BY B.bid
