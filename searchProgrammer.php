<?php
    $pay = 0;
    $industryexpstring = "any";
    $proficienciesstring ="any";
    $years = 0;

    $description = "any";
    $servername = "localhost";
    //fake
    $myuser = "user";
    $mypass = "pass";
    $myDB = "rliang2018";
    $connect = mysqli_connect($servername, $myuser, $mypass, $myDB);
    if(mysqli_connect_errno())
    {
        echo "Connection failed ". mysqli_connect_error();
    }
    else
    {
        if(isset($_Request['years']))
        {
            $years = $_REQUEST['years'];
        }
        $sql = "SELECT * FROM devTable WHERE years >= $years";
        if(isset($_REQUEST['industryexp']))
        {       
            $industryexp = $_REQUEST['industryexp'];
            $sql .= " AND (";
            $clause = "";
            foreach ($industryexp as $value)
            {
                $sql .= $clause."industryexp REGEXP '{$value}'";
                $clause = " OR ";
            }
            $sql .= ")";
            $industryexpstring = implode(" , ", $industryexp);
        }
        if(isset($_REQUEST['proficiencies']))
        {  
            $proficiencies = $_REQUEST['proficiencies'];
            $sql .= " AND (";
            $clause = "";
            foreach ($proficiencies as $value)
            {
                $sql .= $clause."proficiencies REGEXP '{$value}'";
                $clause = " OR ";
            }
            $sql .= ")";
        }
        //echo $sql;
        $table = mysqli_query($connect, $sql);
        if($table->num_rows == 0)
        {
        echo "No Results";
        }
        else
        { 
        echo "<style>
        table, th, td {border: 1px solid black;}
        </style>";
        echo 
        "<table>
        <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Industry Experience</th>
        <th>Programming Proficiencies</th>
        <th>Years of Experience</th>
        </tr>
        ";
        while($row = mysqli_fetch_array($table))
        {
            echo "<tr>";
            echo "<td>" . $row['fname'] . "</td>";
            echo "<td>" . $row['lname'] . "</td>";
            echo "<td>" . $row['industryexp'] . "</td>";
            echo "<td>" . $row['proficiencies'] . "</td>";
            echo "<td>" . $row['years'] . "</td>";
            echo"</tr>";
        }
        echo "</table>";
        }
}
    mysqli_close($connect);
?>
