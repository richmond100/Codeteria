<?php
    $pay = 0;
    $length = $_REQUEST['length'];

    $industryexpstring = "any";
    $proficienciesstring ="any";

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
            
        if(isset($_REQUEST['pay']) && strlen($_REQUEST['pay']) > 0)
        {
            $pay = $_REQUEST['pay'];
        }
        $sql = "SELECT * FROM projectTable WHERE pay >= $pay AND length <= $length";
        if(isset($_REQUEST['description']) && strlen($_REQUEST['description']) > 0)
        {
            $description = $_REQUEST['description'];
            $sql .= " AND description REGEXP '$description'";
        }
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
        <th>Company Name</th>
        <th>Pay</th>
        <th>Industry Type</th>
        <th>Desired Industry Experience</th>
        <th>Desired Programming Proficiencies</th>
        <th>Project Length</th>
        <th>Description</th>
        </tr>
        ";
        while($row = mysqli_fetch_array($table))
        {
            echo "<tr>";
            echo "<td>" . $row['companyName'] . "</td>";
            echo "<td>" . $row['pay'] . "</td>";
            echo "<td>" . $row['industry'] . "</td>";
            echo "<td>" . $row['industryexp'] . "</td>";
            echo "<td>" . $row['proficiencies'] . "</td>";
            echo "<td>" . $row['length'] . "</td>";
            echo "<td>" . $row['description'] . "</td>";
            echo"</tr>";
        }
        echo "</table>";
        }
}
    mysqli_close($connect);
?>
