<?php
$age= 0.5;
if (18<=$age and $age<=65) {
    echo "Вам еще работать и работать";
} elseif ($age>65) {
    echo "Вам пора на пенсию";
} elseif ($age>=1 and $age<18) {
    echo "Вам еще рано работать";
}
else echo "Неизвестный возраст";