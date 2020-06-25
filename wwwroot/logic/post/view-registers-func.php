<!-- Initial html table content -->
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th>#</th>
      <th>Content</th>
      <th>Delete note</th>
    </tr>
  </thead>

  <?php

  /* MySQL variables */
  $servername = "den1.mysql5.gear.host";
  $username = "publicnotesdb";
  $password = "Mu11h?wV~k15";
  $dbname = "publicnotesdb";

  /* Tests connection. If connection fails, error page will be shown */
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } 

  /* SQL qurery */
  $sql = "SELECT * from note ORDER BY id desc";

  /* Executes the query and saves query results inside a variable called result */
  $result = $conn->query($sql);

  /* If there are rows, then starts reading */
  if ($result->num_rows > 0) {

    /* While that reads all the rows */
    while($row = $result->fetch_assoc()) {

      /* Variables to store the columns info */
      $id = $row["id"];
      $info = $row["note_content"];

      /* echo command that will write the html content */
      /* returns an a href with the id inside the get url info to delete records when clicked. It  */
      /* calls another php file when clicked that manages to delete records. */
      echo 
      "<tr>
        <td>"
          .$id.
        "</td>
        <td>"
          .$info.
        "</td>
        <td>
          <a href=\"../php-functions/delete-register-func.php?delete_id=".$id."\" onclick= \"return confirm('Delete note $id from database?')\">Delete</a>
        </td>
      </tr>";
    }
  } else {
    echo "<h1>There are no notes stored.</h1>";
  }
  $conn->close();
  ?>
</table>