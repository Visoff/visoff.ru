<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1, initial-scale=1.0">
    <title>Aboba</title>
    <script>
        window.chatToken = "<?php print_r($_GET['token']); ?>";
        window.tag = '<plate scrollXleft style="left: -100vw;"><iframe src="https://visoff.ru/xakaton/chats/" frameborder="0" onload="this.style = '+"'"+"width:"+"'"+ '+this.contentWindow.document.body.scrollWidth+'+"'"+"px;"+"'"+'"></iframe></plate>'
    </script>
    <script src="../api/scroll.js"></script>
    <link rel="stylesheet" href="../api/scroll.css">
    <script src="../api/back.js"></script>
    <script src="../api/social.js"></script>
    <style>
        body {
              background: #A6A9C8;
        }
        *{ color: rgb(0, 0, 0);}
        span {font-size: 1.3rem;}

        message {
            background-color: #d9d9d9;

            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 30px;
            max-width: 80vw;
            min-height: 2.18rem;
            height: max-content;
            padding: 0 1rem;
            width: fit-content;
        }

        message.your {
            justify-self: end;
            background-color: #009CF3;
        }

        message video {
            aspect-ratio: 1 / 1;
            width: 70vw;
            margin: .5rem;
            float:right;
            border-radius: 50%;
        }

        img {width: 100%; height: 100%;}

        *[hidden] {
            display:none !important;
        }

        .send.hidden, .camera.hidden {
            animation: hide;
            display: none;
        }
        .send, .camera {
            animation: show .2s;
        }
        @keyframes show {
            0% {display: none; opacity: 0;}
            1% {display: block; opacity: 0;}
            100% {opacity: 1;}
        }
        @keyframes hide {
            0% {display: block; opacity: 1;}
            99% {opacity: 0;}
            100% {display: none; opacity: 0;}
        }
        img.camera:active ~ div.circleMedia {
            display: flex !important;
        }
        img.camera:active + div {
            display:block !important;
        }
        svg.timeout {
            width:calc(100% - 3px); height:calc(100% - 3px); stroke-dasharray:500; stroke-dashoffset:0; transition: stroke-dashoffset 10s;
        }
       </style>
       
    <script>
        themeNum = 0
        themeSellector = "header"
    </script>
    <script src="../api/CustomUI.js"></script>
</head>
<body style="display: flex; flex-direction: column; height: 100vh; overflow-y: hidden;" onload="load(); Social.GenerateMessages(chatToken); document.querySelector('messageArray').parentElement.scrollTo(0, 10**5);">
    <header style="margin-top: 1.9rem; display: grid; grid-auto-flow: column; place-items: center; justify-content: space-around; align-items: center;"><img style="width:2.1rem; height:1.3rem; transform: rotateZ(-90deg);" onclick="OpenMenu()" src="../icon/ArrowUp.svg"><div style="height: 2.3rem; display: grid; align-items: center; grid-auto-flow: column; gap: 2.5rem;"><div style="background-color:white; height:2.2rem; aspect-ratio: 1/1; border-radius:50%;"></div><span class="name" style="font-size: 1.3rem; color:#796EA8;"></span></div><div style="width: 3rem;"></div></header>
<div style="flex-grow:1; overflow-y: scroll;">
    <messageArray style="display: grid ;grid-auto-flow: row;gap: 1.25rem; padding: 0.5rem 0.2rem; overflow-x:hidden"><div></div></messageArray>
</div>
    <div style="margin: 1rem 0;display: flex; width: calc(100% - 1rem); left: 0;padding: 0 0.5rem;">
    <div style="height: 2.2rem;aspect-ratio: 1/1;"><img src="../icon/smile.svg" alt="" srcset=""></div>
    <div style="height: 2.2rem; flex-grow: 1; background-color: #d9d9d9;border-radius: 30px;display: flex;align-items: center;margin: 0 0.5rem;">
        <form onsubmit="Social.send(); return false;" style="flex-grow:1;height:100%;border-radius:30px;border: none;"><input oninput="if (this.value == '') {document.querySelector('.camera').classList.remove('hidden'); document.querySelector('.send').classList.add('hidden')} else {document.querySelector('.camera').classList.add('hidden'); document.querySelector('.send').classList.remove('hidden')}" type="text" placeholder="text.."style="width:calc(100% - 0.5rem);padding: 0; padding-left: 0.5rem;height:100%;border:none;border-radius:30px;background-color:#554D74"></form>
    </div>
    <div onclick="Social.send()" class="send hidden" style="height: 2.2rem;aspect-ratio: 1/1; overflow-y: visible;"><img src="../icon/go.svg"></div>
    <div onclick="/*startRecording()*/" class="camera" style="height: 2.2rem;aspect-ratio: 1/1; overflow-y: visible;">
        <img class="camera" src="../icon/camera.svg">

        <div style="display:none; width:3rem; height:3rem; position:absolute; bottom:.2rem; right:.5rem;">
            <div style="background-color:aqua; width:100%; aspect-ratio:1/1; border-radius:50%;"></div>
        </div>
    
        <div class="circleMedia" style="position:fixed; left:50%; top:50%; transform: translate(-50%, -50%); max-width:95vw; width:fit-content; aspect-ratio: 1/1; display:none; place-items:center; justify-content:center;">
            <div style="width:100%; height:100%; position:absolute; display:grid; place-items:center;">
                <svg class="timeout" width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="50" cy="50" r="48.5" stroke="white" stroke-width="3"/>
                </svg>
            </div>
            <div style="width: calc(100% - 7px); height: calc(100% - 7px); border-radius:50%; overflow:hidden; display:flex; place-items:center;">
                <video autoplay="true" muted="true" style="min-height:100%; min-width:100%;">
            </div>
        </div>
    </div>
    </div>
</body>
<script>
    circleRec = undefined
    setInterval(() => {
        Social.GenerateMessages(chatToken)
        var vids = document.querySelectorAll("message video")
        var height = document.querySelector("messageArray").getBoundingClientRect().bottom
        for (var i = 0; i < vids.length; i++) {
            if (vids[i].getBoundingClientRect().top >= 0 && vids[i].getBoundingClientRect().bottom <= height) {
                try {vids[i].play(); vids[i].onclick = function() {this.muted = false}} catch (e) {}
            }
        }
        if (document.querySelectorAll("img.camera + div:active").length > 0 && circleRec == undefined) {
            document.querySelector("svg.timeout").style = "strokeDashoffset: 500 !important;"
            startRecording()
        }
        if (document.querySelectorAll("img.camera + div:active").length == 0 && circleRec != undefined && !locked) {
            stopRecording()
        }
    }, 500);
    navigator.getUserMedia({video:{aspectRatio:1}, audio:true}, function (stream) {
            var video = document.querySelector(".circleMedia video")
            video.srcObject = stream}, () => {})
    function startRecording() {
        circleRec = 1
        navigator.getUserMedia({video:{aspectRatio:1}, audio:true}, function (stream) {
            circleRec = new MediaRecorder(stream)
            circleFile = []
            circleRec.ondataavailable = function(e) {
                circleFile.push(e.data)
            }
            circleRec.start(1000/60)
            var video = document.querySelector(".circleMedia video")
            video.srcObject = stream
            var add = ""
            if (video.videoWidth > video.videoHeight) {add = "width:100%;"} else {add = "height:100%;"}
            video.style = "position:relative; top:50%; left:50%; transform:translate(-50%, -50%);"+add
        }, (e) => {alert("error")})
    }
    function stopRecording() {
        if (circleFile.length < 10) {return}
        circleRec.stop()
        circleRec = undefined
        circleFile = new File(circleFile, "circle", {type:"video/mp4"})
        document.querySelector(".circleMedia video").srcObject = undefined
        document.querySelector(".circleMedia video").src = URL.createObjectURL(circleFile)
        var req = new XMLHttpRequest()
        req.open("POST", "saveFile.php", false)
        var form = new FormData()
        form.append("file", circleFile)
        form.append("data", JSON.stringify({author:localStorage.getItem("f.token"), toUser:chatToken}))
        req.send(form)
    }
</script>

</html>