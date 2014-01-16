<head>
    <title>List Test </title>
    <meta charset='utf-8'>
</head>
<body>
    <pre>
        <?php
            echo "<b> List Entries for ".$moviename."</b>";
            echo "<table border=5><tr><td>List Name</td></tr>";
            foreach($result as $row){
                echo "<td>".$row->moviename."</td><td>".$row->listname."</td></tr>";
            }
            echo "</table>"
        ?>
    </pre>
</body>
</html>