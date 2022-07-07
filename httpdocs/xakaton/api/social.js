Social = {
    generateSocial:function() {
        var data = {
            friends:[],
        }
        return JSON.stringify(data)
    },
    get:function(token) {
        var data = req("POST", "social.php", token)
        if (data == "{}") {console.log("generated: "+req("POST", "setSocial.php", {token:token, content:this.generateSocial()})); return this.generateSocial()}
        else {
            return data
        }
    },
    getFriends:function(token) {
        var data = JSON.parse(this.get(token))
        var names = []
        data = data.friends
        for (var i = 0; i < data.length; i++) {
            names[i] = {name:this.getFtoken(data[i]).login, token:data[i]}
        }
        return names
    },
    getFtoken:function(token) {
        var data = req("POST", "socialF.php", token)
        return JSON.parse(data)
    },
    GenerateChat:function() {
        var names = Social.getFriends(localStorage.getItem("p.token"))
        prefub = document.querySelector('div.prefub').children[0]
        place = document.querySelector('div.contactplace')
        for (var i = 0; i < names.length; i++) {
            prefub.querySelector("name").innerHTML = names[i].name
            place.innerHTML += prefub.outerHTML
        }
        var els = place.childNodes
        for (var i = 0; i < els.length; i++) {
            els[i].attributes.src = names[i].token
            els[i].onclick = function() {parent.parent.parent.location = 'https://visoff.ru/xakaton/chats/dialog.php?token='+this.attributes.src}
        }
        return place.innerHTML
    },
    GenerateMessages:function(chatToken) {
        var chatPlace = document.querySelector('messageArray')
        document.querySelector('.name').innerText = this.getFtoken(chatToken).login
        messages = req("POST", "getMessages.php", {author:localStorage.getItem("f.token"), toUser:chatToken})
        if (messages != '') {messages = JSON.parse(messages)}
        res = ""
        for (var i = 0; i < messages.length; i++) {
            if (chatPlace.querySelectorAll("message").length > i) {continue}
            cls = ""
            inside = "<span>"+messages[i].content+"</span>"
            if (messages[i].author == localStorage.getItem('f.token')) {cls = 'class = "your"'}
            if (messages[i].type == "circle") {inside = "<video muted='true' src='https://visoff.ru/"+messages[i].content+"'>"}
            res += "<message "+cls+">"+inside+"</message>"
        }
        if (res != "") {chatPlace.innerHTML += res}
    },
    sendMessage:function(chatToken, content) {
        req("POST", "sendMessage.php", {author:localStorage.getItem("f.token"), toUser:chatToken, content:content})
        this.GenerateMessages(chatToken)
    },
    send:function() {
        if (document.querySelector('form input').value != '') {
            this.sendMessage(chatToken, document.querySelector('form input').value)
            document.querySelector('form input').value = ""
        };
    }
}