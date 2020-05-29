<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nilai/nilai_siswa.php</title>
    <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
</head>
<body>

<?php 
$nama = 'Fadhil';
$mapel = 'Matematika';
$nilai = 86;

// Dengan if A=86-100, B=76-<86, C=60-<75, D=31-<60, E=0-<31
if($nilai <= 30 ){
    $ket = 'Gagal';
    $pre= 'E';
}
elseif($nilai <= 60 ){
    $ket = 'Gagal';
    $pre= 'D';
}
elseif($nilai <= 75 ){
    $ket = 'Lulus';
    $pre= 'C';
}
elseif($nilai <= 87 ){
    $ket = 'Lulus';
    $pre= 'B';
}
elseif($nilai >= 86){
    $ket = 'Lulus';
    $pre= 'A';
}

// Dengan Switch Case A=Memuaskan, B=Bagus, C=Cukup, D=Kurang, E=Buruk
switch ($pre) {
    case 'A':
        $pred = 'Memuaskan';
        break;

    case 'B':
        $pred = 'Baik';
        break;

    case 'C':
        $pred = 'Cukup';
        break;
 
    case 'D':
        $pred = 'Kurang';
        break;        
    default:
        $pred = 'Buruk';
        break;
}
?>

<div class="content">
    <div class="title m-b-md">
        Hai, <?=$nama?>.<br/> 
        Nilai kamu di Mata pelajaran<br/>
        <?=$mapel?> <br/> 
        adalah <?=$nilai?>. 
    </div>
    anda <?=$ket?>, dengan predikat: <?=$pre?> ~ <?=$pred?>.          
</div>
</body>
</html>