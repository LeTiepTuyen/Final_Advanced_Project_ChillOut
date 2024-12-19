<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Server Error</title>
    <style>
        body {
            background-color: rgb(51, 51, 51);
            margin: 0;
            padding: 0;
            width: 100vw;
            height: 100vh;
            color: white;
            font-family: 'Arial Black', sans-serif;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .error-container {
            text-align: center;
        }

        .error-row {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .error-num {
            font-size: 8em;
            margin: 0;
        }

        .eye {
            background: #fff;
            border-radius: 50%;
            display: inline-block;
            height: 120px;
            width: 120px;
            position: relative;
            margin: 0 5px;
        }

        .pupil {
            background: #000;
            border-radius: 50%;
            content: '';
            height: 40px;
            width: 40px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            transition: transform 0.1s ease-out;
        }

        .sub-text {
            margin-top: 1em;
            margin-bottom: 2em;
            font-size: 1.2em;
        }

        a {
            color: white;
            text-decoration: none;
            text-transform: uppercase;
            border: 2px solid white;
            padding: 0.5em 1em;
            border-radius: 5px;
            transition: color 0.3s, background-color 0.3s;
        }

        a:hover {
            color: rgb(51, 51, 51);
            background-color: white;
        }
    </style>
</head>

<body>
    <div class="error-container">
        <div class="error-row">
            <span class="error-num">5</span>
            <div class="eye">
                <div class="pupil"></div>
            </div>
            <div class="eye">
                <div class="pupil"></div>
            </div>
        </div>
        <p class="sub-text">Oh eyeballs! Something went wrong. We're <i>looking</i> to see what happened.</p>
        <a href="{{ url('/') }}">Go Back</a>
    </div>

    <script>
        document.addEventListener('mousemove', function(event) {
            const eyes = document.querySelectorAll('.eye');
            eyes.forEach(eye => {
                const pupil = eye.querySelector('.pupil');
                const rect = eye.getBoundingClientRect();
                const x = rect.left + rect.width / 2;
                const y = rect.top + rect.height / 2;
                const angleX = (event.clientX - x) / 20; // Điều chỉnh chuyển động theo trục X
                const angleY = (event.clientY - y) / 20; // Điều chỉnh chuyển động theo trục Y
                pupil.style.transform = `translate(calc(-50% + ${angleX}px), calc(-50% + ${angleY}px))`;
            });
        });
    </script>
</body>

</html>