<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    </head>
    <body>
        <div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
            @if(!session()->has('access_token'))
                <form method="post" action="/authorize">
                    {{ csrf_field() }}
                    <button type="submit" style="background-color: #32ada1; color: white; padding: 10px 20px; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">
                        Login With Pelcro
                    </button>
                </form>
            @else
                <a href="/customers" style="padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px; font-family: Arial, sans-serif; font-size: 16px;">Get Customers</a>
            @endif
        </div>
    </body>
</html>
