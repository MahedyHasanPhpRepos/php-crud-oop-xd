<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        * {
            margin: 0;
            padding: 0;
            outline: 0;
            box-sizing: border-box;
        }

        img {
            border: 0;
            width: 100%;
        }

        ul,
        li {
            list-style: none;
        }

        .required_label{
            position: relative;
        }
        .required_label::after{
            position: absolute;
            content: "*";
            color: red ;
            top : 0 ; 
            right : -10px ; 
        }
        .error{
            color: red ;
        }

    </style>

</head>

<body>