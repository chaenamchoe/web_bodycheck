<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel='stylesheet' href='<?= base_url()?>/public/css/fabric.css'>
        <script src="<?= base_url()?>/public/js/fabric.min.js"></script>
</head>
<body>
    <canvas id="canvas"></canvas>
    <div id="shapes-container">
        <div class='shape-btn' id="line-btn"></div>
        <div class='shape-btn' id="single-arrow-head-line-btn"></div>
        <div class='shape-btn' id="double-arrow-head-line-btn"></div>
    </div>
    <button id='deactivate-adding-shape-btn'>Deactivate</button>
    <div id='length-angle-container'>
        <span id='length-of-line'>1024</span>
        <span>px</span>
        <span id='angle-of-line'>280</span>
        <span>°</span>
    </div>
    <script src="<?= base_url()?>/public/js/arrow_line.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>