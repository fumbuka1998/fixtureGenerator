<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        

        <style>
            *{
                padding: 0;
                margin: 0;
                font-family: sans-serif;
                box-sizing: border-box;
            }
            #container{
                height: 100vh;
                width: 100%;
                position: relative;
                top: 0;
                left: 0;
                background: #e9e9e9
            }
            #container #logo{
                position:absolute;
                left: 8%;
                top: 30px;
                font-size: 30px;
                font-weight: bold;
                z-index: 997;
                color: rgb(33, 33, 80)

            }
            #navbar{
                height: 90px;
                width: 100%;
                position:absolute;
                top: 0;
                left: 0;
                background: rgb(248, 247, 246);
                display: grid;
                place-items: center;
            }
            #navbar ul{
                list-style: none;
                display: flex;
                flex-direction: row;
            }
            #navbar ul li{
                font-size: 20px;
                margin: 0 45px;
            }
            #navbar ul a{
                text-decoration: none;
                color: rgb(247, 243, 243);
                position: absolute;
                top: 30px;
                right: 15px;
                display: grid;
                place-items: center;
                background: rgb(42, 29, 100);
                border-radius: 50px 15px;

            }
            #nav ul li:hover{
                color: blue;
            }
            #navbar ul #register{
                right: 75px;
            }
            #navbar ul #login,#register:hover{
                background: rgb(54, 41, 41);
            }
            #image{
                position: absolute;
                top: calc(50% - 300px);
                right: 10%;
                z-index: 999;

            }

            #image img{
                height: 600px;
                filter: drop-shadow(-140px -140px 5px rgba(0, 0, 0,0.5));
                transition: 0.5s;
            }
            #image img:hover{
                filter: drop-shadow(0px 0px 5px rgba(0, 0, 0,0.5));
            }

            #content{
                position: absolute;
                top:30%;
                left: 10%;
                z-index: 996;  
            }
            #content h2{
                font-size: 300px;
                color: #313286;
            }
            #content h2:hover{
                color: #030211;
                transition: 0.5s;
            }

            #content h4{
                font-size: 70px;

            }
            #content h4:hover{
                color: #1e1764;
            }


        </style>
    </head>
    <body >
        {{-- <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div> --}}

        <div id="container">
            {{-- logo appear below --}}
            <div id="logo">FixtureGen</div>

            {{-- nav bar --}}
            <div id="navbar">
               <ul>
                <li><a href="{{ route('login') }}" id="login">Login</a></li>
                <li><a href="{{ route('register') }}" id="register">Register</a></li>
               </ul>
            </div>
        </div>

        {{-- image --}}
        <div id="image">
            {{-- <img src="../../assets/images/12.png" alt="" > --}}
            {{-- <img src="../../assets/images/myplayer.png" alt="" > --}}
            <img src="../../assets/images/15.png" alt="" >
        </div>

        {{-- details --}}
        <div id="content">
            <h2>FIXTURE</h2>
            <h4>GENERATOR</h4>
        </div>


    </body>
</html>
