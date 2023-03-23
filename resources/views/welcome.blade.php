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




    </body>
</html>
