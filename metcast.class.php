<?php 
	echo "Прогноз тумана!";

	class metcast // Класс расчетных методов явлений погоды
{
 	var $T;     // температура воздуха (13ч или 19ч)
    var $Td;    // температура точки росы (13ч или 19ч)
    var $V;     // ожидаемая скорость ветра на ночь
    var $Nl;    // ожидаемое количество облачности нижнего яруса
    var $Nm;    // ожидаемое количество облачности среднего яруса
    var $Nh;    // ожидаемое количество облачности верхнего яруса
    var $tset;  // время захода Солнца
    var $trise; // время восхода Солнца
 

/* Определение минимальной температуры */
function Tmin($T,$Td,$V,$Nl,$Nm,$Nh) 
{

    $this->T = $T;
    $this->Td = $Td;
    $this->V = $V;
    $this->Nl = $Nl;
    $this->Nm = $Nm;
    $this->Nh = $Nh;

    //определение понижения температуры воздуха
    echo "dT0 = ";
    switch ($V) {
    case 20:
        $dT0 = 0.17*($T-$Td)+1.28;
        echo $dT0;
        break;
    case 15:
        $dT0 = 0.19*($T-$Td)+1.39;
        echo $dT0;
        break;
    case 10:
        $dT0 = 0.24*($T-$Td)+1.64;
        echo $dT0;
        break;
    case 9:
        $dT0 = 0.25*($T-$Td)+1.84;
        echo $dT0;
        break;
    case 8:
        $dT0 = 0.27*($T-$Td)+1.94;
        echo $dT0;
        break;
    case 7:
        $dT0 = 0.29*($T-$Td)+2.14;
        echo $dT0;
        break;
    case 6:
        $dT0 = 0.31*($T-$Td)+2.3;
        echo $dT0;
        break;
    case 5:
        $dT0 = 0.33*($T-$Td)+2.64;
        echo $dT0;
        break;
    case 4:
        $dT0 = 0.34*($T-$Td)+2.89;
        echo $dT0;
        break;
    case 3:
        $dT0 = 0.37*($T-$Td)+3.11;
        echo $dT0;
        break;
    case 2:
        $dT0 = 0.41*($T-$Td)+3.23;
        echo $dT0;
        break;
    case 1:
        $dT0 = 0.45*($T-$Td)+3.45;
        echo $dT0;
        break;
    case 0:
        $dT0 = 0.49*($T-$Td)+4.04;
        echo $dT0;
        break;
	}
    
    //определение поправочного множителя m
    $m = 1-(0.8*($Nl*0.1)+0.6*($Nm*0.1)+0.2*($Nh*0.1))*($Nl*0.1+$Nm*0.1+$Nh*0.1);
    echo "<br>";
    echo "m = ".$m;

    //понижение с учетом коэффициента 
    $dT = $m*$dT0;
    echo "<br>";
    echo "dT = ".$dT;
   
    //минимальная температура 
    $Tmin = $T-$dT;
    echo "<br>";
    echo "Tmin = ".$Tmin;

    return $Tmin;

}

/* Определение температуры туманообразования */
function Tt($Td) 
{

	$Tt = 1.03*$Td-2.02;
	echo "<br>";
    echo "Tt = ".$Tt;
    return $Tt;

}

/* Прогноз тумана */
function fog($Tmin,$Tt) 
{
	
	if ($Tt > $Tmin) {$fog = 1;} else {$fog = 0;}
	echo "<br>";
    echo "Туман = ".$fog;

}

/* Прогноз тумана */
function fog1($T,$Td,$V,$Nl,$Nm,$Nh) 
{
	//$Td=$Td1;
	//Tt($Td);
	$Tmin = $this->Tmin($T,$Td,$V,$Nl,$Nm,$Nh);
	$Tt = $this->Tt($Td);
	if ($Tt > $Tmin) {$fog = 1;} else {$fog = 0;}
	echo "<br>";
    echo "Туман = ".$fog;
	

}

function setTitle($title) // устанавливает значение в переменную $Title
{
/* Обратите внимание, что бы обратиться к переменной, */
/* нужно сначало написать $this-> а потом только имя переменной */
    $this->Title = $title;
}
 
function setContent($content) // устанавливает значение переменной $Content
{
    $this->Content = $content;
}
 
/* для обращения к функциям внутри класса используется тот же */
/* подход, что и для переменных, т.е. $this->имя_функции(параметры) */
function setAll($title, $content) // Устанавливает переменные $Title и $Content
{
    // с помощью функций данного класса
    $this->setTitle($title);
    $this->setContent($content);
   // или через переменные
    //$this->Title = $title;
    //$this->Content = $content;
    return  $this->Title;
}
}
 ?>