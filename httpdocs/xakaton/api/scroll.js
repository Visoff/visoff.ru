load = function() {
    if (window.tag == undefined) {
        var tag = '<plate scrollXleft style="left: -100vw;"><iframe src="https://visoff.ru/xakaton/profile/index.html" frameborder="0" onload="this.style = '+"'"+"width:"+"'"+ '+this.contentWindow.document.body.scrollWidth+'+"'"+"px;"+"'"+'"></iframe></plate>'
    } else {
        var tag = window.tag
    }
    document.body.innerHTML += tag
    startmousePos = []
    mousePos = []
    var scrollX = document.querySelectorAll("[scrollXleft]")
    var scrollY = document.querySelectorAll("[scrollYbottom]")
    window.onmousedown = window.ontouchstart = function() {
        startmousePos = [event.pageX, event.pageY]
        if (!!event.touches) {startmousePos = [event.touches[0].pageX, event.touches[0].pageY]}
        if (scrollable(event.target)) {startmousePos = [0, 0]}
    }
    window.onmousemove = window.ontouchmove = function() {
        if ((event.buttons == 1 || !!event.touches)&&(startmousePos[0] != 0 || startmousePos[1] != 0)) {
            if (event.target.tagName == "IMG") {return}
            mousePos = [event.pageX, event.pageY]
            if (!!event.touches) {mousePos = [event.touches[0].pageX, event.touches[0].pageY]}
            window.mouseDirectionX = (mousePos[0]-startmousePos[0])
            window.mouseDirectionY = (mousePos[1]-startmousePos[1])
            if (Math.abs(window.mouseDirectionX) > Math.abs(window.mouseDirectionY)) {
                for (var i = 0; i < scrollX.length; i++) {
                    scrollX[i].style = "left:-"+Math.min(Math.max(scrollX[i].clientWidth-mouseDirectionX, 0), scrollX[i].clientWidth)+"px"
                }
            } else {
                for (var i = 0; i < scrollY.length; i++) {
                    scrollY[i].style = "bottom:-"+Math.min(Math.max(scrollY[i].clientHeight+mouseDirectionY, 0), scrollY[i].clientHeight)+"px"
                }
            }
        }
    }
    window.onmouseup = window.ontouchend = function() {
        if (startmousePos[0] == 0 && startmousePos[1] == 0) {return}
        mousePos = [event.pageX, event.pageY]
        var x = (mousePos[0]-startmousePos[0])
        var y = (mousePos[1]-startmousePos[1])
        if (!!event.touches) {x = window.mouseDirectionX}
        if (!!event.touches) {y = window.mouseDirectionY}
        if (Math.abs(x) > Math.abs(y)) {
            if (x > 0) {
            for (var i = 0; i < scrollX.length; i++) {
                scrollX[i].style = "left:0px"
            }
            } else {
            for (var i = 0; i < scrollX.length; i++) {
                scrollX[i].style = "left:-"+(scrollX[i].clientWidth)+"px"
            }
            }
        } else {
            if (y < 0) {
                for (var i = 0; i < scrollY.length; i++) {
                    scrollY[i].style = "bottom:0px"
                }
            } else {
                for (var i = 0; i < scrollY.length; i++) {
                    scrollY[i].style = "bottom:-"+(scrollY[i].clientHeight)+"px"
                }
            }
        }
    }
}

function OpenMenu() {
    document.querySelector("[scrollXleft]").style = "left:0px"
}

function scrollable(el) {
    var el = el
    while (el != window.body) {
        if (el.getAttribute("scrollybottom")) {return true}
        el = el.parentElement
    }
    return false;
}