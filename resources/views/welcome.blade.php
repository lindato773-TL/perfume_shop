<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Flowers · Enter the house</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=DM+Sans:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        .welcome-page {
            min-height: 100vh;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, #fff 0%, #fdf1f3 55%, #f5dfe4 100%);
            padding: 1.5rem;
            position: relative;
            overflow: hidden
        }

        .welcome-page:before,
        .welcome-page:after {
            content: '';
            position: absolute;
            border: 1px solid rgba(183, 110, 121, .2);
            border-radius: 50%;
            width: 28rem;
            height: 28rem
        }

        .welcome-page:before {
            left: -14rem;
            top: -12rem
        }

        .welcome-page:after {
            right: -14rem;
            bottom: -14rem
        }

        .welcome-card {
            position: relative;
            z-index: 1;
            max-width: 540px;
            text-align: center;
            background: rgba(255, 255, 255, .8);
            border: 1px solid rgba(234, 223, 217, .9);
            padding: 4.5rem 3rem;
            box-shadow: 0 25px 70px rgba(90, 60, 50, .1)
        }

        .welcome-mark {
            width: 3.5rem;
            height: 3.5rem;
            margin: 0 auto 2rem;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background: var(--rose);
            color: #fff;
            font: 600 2rem 'Cormorant Garamond', serif
        }

        .welcome-card h1 {
            font-size: clamp(3rem, 7vw, 5.5rem);
            line-height: .95;
            margin: 1rem 0
        }

        .welcome-card p {
            color: var(--muted);
            max-width: 370px;
            margin: 0 auto 2rem;
            line-height: 1.7
        }

        .welcome-actions {
            display: flex;
            justify-content: center;
            gap: .75rem
        }

        .welcome-actions .btn {
            min-width: 130px;
            padding: .75rem 1.2rem
        }

        .welcome-card small {
            display: block;
            color: var(--muted);
            margin-top: 2rem
        }

        @media(max-width:575px) {
            .welcome-card {
                padding: 3rem 1.5rem
            }

            .welcome-card h1 {
                font-size: 3.4rem
            }
        }
    </style>
</head>

<body class="welcome-page">
    <main class="welcome-card">
        <div class="welcome-mark">F</div>
        <span class="eyebrow">The house of Flowers smell</span>
        <h1>Beauty, softly considered.</h1>
        <p>Discover your favorite scents.</p>
        <div class="welcome-actions">
            <a class="btn btn-rose btn-sm-round" href="{{ route('login') }}">Log in</a>
            <a class="btn btn-outline-rose btn-sm-round" href="{{ route('register') }}">Register</a>
        </div>
        <small>Enter the house to explore the collection.</small>
    </main>
</body>

</html>
