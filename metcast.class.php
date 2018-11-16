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
 
/***************************************
	Метод Зверева (ист. Сборник алгоритмов и программ расчетных метеорологических задач для решения на ПЭВМ, 1992)
***************************************/

/* Определение минимальной температуры по данным за 19ч*/
function T19min($T,$Td,$V,$Nl,$Nm,$Nh) 
{

    $this->T = $T;
    $this->Td = $Td;
    $this->V = $V;
    $this->Nl = $Nl;
    $this->Nm = $Nm;
    $this->Nh = $Nh;

    //определение понижения температуры воздуха
    //echo "dT0_19 = ";
    switch ($V) {
    case 10:
        $dT0_19 = 0.24*($T-$Td)+1.54;
        //echo $dT0_19;
        break;
    case 9:
        $dT0_19 = 0.25*($T-$Td)+1.84;
        //echo $dT0_19;
        break;
    case 8:
        $dT0_19 = 0.27*($T-$Td)+1.94;
        //echo $dT0_19;
        break;
    case 7:
        $dT0_19 = 0.29*($T-$Td)+2.14;
        //echo $dT0_19;
        break;
    case 6:
        $dT0_19 = 0.31*($T-$Td)+2.3;
        //echo $dT0_19;
        break;
    case 5:
        $dT0_19 = 0.33*($T-$Td)+2.54;
        //echo $dT0_19;
        break;
    case 4:
        $dT0_19 = 0.34*($T-$Td)+2.89;
        //echo $dT0_19;
        break;
    case 3:
        $dT0_19 = 0.37*($T-$Td)+3.11;
        //echo $dT0_19;
        break;
    case 2:
        $dT0_19 = 0.41*($T-$Td)+3.23;
        //echo $dT0_19;
        break;
    case 1:
        $dT0_19 = 0.45*($T-$Td)+3.45;
        //echo $dT0_19;
        break;
    case 0:
        $dT0_19 = 0.49*($T-$Td)+4.04;
        //echo $dT0_19;
        break;
	}
    

    //определение поправочного множителя m
    $m = 1-(0.8*($Nl*0.1)+0.6*($Nm*0.1)+0.2*($Nh*0.1))*($Nl*0.1+$Nm*0.1+$Nh*0.1);
    //echo "<br>";
    //echo "m = ".$m;

    //понижение с учетом коэффициента 
    $dT_19 = $m*$dT0_19;
    //echo "<br>";
    //echo "dT = ".$dT_19;
   
    //минимальная температура 
    $Tmin_19 = $T-$dT_19;
    //echo "<br>";
    //echo "T19min = ".$Tmin_19;

    return $Tmin_19;

}

/* Определение минимальной температуры по данным за 13ч*/
function T13min($T,$Td,$V,$Nl,$Nm,$Nh) 
{

    $this->T = $T;
    $this->Td = $Td;
    $this->V = $V;
    $this->Nl = $Nl;
    $this->Nm = $Nm;
    $this->Nh = $Nh;

    //определение понижения температуры воздуха
    //echo "dT0_13 = ";
    switch ($V) {
    case 10:
        $dT0_13 = 0.25*($T-$Td)+2.5;
        //echo $dT0_13;
        break;
    case 9:
        $dT0_13 = 0.26*($T-$Td)+2.66;
        //echo $dT0_13;
        break;
    case 8:
        $dT0_13 = 0.26*($T-$Td)+3.12;
        //echo $dT0_13;
        break;
    case 7:
        $dT0_13 = 0.28*($T-$Td)+3.44;
        //echo $dT0_13;
        break;
    case 6:
        $dT0_13 = 0.3*($T-$Td)+3.75;
        //echo $dT0_13;
        break;
    case 5:
        $dT0_13 = 0.31*($T-$Td)+4.06;
        //echo $dT0_13;
        break;
    case 4:
        $dT0_13 = 0.34*($T-$Td)+4.38;
        //echo $dT0_13;
        break;
    case 3:
        $dT0_13 = 0.37*($T-$Td)+4.7;
        //echo $dT0_13;
        break;
    case 2:
        $dT0_13 = 0.41*($T-$Td)+5.0;
        //echo $dT0_13;
        break;
    case 1:
        $dT0_13 = 0.45*($T-$Td)+5.31;
        //echo $dT0_13;
        break;
    case 0:
        $dT0_13 = 0.5*($T-$Td)+5.94;
        //echo $dT0_13;
        break;
    }
    
    
    //определение поправочного множителя m
    $m = 1-(0.8*($Nl*0.1)+0.6*($Nm*0.1)+0.2*($Nh*0.1))*($Nl*0.1+$Nm*0.1+$Nh*0.1);
    //echo "<br>";
    //echo "m = ".$m;

    //понижение с учетом коэффициента 
    $dT_13 = $m*$dT0_13;
    //echo "<br>";
    //echo "dT = ".$dT_13;
   
    //минимальная температура 
    $Tmin_13 = $T-$dT_13;
    //echo "<br>";
    //echo "T13min = ".$Tmin_13;

    return $Tmin_13;

}

/* Определение температуры туманообразования */
function Tt($Td) 
{

	$Tt = 1.02*$Td-1.92;
	//echo "<br>";
    //echo "Tt = ".$Tt;
    return $Tt;

}

/* Прогноз тумана 
function FogZverevOld($T19min,$Tt) 
{
	
	if ($Tt > $Tmin) {$fog = 1;} else {$fog = 0;}
	echo "<br>";
    echo "Туман = ".$fog;

}
*/

/* Прогноз тумана */
function FogZverev($T,$Td,$V,$Nl,$Nm,$Nh) 
{
	
	$Tmin = $this->T19min($T,$Td,$V,$Nl,$Nm,$Nh);
	$Tt = $this->Tt($Td);
	if ($Tt > $Tmin) {$fog = 1;} else {$fog = 0;}
	return $fog;

}

/* Время возникновения тумана */
function HourFog($T,$Td,$V,$Nl,$Nm,$Nh,$tset,$trise) 
{
    $tset = round($tset);
    $trise = round($trise);
    $Tmin = $this->T19min($T,$Td,$V,$Nl,$Nm,$Nh);
    $Tt = $this->Tt($Td);
    $dT = $T-$Tmin;
    $dTt = $T-$Tt;
    $n = 0.711*pow($dTt/$dT,2)+0.29*$dTt/$dT;
    $HourFog = round($tset+(24-$tset+$trise)*$n);
    if ($HourFog>24) {$HourFog = $HourFog-24;}
    return $HourFog;
    
}

/* Видимость в тумане */
function VisibilityFog($T,$Td,$V,$Nl,$Nm,$Nh) 
{
    $Tmin = $this->T19min($T,$Td,$V,$Nl,$Nm,$Nh);
    if ($Td<0) {$c = 0.625*$Td*$Td+32.4*$Td+770;}
    else {$c = 2.25*$Td*$Td+31.5*$Td+770;}
    $VisibilityFog = round($c/(pow(10,0.03*$Td)*($Td-$Tmin))); 
     return $VisibilityFog;
    
}

/***************************************
	Метод Зверева (статья МЕТОДИКА СОВЕРШЕНСТВОВАНИЯ ПРОГНОЗА ОПАСНОГО ПРИРОДНОГО ЯВЛЕНИЯ, выборка 2006-2012гг, аэр.Воронеж, U=0,74, с учетом местной поправки U=0,80)
***************************************/

/* Определение относительной влажности */
function Humidity($T,$Td)
{

	$e = 6.1078*pow(10,7.63*$Td/(241.9+$Td));
	$E = 6.1078*pow(10,7.63*$T/(241.9+$T));
	$f = $e/$E*100;
	
	echo "<br>";
	echo "<br>";
    echo "e = ".$e;
    echo "<br>";
    echo "E = ".$E;
    echo "<br>";
    echo "f = ".$f."%";
	return $f;
}

}
 ?>