let sender, recipient, profile, username, myInterval = '';
$('.live-chat').on('click', function(e) {
    e.preventDefault();
    $('.btn-chat').trigger('click');
})

//    user on click
$('.btn-chat').on('click', function() {
    // username = $(this).data('username');
    // profile = $(this).data('profile');
    // sender = $(this).data('empid');
    // recipient = $(this).data('recipient');
    // $('.main-friend-chat').html('');
    // $('.showChat_inner .media-object').attr('src', profile);
    // $('.showChat_inner .user-name').html(`\
    //             <span class="user_name">${username}</span>
    //             <i class="fa fa-info-circle text-white-50 ml-auto fs-20 user-info" data-user="sender"></i> `);

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

$('.back_chatBox').on('click', function() {
    $('.showChat_inner').toggleClass('slideInRight');
    $('.showChat_inner').toggleClass('slideOutRight');
    $('body').css('overflow-y', 'auto');
    // clearInterval(myInterval);
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
                                <p class="chat-cont">${message}</p>
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