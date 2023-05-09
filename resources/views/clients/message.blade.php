@extends('layouts.app')
@section('content')
<div class="container" >
    <div style="display: flex; margin:5px">
        <div class="col-md-3">
            @section('sizebar')
             @include('clients.block.sizebar')
            @show
        </div>
        <div class="col-md-6">
        <div class="chat" >
            <div class="header">
                <img src="user-icon.png" alt="User Icon" class="user-icon">
                <h3 class="username">John Doe</h3>
            </div>
            <div class="messages"  style="overflow-y: scroll">
                <div class="message received" >
                    <p>Hello, how are you?</p>
                    <span class="time">10:00 AM</span>
                    </div>
                    <div class="message sent">
                    <p>I'm good, thanks. How about you?</p>
                    <span class="time">10:05 AM</span>
                    </div>
                    <div class="message received">
                    <p>Doing well, thanks for asking!</p>
                    <span class="time">10:10 AM</span>
                    </div>
                    <div class="message sent">
                    <p>I'm good, thanks. How about you?</p>
                    <span class="time">10:05 AM</span>
                    </div>
                    <div class="message received">
                    <p>Doing well, thanks for asking!</p>
                    <span class="time">10:10 AM</span>
                    <p>Hello, how are you?</p>
                    <span class="time">10:00 AM</span>
                    </div>
                    <div class="message sent">
                    <p>I'm good, thanks. How about you?</p>
                    <span class="time">10:05 AM</span>
                    </div>
                    <div class="message received">
                    <p>Doing well, thanks for asking!</p>
                    <span class="time">10:10 AM</span>
                        <p>Hello, how are you?</p>
                    <span class="time">10:00 AM</span>
                    </div>
                    <div class="message sent">
                    <p>I'm good, thanks. How about you?</p>
                    <span class="time">10:05 AM</span>
                    </div>
                    <div class="message received">
                    <p>Doing well, thanks for asking!</p>
                    <span class="time">10:10 AM</span>
                </div>
            </div>
            <div class="input">
                <input type="text" placeholder="Type your message...">
                <button type="submit">Send</button>
            </div>
        </div>
        </div>
        <div class="col-md-3">
          
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
    padding: 8px;
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

