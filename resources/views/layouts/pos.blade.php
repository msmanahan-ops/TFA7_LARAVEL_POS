<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Laravel POS')</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: #f3f6f4;
            color: #24362c;
            font-family: Arial, sans-serif;
        }

        nav {
            background: #174b35;
            padding: 20px;
        }

        nav a {
            display: inline-block;
            color: white;
            text-decoration: none;
            margin: 5px 20px 5px 0;
        }

        main {
            max-width: 1100px;
            margin: 30px auto;
            background: white;
            padding: 28px;
            border-radius: 12px;
        }

        h1 { color: #174b35; }

        label {
            display: block;
            margin-top: 18px;
            font-weight: bold;
        }

        input, textarea {
            width: 100%;
            padding: 11px;
            margin-top: 7px;
            border: 1px solid #adb9b0;
            border-radius: 5px;
        }

        button, .button {
            display: inline-block;
            background: #174b35;
            color: white;
            padding: 12px 18px;
            border: 0;
            border-radius: 5px;
            text-decoration: none;
            margin: 18px 10px 10px 0;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            text-align: left;
            padding: 13px;
            border-bottom: 1px solid #dce3de;
        }

        th { background: #edf4ef; }

        .table-wrap { overflow-x: auto; }
        .error { color: #b42318; margin-top: 6px; }
        .success { padding: 15px; background: #dff3e5; }
        .errors { padding: 15px; background: #ffebe8; }
        .hint { color: #59675f; font-size: 14px; }

        .avatar {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            object-fit: cover;
        }

        @media (max-width: 700px) {
            main { margin: 12px; padding: 18px; }
        }
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('home') }}">Laravel POS</a>
        <a href="{{ route('customers.index') }}">Customers</a>
        <a href="{{ route('users.index') }}">User Accounts</a>
    </nav>

    <main>
        @if (session('success'))
            <div class="success" role="status">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="errors" role="alert">
                <strong>Please correct the following:</strong>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>