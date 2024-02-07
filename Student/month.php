<?php
    require './header1.html';
?>
    <div class="container mt-5">
    <h2 class="text-primary">Monthly Report</h2>
        <form action="" method="post">
        
        <div class="form-group">
                <label for="from">From</label>
                <input type="date" class="form-control" name="from" id="from">
            </div>
            <div class="form-group">
                <label for="to">To</label>
                <input type="date" class="form-control" name="to" id="to">
            </div>
            <div class="form-group" style="margin:3px;">
                <label for="selection">Select an Option:</label>
                <select class="form-control" id="selection" name="selection" required>
                    <option value="course">Course</option>
                    <option value="college">College</option>
                    <option value="college-course">College Course</option>
                    <option value="job">Job</option>
                </select>
            </div>
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary" style="margin:3px;" name=submit>Submit</button>

        </form>
    </div>

        <?php
         
            require '../connection.php';
            if(isset($_POST['submit'])){
                $from = $_POST['from'];
                $to = $_POST['to'];
                if($_POST['selection']=="college-course"){
                    echo '<table class="table table-striped" id="coursetable">
                            <thead>
                                <tr>
                                    <th colspan="5"><center>College Course Monthly Report From ('.$from.') To ('.$to.')</center></th>
                                </tr>
                                <tr>
                                    <th>College</th>
                                    <th>Course</th>
                                    <th>Year</th>
                                    <th>Month</th>
                                    <th>No. of Interested Students</th>
                                </tr>
                            </thead>
                            <tbody>';

                    $from = $_POST['from'];
                    $to = $_POST['to'];
                    $sql = "SELECT
                            CC_id,
                            YEAR(Date) AS Year,
                            MONTH(Date) AS Month,
                            COUNT(*) AS Count
                            FROM
                                Intrested
                            WHERE
                                CC_id IS NOT NULL AND Date BETWEEN '$from' AND '$to'
                            GROUP BY
                                CC_id,
                                YEAR(Date),
                                MONTH(Date);
                        ";
                    $data = mysqli_query($dbcon, $sql);

                    if($data) {
                        while($row = mysqli_fetch_array($data)) {
                            echo '<tr>';
                            $cc = $row['CC_id'];
                            $sql2 = "SELECT Collegeid, Courseid FROM CollegeCourse WHERE CCid=$cc";
                            $data2 = mysqli_query($dbcon, $sql2);

                            while($row2 = mysqli_fetch_array($data2)) {
                                $cid = $row2['Collegeid'];
                                $sql3 = "SELECT Name FROM College WHERE Collegeid=$cid";
                                $data3 = mysqli_query($dbcon, $sql3);
                                $row3 = mysqli_fetch_array($data3);

                                $cid = $row2['Courseid'];
                                $sql4 = "SELECT Name FROM Course WHERE Courseid=$cid";
                                $data4 = mysqli_query($dbcon, $sql4);
                                $row4 = mysqli_fetch_array($data4);

                                echo "<td>".$row3['Name']."</td><td>". $row4['Name']."</td>";
                            }
                            echo '<td>'.$row['Year'].'</td>';
                            echo '<td>'.$row['Month'].'</td>';
                            echo '<td>'.$row['Count'].'</td></tr>';
                        }

                        echo '</tbody></table>';
                    }
                }
                else if($_POST['selection']=="college"){
                    

                    $from = $_POST['from'];
                    $to = $_POST['to'];
                    echo '<table class="table table-striped" id="coursetable">
                            <thead>
                                <tr>
                                    <th colspan="4"><center>College Monthly Report From ('.$from.') To ('.$to.')</center></th>
                                    
                                </tr>
                                <tr>
                                    <th>College Name</th>
                                    <th>Year</th>
                                    <th>Month</th>
                                    <th>No. of Interested Students</th>
                                </tr>
                            </thead>
                            <tbody>';
                    $sql = "SELECT
                        College_id,
                        YEAR(Date) AS Year,
                        MONTH(Date) AS Month,
                        COUNT(*) AS Count
                        FROM
                            Intrested
                        WHERE
                            College_id IS NOT NULL AND Date BETWEEN '$from' AND '$to'
                        GROUP BY
                            College_id,
                            YEAR(Date),
                            MONTH(Date);
                    ";
                    $data = mysqli_query($dbcon, $sql);
                    // echo $sql;

                    if($data) {
                        while($row = mysqli_fetch_array($data)) {
                            echo '<tr>';
                            $cc = $row['College_id'];
                            $sql2 = "SELECT Name FROM College WHERE Collegeid=$cc";
                            // echo $sql2;
                            $data2 = mysqli_query($dbcon, $sql2);
                            $row2=mysqli_fetch_array($data2);
                            echo '<td>'.$row2['Name'].'</td>';
                            echo '<td>'.$row['Year'].'</td>';
                            echo '<td>'.$row['Month'].'</td>';
                            echo '<td>'.$row['Count'].'</td></tr>';
                        }

                        echo '</tbody></table>';
                    }
                }
                else if($_POST['selection']=="course"){
                    

                    $from = $_POST['from'];
                    $to = $_POST['to'];
                    echo '<table class="table table-striped" id="coursetable">
                            <thead>
                                <tr>
                                    <th colspan="4"><center>Course Monthly Report From ('.$from.') To ('.$to.')</center></th>
                                    
                                </tr>
                                <tr>
                                    <th>Course Name</th>
                                    <th>Year</th>
                                    <th>Month</th>
                                    <th>No. of Interested Students</th>
                                </tr>
                            </thead>
                            <tbody>';
                    $sql = "SELECT
                            Course_id,
                            YEAR(Date) AS Year,
                            MONTH(Date) AS Month,
                            COUNT(*) AS Count
                            FROM
                                Intrested
                            WHERE
                                Course_id IS NOT NULL AND Date BETWEEN '$from' AND '$to'
                            GROUP BY
                                Course_id,
                                YEAR(Date),
                                MONTH(Date);
                            ";
                    $data = mysqli_query($dbcon, $sql);
                    // echo $sql;

                    if($data) {
                        while($row = mysqli_fetch_array($data)) {
                            echo '<tr>';
                            $cc = $row['Course_id'];
                            $sql2 = "SELECT Name FROM Course WHERE Courseid=$cc";
                            // echo $sql2;
                            $data2 = mysqli_query($dbcon, $sql2);
                            $row2=mysqli_fetch_array($data2);
                            echo '<td>'.$row2['Name'].'</td>';
                            echo '<td>'.$row['Year'].'</td>';
                            echo '<td>'.$row['Month'].'</td>';
                            echo '<td>'.$row['Count'].'</td></tr>';
                        }

                        echo '</tbody></table>';
                    }
                }
                else if($_POST['selection']=="job"){
                    

                    $from = $_POST['from'];
                    $to = $_POST['to'];
                    echo '<table class="table table-striped" id="coursetable">
                            <thead>
                                <tr>
                                    <th colspan="4"><center>Job Monthly Report From ('.$from.') To ('.$to.')</center></th>
                                    
                                </tr>
                                <tr>
                                    <th>Job Name</th>
                                    <th>Year</th>
                                    <th>Month</th>
                                    <th>No. of Interested Students</th>
                                </tr>
                            </thead>
                            <tbody>';
                    $sql = "SELECT
                            Job_id,
                            YEAR(Date) AS Year,
                            MONTH(Date) AS Month,
                            COUNT(*) AS Count
                            FROM
                                Intrested
                            WHERE
                                Job_id IS NOT NULL AND Date BETWEEN '$from' AND '$to'
                            GROUP BY
                                Job_id,
                                YEAR(Date),
                                MONTH(Date);
                            ";
                    $data = mysqli_query($dbcon, $sql);
                    // echo $sql;

                    if($data) {
                        while($row = mysqli_fetch_array($data)) {
                            echo '<tr>';
                            $cc = $row['Job_id'];
                            $sql2 = "SELECT Name FROM Job WHERE Jobid=$cc";
                            // echo $sql2;
                            $data2 = mysqli_query($dbcon, $sql2);
                            $row2=mysqli_fetch_array($data2);
                            echo '<td>'.$row2['Name'].'</td>';
                            echo '<td>'.$row['Year'].'</td>';
                            echo '<td>'.$row['Month'].'</td>';
                            echo '<td>'.$row['Count'].'</td></tr>';
                        }

                        echo '</tbody></table>';
                    }
                }
                else if($_POST['selection']=="student"){
                    

                    $from = $_POST['from'];
                    $to = $_POST['to'];
                    echo '<table class="table table-striped" id="coursetable">
                            <thead>
                                <tr>
                                    <th colspan="3"><center>Student Monthly Report From ('.$from.') To ('.$to.')</center></th>
                                    
                                </tr>
                                <tr>
                                    <th>Year</th>
                                    <th>Month</th>
                                    <th>No of Students</th>
                                </tr>
                            </thead>
                            <tbody>';
                    // $sql = "SELECT Job_id, COUNT(*) AS count
                    //         FROM Intrested
                    //         WHERE Job_id IS NOT NULL AND Date BETWEEN '$from' AND '$to'
                    //         GROUP BY Job_id;";
                    $sql="SELECT
                            YEAR(Date) AS Year,
                            MONTH(Date) AS Month,
                            COUNT(*) AS Count
                        FROM
                            Student
                        WHERE
                            Studentid IS NOT NULL AND Date BETWEEN '$from' AND '$to'
                        GROUP BY
                            YEAR(Date),
                            MONTH(Date);
                        ";
                    $data = mysqli_query($dbcon, $sql);
                  //  echo $sql;

                    if($data) {
                        while($row = mysqli_fetch_array($data)) {
                            echo '<tr>';
                            echo '<td>'.$row['Year'].'</td>';
                            echo '<td>'.$row['Month'].'</td>';
                            echo '<td>'.$row['Count'].'</td></tr>';
                        }

                        echo '</tbody></table>';
                    }
                }
            }
            echo '<button class="btn btn-primary" onclick="generatePDF()">Generate PDF</button>';
            require '../footer.html';
        ?>
     
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
