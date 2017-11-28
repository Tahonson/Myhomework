<?php
$str = "как никогда раньше длинное предложение <br>";
echo $str;
$massive = explode (" ", $str);
$index =0;
$elements = count ($massive);
while ($index < $elements/2) {
    $b = $massive[$index];
    $massive[$index] = $massive[$elements - $index - 1];
    $massive[$elements - $index - 1] = $b;
    echo $massive[$index] ."|" ;
    $index++;
}
while ($index < $elements) {
    echo $massive[$index] ."|" ;
    $index++;
}

