<?php
echo "<table border='1px'>";
$a = array();
for ($i=1;$i<=10;$i++) {
    echo "<tr>";
    for($j=1;$j<=10;$j++) {
        echo "<td>";
        $a[$i][$j]=$i*$j;
        $m=$i+1;
        if ($m%2 == 1 and $j%2 == 0) {
            echo "(" .$a[$i][$j] .")";
        }       else echo "[" .$a[$i][$j] ."]";

        echo "</td>";
    }
    echo "</tr>";
}
echo "</table>";