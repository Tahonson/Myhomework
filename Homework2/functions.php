<?php
//Task №1
function task1($string, $value)
{
    if ($value === true) {
        $resault = implode('', $string);
        return $resault;
    } else {
        foreach ($string as $str) {
            echo '<p>' . $str . '<p>';
        }
    }

}

//Task №2
function task2($array, $string)
{
    /* //работа со строкой ( введеной)//
    $newarray = explode (" ", $array); */
//$elements = count ($array);
//foreach ($newarray as $elem) {
    $resault = 0;
    $resault1 = 1;
    foreach ($array as $elem) {
        switch ($string) {
            case '+':
                $resault = $resault + $elem;
                break;
            case '-':
                $resault = $resault - $elem;
                break;
            case '*':
                $resault1 = $resault1 * $elem;
                $resault = $resault1;
                break;
            case '/':
                $resault1 = $resault1 / $elem;
                $resault = $resault1;
                break;
            default:
                return 'Неизвестный арифметический оператор';
                break;
        }
    }
    return $resault;
}

//Task №3
function task3()
{
    $kolvo = func_num_args();
    $operator = func_get_arg(0);
    if ($operator == '+') {
        $tusk3 = 0;
        for ($i = 1; $i <= $kolvo; $i++) {
            $tusk3 = $tusk3 + func_get_arg($i);
        }
    } elseif ($operator == '-') {
        $tusk3 = 0;
        for ($i = 1; $i <= $kolvo; $i++) {
            $tusk3 = $tusk3 - func_get_arg($i);
        }
    } elseif ($operator == '*') {
        $tusk3 = func_get_arg(1);
        for ($i = 2; $i <= $kolvo; $i++) {
            $tusk3 = $tusk3 * func_get_arg($i);
        }
    } elseif ($operator == '/') {
        $tusk3 = func_get_arg(1);
        for ($i = 2; $i < $kolvo; $i++) {
            $tusk3 = $tusk3 / func_get_arg($i);
        }
    } else echo "Введите первым символом математическую операцию";
    return $tusk3;
}

//Task №4
function task4($p1, $p2)
{
    if (is_integer($p1) and is_integer($p2)) {
        echo "<table border='1px'>";
        for ($i = 1; $i <= $p1; $i++) {

            echo "<tr>";

            for ($j = 1; $j <= $p2; $j++) {

                echo "<td>";

                $a[$i][$j] = $i * $j;

                $m = $i + 1;
                echo $a[$i][$j];
                echo "</td>";

            }

            echo "</tr>";

        }

        echo "</table>";


    } else echo "неверно введены данные";

}

//Task №5
function utf8_strrev($str)
{
    preg_match_all('/./us', $str, $ar);
    return join('', array_reverse($ar[0]));
}

function firstrs($str)
{
    $str = str_replace(' ', '', mb_strtolower($str)); //находим в строке пробелы, убираем, приводим к нижнему регистру
    $revstr = utf8_strrev($str);
    return $str === $revstr ? true:false;
}

function task5($str)
{
    if (firstrs($str)) {
        echo 'Строка является палиндромом';
    } else echo 'Строка не является палиндромом';
}
//Task №6

function task6()
{
    echo date('d.m.Y H:i:s') . "<br>";
    echo date_timestamp_get(new DateTime());
}
//Task №7
function task7()
{
    $one = 'Карл у Клары украл Кораллы' . "<br>";
    echo $string = str_replace('К', '', $one) . "
";
    $two = 'Две бутылки лимонада';
    echo $string = str_replace('Две', 'Три', $two);
}

//Task №8
function task8($string)
{
    require('smile.php');
    $b = '|packets:([0-9]+)|';
    $s = '|[:][)]|';
    if (preg_match($s, $string)) {
        smile();
    } else {
        preg_match_all($b, $string, $output);
        foreach ($output as $entry) {
            if ($entry > 1000) {
                echo 'Сеть есть!';
                break;
            } else echo 'Сети нет!';
        }
    }
}

//Задание №9
function task9($text)
{
    if (file_exists($text)) {
        $file = file_get_contents($text);
        return $file;
    } else return 'Такой файл не существует!';
}

//Задание №10
function task10($text)
{
    $a = 'Hello again!';
    $rewrite = fopen($text, 'w+');
    fwrite($rewrite, $a);
    fclose($rewrite);
}