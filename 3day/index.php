<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=d, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $greetings = "<h1>hello</h1>";
    $name = "홍길동";

    echo $name . $greetings;

    $a = 100;
    $b = 6;
    echo "<br>";
    echo $a % $b;
    echo "<br>";
    $sum = 0;
    $sum2 = 0;
    for($i=1;$i<=100;$i++){
        if(($i % 2) === 0){
            $sum += $i; 
        } else {
            $sum2 += $i;
        }
    }
    echo $sum;
    ?>
</body>
</html>
