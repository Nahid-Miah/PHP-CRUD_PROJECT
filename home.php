<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>HTML Form</title>
<style>
  body {
    /* display: flex; */
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
  }
  form {
    width: 40%;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom:20px;
    margin-top:15px;
  }
  .form-group {
    margin-bottom: 10px;
    display: flex;
    align-items: center;
  }
  .form-group label {
    width: 150px;
    font-weight: bold;
  }
  .form-group input[type="text"] {
    flex: 1;
    padding: 5px;
    border-radius: 3px;
    border: 1px solid #ccc;
  }
  .submit-btn {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 3px;
    cursor: pointer;
  }
</style>
</head>
<body>

<form action="#" method="post">
  <!-- <div class="form-group">
    <label for="id">ID:</label>
    <input type="text" id="id" name="id" required>
  </div> -->
  <div class="form-group">
    <label for="title">Tittle:</label>
    <input type="text" id="title" name="title" required>
  </div>
  <div class="form-group">
    <label for="shortCode">Short Code:</label>
    <input type="text" id="shortCode" name="shortCode" required>
  </div>
  <div class="form-group">
    <label for="pathId">Path ID:</label>
    <input type="text" id="pathId" name="pathId">
    <label for="subProjectId">Sub Project ID:</label>
    <input type="text" id="subProjectId" name="subProjectId">
  </div>
  <!-- <div class="form-group">
    <label for="isActive">Is Active:</label>
    <input type="text" id="isActive" name="isActive">
  </div> -->
  <div class="form-group">
    <label for="insertBy">Insert By:</label>
    <input type="text" id="insertBy" name="insertBy">
  </div>
  <!-- <div class="form-group">
    <label for="insertDate">Insert Date:</label>
    <input type="text" id="insertDate" name="insertDate">
  </div> -->
  <button type="submit" class="submit-btn">Submit</button>
</form>

<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "walton"; // Replace with your actual database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = $_POST["title"];
        $shortCode = $_POST["shortCode"];
        $pathId = $_POST["pathId"];
        $subProjectId = $_POST["subProjectId"];
        // $isActive = $_POST["isActive"];
        $insertBy = $_POST["insertBy"];
        // $insertDate = $_POST["insertDate"];
      
        $sql = "INSERT INTO info (tittle, short_code, path_id, sub_project_id, insert_by) 
                VALUES ('$title', '$shortCode', '$pathId', '$subProjectId', '$insertBy')";

        if($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $sql = "SELECT * FROM info";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      echo "<table border='1'>";
      // echo "<table><tr><th>ID</th><th>Name</th></tr>";
      echo "<tr><th>id</th><th>Title</th><th>Short Code</th><th>Path ID</th><th>Sub Project ID</th><th>IActive</th><th>Inserted By</th> <th>Insert-Date</th></tr>";
      // output data of each row
      while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"] ."<t/td><td>" . $row["tittle"]. "</td><td>" . $row["short_code"]. "</td><td>" . $row["path_id"]. "</td><td>" . $row["sub_project_id"]."</td><td>" . $row["is_active"] ."</td><td>" . $row["insert_by"]. "</td><td>".$row["insert_date"]."</td></tr>";
      }
      echo "</table>";
    } 
    else {
      echo "0 results";
    }
    $conn->close();
?>
</body>
</html>