let sender, recipient, profile, username, myInterval = '';
$('.live-chat').on('click', function(e) {
    e.preventDefault();
    $('.btn-chat').trigger('click');
})


//search
$("#search-friends").on("keyup", function() {
    var g = $(this).val().toLowerCase();
    $(".userlist-box .media-body .chat-header").each(function() {
        var s = $(this).text().toLowerCase();
        $(this).closest('.userlist-box')[s.indexOf(g) !== -1 ? 'show' : 'hide']();
    });
});

$('.displayChatbox').on('click', function(e) {
    e.preventDefault();
    $('.showChat').removeClass('slideOutRight');
    $('.showChat').addClass('animated slideInRight');
    $('.showChat').css('display', 'block');
    $('body:not(.main-friend-list)').css('overflow-y', 'hidden');
});

//close
$('.back_friendlist').on('click', function() {

    $('.showChat').toggleClass('slideInRight');
    $('.showChat').toggleClass('slideOutRight');
    $('body:not(.main-friend-chat)').css('overflow-y', 'auto');
});

//text area autosize
$('#chat-message').on('keydown', function () {
    $(this). css( 'height','0px');
    let height = Math.min(20 * 5, $(this)[0].scrollHeight);
    $(this). css('height',  height + 'px');
});


//
// let a = $(window).height() - 80;
// $(".main-friend-list").slimScroll({ height: a, allowPageScroll: false,
//     wheelStep: 8, color: '#5A5EB9', disableFadeOut: true });
// a = $(window).height() - 155;
// $(".main-friend-chat").slimScroll({
//     height: a, allowPageScroll: false, wheelStep: 8, start: 'bottom',
//     color: '#5A5EB9',  alwaysVisible: true
// });

let appendConvo = (messages)=>{
    messages.forEach(message =>{
        let msg;
        if (message.sender == recipient){
            msg = `\
                           <div class="media chat-messages">
                        <div class="media-body chat-menu-reply">
                            <div class="">
                                <p class="chat-cont">${message.message}</p>
                            </div>
                            <p class="chat-time">${message.created_at}</p>
                        </div>
                    </div>
                           `
        } else{
            msg = `\
                       <div class="media chat-messages">
                        <div class="media-body chat-menu-content pl-3">
                            <div class="">
                                <p class="chat-cont">${message.message}</p>
                            </div>
                            <p class="chat-time">${message.created_at}</p>
                        </div>
                    </div>
                       `
        }
        $('.main-friend-chat').append(msg);
        scrollChat();
    })
}

let sendMessage = (sender,message,  recipient) =>{
    return $.ajax({
        url: '../api/message/',
        method: 'POST',
        data: {new_message:  {message, sender, recipient}},
        success: function (data) {
            try{
                const m = data.success.message;
                return true;
            }catch (e) {
                let m = 'Some unexpected error occurred';
                console.log(e)
                toastr.error(m, "Ooops!", {
                    showMethod: "slideDown",
                    hideMethod: "fadeOut"
                });
                return false;
            }
        },
        error: function (error) {
            let m = 'Some unexpected error occurred';
            try{
                m = error['responseJSON']['error']['message'];
            }catch (e) {
                console.error(m)
            }
            toastr.error(m, "Ooops!", {
                showMethod: "slideDown",
                hideMethod: "fadeOut"
            });
            return false;
        }
    })
}

let markRead = (sender, recipient) =>{
    $.ajax({
        url: '../api/message/',
        method: 'POST',
        data: {mark_as_read:  {sender, recipient}},
        success: function (data) {

        },
        error: function (error) {
            console.log(error)
        }
    })
}

let fetchNewMessages = (sender, recipient) =>{
    $.ajax({
        url: '../api/message/',
        method: 'GET',
        cache: false,
        data: {new_messages: true, sender, recipient},
        success: function (data) {
            try{
                const messages = data.success.message.messages;
                appendConvo(messages)
                markRead(sender, recipient)

            }catch (e) {
                console.log(e)
            }
        },
        error: function (error) {
            console.log(error)
        }
    })
}


//    user on click
$('.userlist-box').on('click', function() {
    username = $(this).data('username');
    profile = $(this).data('profile');
    sender = $(this).data('empid');
    recipient = $(this).data('recipient');
    $('.main-friend-chat').html('');
    $('.showChat_inner .media-object').attr('src', profile);
    $('.showChat_inner .user-name').html(`\
                <span class="user_name">${username}</span>
                <i class="fa fa-info-circle text-white-50 ml-auto fs-20 user-info" data-user="sender"></i> `);

    // $.ajax({
    //     url: '../api/message/',
    //     method: 'GET',
    //     cache: false,
    //     data: { conversation: true, sender, recipient },
    //     success: function(data) {
    //         try {
    //             const messages = data.success.message.messages;

    //             appendConvo(messages)
    //             markRead(sender, recipient)

    //         } catch (e) {
    //             console.log(e)
    //         }
    //     },
    //     error: function(error) {
    //         console.log(error)
    //     }
    // })

    $('.showChat_inner').removeClass('slideOutRight');
    $('.showChat_inner').addClass('animated slideInRight');
    $('.showChat_inner').css('display', 'block');
    // scrollChat()
    $('#chat-message').focus();
    $('body:not(.main-friend-chat)').css('overflow-y', 'hidden');
    // console.log(sender)
    // myInterval = setInterval(function() {
    //     fetchNewMessages(sender, recipient)
    // }, 5000)
});

$('#chat-message').on('keydown', function (e) {
    if (e.which == 13 && !e.ctrlKey && !e.altKey && !e.shiftKey){
        e.preventDefault();
        $('#chat-form').submit()
    }
})

$('.back_chatBox').on('click', function() {
    $('.showChat_inner').toggleClass('slideInRight');
    $('.showChat_inner').toggleClass('slideOutRight');
    $('body').css('overflow-y', 'auto');
});

$('#chat-form').on('submit', function(event) {
    event.preventDefault();
    $('#chat-message').focus();
    let newMessage = $('#chat-message').val().trim();
    if (newMessage) {
        // if (sendMessage(recipient, newMessage, sender)) {
        appendMessage(newMessage);
        // }
        $('#chat-message').val('');
    }
})

let appendMessage = (message) => {
    const d = new Date()
    const hour = ("0" + d.getHours()).slice(-2)
    const minute = ("0" + d.getMinutes()).slice(-2)
    const time = `${hour}:${minute}`
    const msg = `\
                    <div class="media chat-messages">
                        <div class="media-body chat-menu-reply">
                            <div class="">
                                <pre class="chat-cont">${message}</pre>
                            </div>
                            <p class="chat-time">${time}</p>
                        </div>
                    </div> `
    $('.main-friend-chat').append(msg);
    scrollChat();
}
let scrollChat = () => {
    $(".main-friend-chat").animate({ scrollTop: $(".main-friend-chat")[0].scrollHeight }, 1000);
}
