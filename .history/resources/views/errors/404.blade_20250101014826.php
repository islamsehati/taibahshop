

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404 Error</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Lato|Russo+One');
    *,
    *:after,
    *:before {
        box-sizing: border-box;
    }
    body {
        padding: 0;
        margin: 0;
    }
    .container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        overflow: hidden;
    }
    
    //stars
    .container-star {
        background-image: linear-gradient(
            to bottom,
            #292256 0%,
            #8446cf 70%,
            #a871d6 100%
        );
        &:after {
            background: radial-gradient(
                ellipse at center,
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 0) 40%,
                rgba(15, 10, 38, 0.2) 100%
            );
            content: "";
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
        }
    }
    .star-1 {
        position: absolute;
        border-radius: 50%;
        background-color: #ffffff;
        animation: twinkle 5s infinite ease-in-out;
        &:after {
            height: 100%;
            width: 100%;
            transform: rotate(90deg);
            content: "";
            position: absolute;
            background-color: #fff;
            border-radius: 50%;
        }
        &:before {
            background: radial-gradient(
                ellipse at center,
                rgba(255, 255, 255, 0.5) 0%,
                rgba(255, 255, 255, 0) 60%,
                rgba(255, 255, 255, 0) 100%
            );
            position: absolute;
            border-radius: 50%;
            content: "";
            top: -20%;
            left: -50%;
        }
    }
    @for $i from 1 through (30) {
        $top: random(100)+vh;
        $left: random(100)+vw;
        $size: random(6) + 3px;
        .star-1:nth-of-type(#{$i}) {
            top: $top;
            left: $left;
            width: $size;
            height: $size/3;
            animation-delay: random(5) + s;
            &:before {
                width: $size *2;
                height: $size *2;
                top: -250%;
            }
        }
    }
    .star-2 {
        position: absolute;
        border-radius: 50%;
        background-color: #ffffff;
        animation: twinkle 5s infinite ease-in-out;
    }
    @for $i from 31 through (60) {
        $top: random(100)+vh;
        $left: random(100)+vw;
        $size: random(3) + 1px;
        .star-2:nth-of-type(#{$i}) {
            top: $top;
            left: $left;
            width: $size;
            height: $size;
            animation-delay: random(5) + s;
            &:before {
                width: $size *2;
                height: $size *2;
                top: -250%;
            }
        }
    }
    
    //text and moon
    .container-title {
        width: 600px;
        height: 450px;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        position: absolute;
        color: white;
        line-height: 1;
        font-weight: 700;
        text-align: center;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        display: flex;
    }
    .title > * {
        display: inline-block;
        font-size: 200px;
    }
    .number {
        text-shadow: 20px 20px 20px rgba(0, 0, 0, 0.2);
        padding: 0 0.2em;
        font-family: 'Russo One', sans-serif;
    }
    .subtitle {
        font-size: 25px;
        margin-top: 1.5em;
        font-family: "Lato", sans-serif;
        text-shadow: 4px 4px 4px rgba(0, 0, 0, 0.2);
    }
    button {
        font-size: 22px;
        margin-top: 1.5em;
        padding: 0.5em 1em;
        letter-spacing:1px;
        font-family: "Lato", sans-serif;
        color:white;
        background-color: transparent;
        border:0;
        cursor:pointer;
        z-index:999;
        border:2px solid white;
        border-radius: 5px;
        text-shadow: 4px 4px 4px rgba(0, 0, 0, 0.2);
        transition: opacity 0.2s ease;
        &:hover {
            opacity:0.7;
        }
        &:focus {
            outline:0;
        }
    }
    .moon {
        position: relative;
        border-radius: 50%;
        width: 160px;
        height: 160px;
        z-index: 2;
        background-color: #fff;
        box-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #fff, 0 0 40px #fff,
            0 0 70px #fff, 0 0 80px #fff, 0 0 100px #ff1177;
        animation: rotate 5s ease-in-out infinite;
        .face {
            top: 60%;
            left: 47%;
            position: absolute;
            .mouth {
                border-top-left-radius: 50%;
                border-bottom-right-radius: 50%;
                border-top-right-radius: 50%;
                background-color: #5c3191;
                width: 25px;
                height: 25px;
                position: absolute;
                animation: snore 5s ease-in-out infinite;
                transform: rotate(45deg);
                box-shadow: inset -4px -4px 4px rgba(0, 0, 0, 0.3);
            }
            .eyes {
                position: absolute;
                top: -30px;
                left: -30px;
                .eye-left,
                .eye-right {
                    border: 4px solid #5c3191;
                    width: 30px;
                    height: 15px;
                    border-bottom-left-radius: 100px;
                    border-bottom-right-radius: 100px;
                    border-top: 0;
                    position: absolute;
                    &:before,
                    &:after {
                        content: "";
                        position: absolute;
                        border-radius: 50%;
                        width: 4px;
                        height: 4px;
                        background-color: #5c3191;
                        top: -2px;
                        left: -4px;
                    }
                    &:after {
                        left: auto;
                        right: -4px;
                    }
                }
                .eye-right {
                    left: 50px;
                }
            }
        }
    }
    
    //birds
    .container-bird {
        perspective: 2000px;
        width:100%;
        height:100%;
        position: absolute;
        top:0;
        left:0;
        bottom:0;
        right:0;
    }
    .bird {
        position: absolute;
        z-index: 1000;
        left: 50%;
        top: 50%;
        height: 40px;
        width: 50px;
        transform: translate3d(-100vw, 0, 0) rotateY(90deg);
        transform-style: preserve-3d;
    
    }
    .bird-container {
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        transform-style: preserve-3d;
        transform: translate3d(50px, 30px, -300px);
    }
    .wing {
        position: absolute;
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
        border-radius: 3px;
        transform-style: preserve-3d;
        transform-origin: center bottom;
        z-index: 300;
    }
    .wing-left {
        background: linear-gradient(to bottom, #a58dc4 0%, #7979a8 100%);
        transform: translate3d(0, 0, 0) rotateX(-30deg);
        animation: wingLeft 1.3s cubic-bezier(0.45, 0, 0.50, 0.95) infinite;
    }
    .wing-right {
        background: linear-gradient(to bottom, #d9d3e2 0%, #b8a5d1 100%);
        transform: translate3d(0, 0, 0) rotateX(-30deg);
        animation: wingRight 1.3s cubic-bezier(0.45, 0, 0.50, 0.95) infinite;
    }
    .wing-right-top,
    .wing-left-top {
        border-right: 25px solid transparent;
        border-left: 25px solid transparent;
        top: -20px;
        width: 100%;
        position: absolute;
        transform-origin: 100% 100%;
    }
    .wing-right-top {
        border-bottom: 20px solid #b8a5d1;
        transform: translate3d(0, 0, 0) rotateX(60deg);
        animation: wingRightTop 1.3s cubic-bezier(0.45, 0, 0.50, 0.95) infinite;
    }
    .wing-left-top {
        border-bottom: 20px solid #7979a8;
        transform: translate3d(0, 0, 0) rotateX(-60deg);
        animation: wingLeftTop 1.3s cubic-bezier(0.45, 0, 0.50, 0.95) infinite;
    }
    .bird-anim:nth-child(1) {
        animation: bird1 30s linear infinite forwards;
    }
    .bird-anim:nth-child(2) {
        animation: bird2 30s linear infinite forwards;
        animation-delay: 3s;
        z-index:-1;
    }
    .bird-anim:nth-child(3) {
        animation: bird3 30s linear infinite forwards;
        animation-delay: 5s;
    }
    .bird-anim:nth-child(4) {
        animation: bird4 30s linear infinite forwards;
        animation-delay: 7s;
    }
    .bird-anim:nth-child(5) {
        animation: bird5 30s linear infinite forwards;
        animation-delay: 14s;
    }
    .bird-anim:nth-child(6) {
        animation: bird6 30s linear infinite forwards;
        animation-delay: 10s;
        z-index:-1;
    }
    
    //keyframes
    @keyframes rotate {
        0%, 100%{
            transform: rotate(-8deg);
        }
        50% {
            transform: rotate(0deg);
        }
    }
    
    @keyframes snore {
        0%, 100% {
            transform: scale(1) rotate(30deg);
        }
        50% {
            transform: scale(0.5) rotate(30deg);
            border-bottom-left-radius: 50%;
        }
    }
    
    @keyframes twinkle {
        0%, 100% {
            opacity: 0.7;
        }
        50% {
            opacity: 0.3;
        }
    }
    
    @keyframes wingLeft {
        0%, 100% {
            transform: translate3d(0, 0, 0) rotateX(-50deg);
        }
        50% {
            transform: translate3d(0, -20px, 0) rotateX(-130deg);
                background: linear-gradient(to bottom, #d9d3e2 0%, #b8a5d1 100%);
        }
    }
    
    @keyframes wingLeftTop {
        0%, 100% {
            transform: translate3d(0, 0, 0) rotateX(-10deg);
        }
        50% {
            transform: translate3d(0px, 0px, 0) rotateX(-40deg);
            border-bottom: 20px solid #b8a5d1;
        }
    }
    
    @keyframes wingRight {
        0%, 100% {
            transform: translate3d(0, 0, 0) rotateX(50deg);
        }
        50% {
            transform: translate3d(0, -20px, 0) rotateX(130deg);
                background: linear-gradient(to bottom, #a58dc4 0%, #7979a8 100%);
        }
    }
    
    @keyframes wingRightTop {
        0%, 100% {
            transform: translate3d(0, 0, 0) rotateX(10deg);
        }
        50% {
            transform: translate3d(0px, 0px, 0px) rotateX(40deg);
            border-bottom: 20px solid #7979a8;
        }
    }
    
    @keyframes bird1 {
        0% {
            transform: translate3d(-120vw, -20px, -1000px) rotateY(-40deg) rotateX(0deg);
        }
        100% {
            transform: translate3d(100vw, -40vh, 1000px) rotateY(-40deg) rotateX(0deg);
        }
    }
    
    @keyframes bird2 {
        0%,
        15% {
            transform: translate3d(100vw, -300px, -1000px) rotateY(10deg) rotateX(0deg);
        }
        100% {
            transform: translate3d(-100vw, -20px, -1000px) rotateY(10deg) rotateX(0deg);
        }
    }
    
    @keyframes bird3 {
        0% {
            transform: translate3d(100vw, -50vh, 100px) rotateY(-5deg) rotateX(-20deg);
        }
        100% {
            transform: translate3d(-100vw, -10vh, 100px) rotateY(-5deg) rotateX(-20deg);
        }
    }
    
    @keyframes bird4 {
        0% {
            transform: translate3d(100vw, 30vh, 200px) rotateY(-5deg) rotateX(10deg);
        }
        100% {
            transform: translate3d(-100vw, -30vh, 200px) rotateY(-5deg) rotateX(10deg);
        }
    }
    
    @keyframes bird5 {
        0%,
        5% {
            transform: translate3d(100vw, 30vh, 400px) rotateY(-15deg) rotateX(-10deg);
        }
        100% {
            transform: translate3d(-100vw, 10vh, 400px) rotateY(-15deg) rotateX(-10deg);
        }
    }
    
    @keyframes bird6 {
        0%, 10% {
            transform: translate3d(-100vw, 20vh, -500px) rotateY(15deg) rotateX(10deg)
        }
        100% {
            transform: translate3d(100vw, 40vh, -800px) rotateY(5deg) rotateX(10deg)
        }
    }
    @media screen and (max-width: 580px) {
        .container-404 {
            width:100%;
        }
        .number {
            font-size:100px;
        }
        .subtitle {
    font-size:20px;
            padding: 0 1em;
        }
        .moon {
        width: 100px;
            height: 100px;
        }
        .face {
            transform: scale(0.7)
        }
    }
    
    
    </style>
</head>
<body>
    
    .container.container-star
	- for (var i = 1; i <= 30; i++)
		.star-1
	- for (var i = 1; i <= 30; i++)
		.star-2
.container.container-bird
	- for (var i = 1; i <= 6; i++)
		.bird.bird-anim
			.bird-container
				.wing.wing-left
					.wing-left-top
				.wing.wing-right
					.wing-right-top
	.container-title
		.title
			.number 4
			.moon
				.face
					.mouth
					.eyes
						.eye-left
						.eye-right
			.number 4
		.subtitle Oops. Looks like you took a wrong turn.
		button Go back

    
</body>
</html>

