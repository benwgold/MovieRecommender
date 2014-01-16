<html>
<head>
    <title>Db Test </title>
    <meta charset='utf-8'>
</head>
<body>
    <pre>
        <?php
            echo "<table border=5><tr><td>Movie Name</td><td>List Name</td></tr>";
            foreach($records as $row){
                echo "<td>".$row->moviename."</td><td>".$row->listname."</td></tr>";
            }
            echo "</table>"
        ?>
    </pre>
</body>
</html>