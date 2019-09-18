<?php
    $name = $_REQUEST['name'];
    $companyname = $_REQUEST['companyname'];
    $phone = $_REQUEST['phone'];
    $email = $_REQUEST['email'];

    $pay = 0;
    $industry = $_REQUEST['industry'];
    $length = $_REQUEST['length'];

    $years = $_REQUEST['years'];
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

    if(mysqli_query($connect, "SELECT * FROM projectTable") === false)
    {
        $table = "CREATE TABLE projectTable(
        name VARCHAR(30) NOT NULL, 
        companyName VARCHAR(30) NOT NULL, 
        phone VARCHAR(15) NOT NULL, 
        email VARCHAR(30) NOT NULL, 
        
        pay INT NOT NULL, 
        industry VARCHAR(15) NOT NULL, 
        length INT NOT NULL, 
        
        years INT NOT NULL,
        
        industryexp VARCHAR (50) NOT NULL,
        
        proficiencies VARCHAR (50) NOT NULL,
        
        description VARCHAR(255) NOT NULL
        )";
        if(mysqli_query($connect, $table) === false)
        {
            echo "Error Creating projectTable: ". $connect->error;
        }
    }
    if(isset($_REQUEST['pay']))
    {
        $pay = $_REQUEST['pay'];
    }
    if(isset($_REQUEST['industryexp']))
    {       
        $industryexp = $_REQUEST['industryexp'];
        $industryexpstring .= " , ";
        $industryexpstring .= implode(" , ", $industryexp);
    }
    if(isset($_REQUEST['proficiencies']))
    {  
        $proficiencies = $_REQUEST['proficiencies'];
        $proficienciesstring .= " , ";
        $proficienciesstring .= implode(" , ", $proficiencies);
    }
    if(isset($_REQUEST['description']) && strlen($_REQUEST['description']) > 0)
    {
        $description = $_REQUEST['description'];
    }
    $table = "INSERT INTO projectTable(name, companyname, phone, email, pay, industry, length, years, industryexp, proficiencies, description) VALUES('$name', '$companyname', '$phone', '$email', $pay, '$industry', $length, $years, '$industryexpstring', '$proficienciesstring', '$description')";
            
    if(mysqli_query($connect, $table) === false)
    { 
        echo "Error: ". $table . "<br>" . $connect->error; 
    }
    else
    {
        echo "Project added";
    }

    mysqli_close($connect);
?>
