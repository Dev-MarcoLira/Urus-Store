<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sofia+Sans:wght@200&family=Source+Sans+Pro:wght@200&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oops...</title>
    <style>
        *{
overflow: hidden;
margin: 0;
padding: 0;
border: 0;
box-sizing: border-box;

}
button
{   
    font-family:  'Sofia Sans';
    background-color: #0C8BFF ;
    border-radius: 13px;
    border: none;
    font-size: 24px;
    margin: 10px 0;
    padding: 10px;
    color: white;
    cursor: pointer;
    
    
   

}
button:hover
{
    background-color: #035db1;
}
div#pau {
    font-family: 'Sofia Sans';
    border-style: solid;
    border-width: 2px;
    border-radius: 5px;
    color: aliceblue;
    border-color: #2d1d5c;
    background-color: #2d1d5c;
    margin-top: 10%;
    margin-right: 25%;
    margin-left: 25%;
}
div#cu {
    color: aliceblue;
    margin: 10% 10%;
    text-align: center;
}
h3{
    margin-bottom: 5%;
}
h4 {
    margin-top: 5%;
    margin-bottom: 5%;
    margin-left: 60%;
}
body, html{

width: 100vw;

background-color: #03030D;

}
    </style>
</head>
<body>
    <div id="pau">
    <div id="cu">
   <h3>Sem Spoilers</h3>
   <div id="txt1">Esta parte do portal ainda está em desenvolvimento,</div>
   <div id="txt2">Por favor retorne à página de produtos.</div>
   <h4>-Urus</h4>
    <a href="<?php echo FULL_PATH_SITE; ?>"><button>Retornar ao Portal</button></a>
   </div>
   </div>
</body>
</html>