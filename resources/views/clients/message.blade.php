<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
     $(document).ready(function(){
          $(".name").click(function(){
               var formChat = document.getElementsByClassName('chat');
               var message_user = document.getElementsByClassName('list-message');
               var recipient_id  = $(this).attr('data-value');
               document.getElementById("send").setAttribute("data-value", recipient_id);
               message_user[0].style.display = 'none';
               $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/getmessage',
                data: {recipient_id: recipient_id},
                success: function(data) {
                // Handle successful response
                var user_id = data.user_id;
                let htmlChats = "";
                let htmlName = data.user_name[0];
                htmlName = htmlName.name
                user_friend_id =  htmlName.id
                    data.messages.forEach((item) => {
                    htmlChats += `
                        <div class="messages">
                            <div class="message ${item.id == user_id ? 'received' : 'sent'}" >
                                <p>${item.content}</p>
                            </div>  
                        </div>
                        `
                    })
                    $('#chat').empty()
                    $('#username').empty()
                    $('#chat').append(htmlChats);
                    $('#username').append(htmlName);
                    formChat[0].style.display = 'block';
                },
                error: function(xhr, status, error) {
                // Handle error response
                }
            }); 
          });

          //send message
          $("#send").click(function(){
           var recipient_id = $(this).attr('data-value');
           var content = $('#content').val()
            $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/addmessage',
                data: {
                    recipient_id: recipient_id,
                    content: content
                },
                success: function(data) { 
                    // Handle successful response
                    var content = data.content
                    let htmlChats =""
                    htmlChats += `
                        <div class="messages">
                            <div class="message sent" >
                                <p>${content}</p>
                            </div>  
                        </div>
                        `
                    // })
                    
                    $('#chat').append(htmlChats);
                    $('#content').val('')
                    
                    
                },
                error: function(xhr, status, error) {
                    // Handle error response
                 ;
                }
            });
          })
     })
</script>

@extends('layouts.app')
@section('content')
<div class="container" >
    <div style="display: flex; margin:5px">
        <div class="col-md-3">
            @section('sizebar')
             @include('clients.block.sizebar')
            @show
        </div>
        <div class="col-md-6"  >
            <div class="chat" style="display:none">
                <div class="header">
                    <img src="user-icon.png" alt="User Icon" class="user-icon">
                    <div id="username"></div>  
                </div>
                <div id="chat" style="overflow-y: scroll; height:60vh">      
                </div>
                    <form action="", method="">
                        @csrf
                        <div class="input">
                            <input width="100%" type="text" id="content" placeholder="Type your message...">
                            <a class="btn btn-sm btn-primary" type="submit" id="send" data-value="">Gửi</a>
                        </div> 
                    </form> 
            </div>
            <div>
                <div class="list-message">
                    @if ($messages -> count() > 0)
                        @foreach($messages as $key => $item)
                            <div class="message-user" style="background: #FFFFE0;border-radius:15px">
                                @if ($item->id != $user_id)
                                     <div style="margin-left:20px">
                                        <a style="font-size: 15px; font-weight:900;text-decoration: none;"  style="submit" class="name" data-value="{{$item->id}}">{{$item->name}}</a>
                                    <p>{{$item->content}}</p>
                                </div>
                                @endif
                            </div>
                        @endforeach
                        @else
                        <span>Bạn chưa có tin nhắn nào. Hãy click vào tên bạn bè để trò chuyện</span>
                    @endif
                   
                </div>
            </div>
        </div>
        </div>
        <div class="col-md-3" style="position: fixed; right: 50;top:80px;height:600px;overflow-y: scroll">
           <div style="margin-left:50px">
                @if($users -> count() > 0)
                    @forEach($users as $key => $item)
                        <div style="margin-top:10px">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/34/Elon_Musk_Royal_Society_%28crop2%29.jpg/1200px-Elon_Musk_Royal_Society_%28crop2%29.jpg" alt="Avatar" class="avatar" style="vertical-align: middle;width: 40px;height: 40px;border-radius: 50%;">
                            <a style="text-decoration: none; font-weight:900; font-size:12px" type="submit" class="name" data-value="{{$item->id}}">{{$item->name}}</a>
                        </div>
                    @endforeach
                @endif
           </div>

        </div>
     </div>
</div>
@endsection

<style>
    .chat {
    background-color: #F5F8FA;
    border: 1px solid #E1E8ED;
    border-radius: 8px;
    width: 100%;
    height: 80vh;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    }

    .header {
    background-color: #E1E8ED;
    display: flex;
    align-items: center;
    padding: 8px;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
    }

    .user-icon {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    }

    .username {
    margin-left: 8px;
    font-size: 16px;
    }

    .messages {
    flex: 1;
    display: flex;
    flex-direction: column;
    padding: 8px;
    }

    .message {
    padding: 8px;
    border-radius: 8px;
    margin: 4px 0;
    max-width: 80%;
    }

    .received {
    background-color: #FFFFFF;
    align-self: flex-start;
    }

    .sent {
    background-color: #1DA1F2;
    align-self: flex-end;
    color: #FFFFFF;
    }

    .time {
    font-size: 12px;
    color: #7F8A93;
    margin-left: 8px;
    }

    .input {
    display: flex;
    align-items: center;
    border-bottom-left-radius: 8px;
    border-bottom-right-radius: 8px;
    }

    input[type="text"] {
    flex: 1;
    border: none;
    background-color: #FFFFFF;
    border-radius: 20px;
    padding: 8px;
    margin-right: 8px;
    }

    button {
    background-color: #1DA1F2;
    color: #FFFFFF;
    border: none;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    font-size: 20px;
    }

</style>

