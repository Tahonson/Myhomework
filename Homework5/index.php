<?php

// трейт класс автомобиля
trait Transmission_Auto
{
    function Transmission_Auto($settings)
    {
        switch ($settings) {
            case 'ON' : { // включение трансмиссии
                if ($this->direction == 1) { //направление вперед
                    switch ($this->transmission_type) { // коробка передач
                        //ручная коробка
                        case '1' : {
                            echo '<p>Ручная коробка передач включена</p>';
                            echo '<p>Нейтральная передача</p>';
                            if ($this->speed <= 20 and $this->speed > 0) {
                                echo '<p>Первая передача</p>';
                            } elseif ($this->speed > 20) {
                                echo '<p>Первая передача</p>';
                                echo '<p>Нейтральная передача</p>';
                                echo '<p>Вторая передача</p>';
                            }
                            break;
                        }
                        //автомат
                        case '2' : {
                            echo '<p>Автоматическая коробка передач включена</p>';
                            break;
                        }
                    }
                } elseif ($this->direction == 2) { // направление назад
                    echo '<p>Включена задняя передача</p>';
                }
                break;
            }
            case 'OFF' : {  // выключение трансмиссии
                echo '<p>Коробка передач выключена</p>';
                break;
            }
        }
    }
}

class Car
{
    // функция коробки передач

    use Transmission_Auto;
    public $power; //лош силы
    public $speed; // скорость
    public $distance; // дистанция
    public $direction; // направление
    public $transmission_type; // коробка

    //функция движения
    public function move($distance, $speed, $direction)
    {

        $this->speed = $speed;
        $this->distance = $distance;
        $this->direction = $direction;

        $this->engine('ON');
        $this->Transmission_Auto('ON');
        $direction = ($direction == 1 ? 'MOVE' : 'REVERSE');

        $this->engine($direction,$this->distance,$this->speed);

        $this->Transmission_Auto('OFF');
        $this->engine('OFF');

    }

    public function engine($settings, $distance = NULL, $speed = NULL) // работа двигателя
    {
        if (($this->power * 2) < $speed) {  // значение скорости в случае заданного нами превышения мощности
            $speed = $this->power * 2;
        }
        switch ($settings) { // двигатель , работа
            case 'ON': {
                echo '<p>Двигатель запустился</p>';
                break;
            }
            case 'MOVE': {
                $temperature = 0;
                for ($long = 0; $long < $distance; $long += 10) { // охлаждение в движении вперед + время пути
                    $temperature = $temperature + 5;
                    if ($temperature == 90) {
                        $temperature = $this->refrigeration($temperature, $long); // место превышения темп.
                    }
                }
                $time = $distance / $speed;
                echo '<p>Время в пути - ' . $time . ' секунд </p>';
                break;
            }
            case 'REVERSE': { // охлаждение задним ходом + время в пути reverse
                $temperature = 0;
                for ($long = 0; $long < $distance; $long += 10) {
                    $temperature = $temperature + 5;
                    if ($temperature == 90) {
                        $temperature = $this->refrigeration($temperature, $long); // место превышения темп.
                    }
                }
                $speed = 5;
                $time = $distance / $speed;
                echo '<p> Время в пути - ' . $time . ' </p>';
                break;
            }
            case 'OFF': {
                echo '<p> Двигатель выключен </p>';
                break;
            }
        }
    }

    // $temperature - функция регулирования температуры
    public function refrigeration($temperature, $long)
    {
        $temperature = $temperature - 10;
        echo '<p>Охлаждение включилось на дистанции - ' . $long . ' </p>';
        return $temperature;

    }

}

final class Niva extends Car
{
    function __construct($power)
    {
        $this->power = $power;

        $this->transmission_type = 1;
    }
}

final  class Lada extends Car
{
    function __construct($power)
    {
        $this->power = $power;
        $this->transmission_type = 2;
    }
}


// cоздаем машину . объект из 1 фин. класса
$Niva_4x4 = new Niva (80); //параметры (мощность)
$Niva_4x4->move(300,120, 1);
echo '<br>';
// создаем машину. объект из 2 фин. класса
$car2 = new Lada(30);
$car2->move(90, 80, 1);
echo '<br>';



