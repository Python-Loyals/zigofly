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

//    user on click
$('body').on('click', '.userlist-box', function() {
    $('.showChat_inner').removeClass('slideOutRight');
    $('.showChat_inner').addClass('animated slideInRight');
    $('.showChat_inner').css('display', 'block');
    scrollChat()
    $('#chat-message').focus();
    $('body:not(.main-friend-chat)').css('overflow-y', 'hidden');
});

let min_height = '38';
$('#chat-message').on('keydown', function (e) {
    if (e.which == 13 && !e.ctrlKey && !e.altKey && !e.shiftKey){
        e.preventDefault();
        $('#chat-form').submit()
    }else if(e.which == 13 &&( e.ctrlKey || e.altKey || e.shiftKey)){
        let v = $(this).val()
        $(this).val(v+'\n');
    }
    $(this).css( {
        'height': min_height+'px'
    });
    let height = Math.min(20 * 5, $(this)[0].scrollHeight);
    $(this). css('height',  height + 'px');

    if ($(this)[0].scrollHeight > height){
        $(this).css( {
            'overflow-y': 'auto',
        });
    }else{
        $(this).css( {
            'overflow-y': 'hidden',
        });
    }
});


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
        scrollChat();
        $('#chat-message').val('').css('overflow-y', 'hidden')
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
