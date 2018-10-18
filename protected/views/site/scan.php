<!--show pc-->
<html>
<head>
    <title>“眉”问题，我“型”</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimum-scale=1.0,maximum-scale=1.0,minimal-ui" />
    <meta name="Keywords" content="Benefit">
    <meta name="Description" content="Benefit">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css">
        *{
            padding: 0;
            margin: 0;
        }
        .wrapper{
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;left: 0;
        }
        img{
            /*display: block;*/
            width: 100%;
        }
        body{
            background: #f6bcba;
        }
        /*for pc*/
        @media screen and (min-width: 1024px) {
            .show-pc{
                display: block;
                position: absolute;
                width: 100%;
                height: 100%;
                background: url("/images/201601scan/pc.jpg") no-repeat;
                background-size: auto 100%;
                max-width: 1920px;
                background-position: 50% 50%;
            }
            .show-mobile{
                display: none;
            }
        }
        /*for mobile*/
        @media screen and (max-width: 1023px) {
            .wrapper{
                display:block ;
                background: url("/images/201601scan/mobile-bg.jpg") no-repeat;
                background-size: 100% 100%;
            }
            .show-pc{
                display: none;
            }
            .show-mobile{
                position: absolute;
                top: 50%;
                -webkit-transform: translateY(-50%);
                -moz-transform: translateY(-50%);
                -o-transform: translateY(-50%);
                transform: translateY(-50%);
            }
        }


    </style>
</head>
<body>
<div class="wrapper">
    <!-- for pc-->
    <div class="show-pc">

    </div>
    <div class="show-mobile">
        <img src="/images/201601scan/m.png" alt=""/>
    </div>
</div>

</body>
</html>
