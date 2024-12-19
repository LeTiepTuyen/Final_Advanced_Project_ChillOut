<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <!-- Import Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* CSS Styles */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Orbitron', sans-serif;
            height: 100vh;
            background-image: linear-gradient(to top, #2e1753, #1f1746, #131537, #0d1028, #050819);
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .text {
            position: absolute;
            top: 15%;
            color: #fff;
            text-align: center;
        }

        .text div:first-child {
            font-size: 2.5rem;
            font-weight: 400;
            margin-bottom: 10px;
        }

        h1 {
            font-size: 6rem;
            /* Giảm kích thước chữ "404" */
            font-weight: 700;
            margin: 10px 0;
        }

        hr {
            border: none;
            border-top: 2px solid #fff;
            width: 100px;
            margin: 20px auto;
        }

        .text div:last-child {
            font-size: 2rem;
            font-weight: 400;
        }

        .astronaut img {
            width: 120px;
            position: absolute;
            top: 60%;
            animation: astronautFly 6s infinite linear;
        }

        .back-home {
            position: absolute;
            bottom: 10%;
            left: 50%;
            transform: translateX(-50%);
            background: transparent;
            color: #fff;
            border: 2px solid #fff;
            border-radius: 20px;
            padding: 10px 20px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .back-home:hover {
            background: #fff;
            color: #000;
        }

        .star {
            position: absolute;
            width: 2px;
            height: 2px;
            background: #fff;
            right: 0;
            animation: starTwinkle 3s infinite linear;
        }

        @keyframes astronautFly {
            0% {
                left: -100px;
            }

            25% {
                top: 55%;
                transform: rotate(30deg);
            }

            50% {
                transform: rotate(45deg);
                top: 60%;
            }

            75% {
                top: 65%;
                transform: rotate(30deg);
            }

            100% {
                left: 110%;
                transform: rotate(45deg);
            }
        }

        @keyframes starTwinkle {
            0% {
                background: rgba(255, 255, 255, 0.4);
            }

            25% {
                background: rgba(255, 255, 255, 0.8);
            }

            50% {
                background: rgba(255, 255, 255, 1);
            }

            75% {
                background: rgba(255, 255, 255, 0.8);
            }

            100% {
                background: rgba(255, 255, 255, 0.4);
            }
        }
    </style>
</head>

<body>
    <!-- Text Content -->
    <div class="text">
        <div>ERROR</div>
        <h1>404</h1>
        <hr>
        <div>Page Not Found</div>
    </div>

    <!-- Astronaut -->
    <div class="astronaut">
        <img src="https://images.vexels.com/media/users/3/152639/isolated/preview/506b575739e90613428cdb399175e2c8-space-astronaut-cartoon-by-vexels.png"
            alt="Astronaut">
    </div>

    <!-- Back to Home Button -->
    <button class="back-home" onclick="window.location.href='{{ url('/') }}'">Back to Home</button>

    <!-- JavaScript -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var body = document.body;

            setInterval(createStar, 100);

            function createStar() {
                var right = Math.random() * 500;
                var top = Math.random() * screen.height;
                var star = document.createElement("div");

                star.classList.add("star");
                body.appendChild(star);

                setInterval(runStar, 10);

                star.style.top = top + "px";

                function runStar() {
                    if (right >= screen.width) {
                        star.remove();
                    }
                    right += 3;
                    star.style.right = right + "px";
                }
            }
        });
    </script>
</body>

</html>