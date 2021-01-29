$('.back_chatBox').on('click', function() {
    $('.showChat_inner').toggleClass('slideInRight');
    $('.showChat_inner').toggleClass('slideOutRight');
    $('body').css('overflow-y', 'auto');
});

$('.btn-chat').on('click', function() {
    $('.showChat_inner').removeClass('slideOutRight');
    $('.showChat_inner').addClass('animated slideInRight');
    $('.showChat_inner').css('display', 'block');
    $('#chat-message').focus();
    $('body:not(.main-friend-chat)').css('overflow-y', 'hidden');
});

$('#chat-form').on('submit', function(event) {
    event.preventDefault();
    $('#chat-message').focus();
    let newMessage = $('#chat-message').val().trim();
    if (newMessage) {
        scrollChat();
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
