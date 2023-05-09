<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
$(document).ready(function() {
 
    // get comment when click buttom comment
    $(".comments").click(function(e) {
            var commentForm = document.getElementsByClassName('form-comment');
            var post_id = $(this).attr('data-value');
            var index = $(this).attr('data-index-value');
            if (commentForm.length > 0) {
            commentForm[index].style.display = 'block'; 

            $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/getcomment',
                data: {post_id: post_id,},
                success: function(data) {
                // Handle successful response
                    let htmlComments = '';
                    data.forEach((item) => {
                        htmlComments += `
                        <div style="margin-left:10px">
                            <div>
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/34/Elon_Musk_Royal_Society_%28crop2%29.jpg/1200px-Elon_Musk_Royal_Society_%28crop2%29.jpg" alt="Avatar" class="avatar" style="vertical-align: middle;width: 40px;height: 40px;border-radius: 50%;">
                                <a style="text-decoration: none; font-weight:900" type="submit" class="name_comment">${item.name}</a> 
                            </div>
                            <div style="margin-top:10px"> 
                                <span style="font-size:12px;margin-left:40px">${item.content}<span>
                            </div>
                            <div>
                                <a style="text-decoration: none" type="submit" class="like-comment">Thích</a> 
                                <a style="text-decoration: none; margin-left:10px" type="submit" class="reply">Trả lời</a>
                            </div>
                        </div>
                        `
                    });
                    var commentSection = $(".post[data-post-id=" + post_id + "] .comment-success");
                    commentSection.empty();
                    commentSection.append(htmlComments); 
                },
                error: function(xhr, status, error) {
                // Handle error response
                }
            });
        }     
    })
    //add comment
    $(".submit-comment").click(function(e) {
        console.log($(this));
        e.preventDefault();
        var commentErr = document.getElementsByClassName('comment-error');
        var id = $(this).attr('data-value')
        var index = $(this).attr('data-index-value')
        var content = $(`#comments-post-${id}`);
        var csrf_token = $('meta[name="csrf-token"]').attr('content');

        // Set CSRF token in AJAX header
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrf_token
            }
        });

        // Send AJAX request with CSRF token included in header
        $.ajax({
                type: 'POST',
                url: 'http://127.0.0.1:8000/addcomment',
                data: {
                    id: id,
                    content: content.val()
                },
                success: function(data) {
                    // Handle successful response
                    $("#comments-form")[0].reset(); // Clear form data
                    let htmlComments = '';
                        data.forEach((item) => {
                            htmlComments += `
                            <div style="margin-left:10px; ">
                                <div>
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/34/Elon_Musk_Royal_Society_%28crop2%29.jpg/1200px-Elon_Musk_Royal_Society_%28crop2%29.jpg" alt="Avatar" class="avatar" style="vertical-align: middle;width: 40px;height: 40px;border-radius: 50%;">
                                    <a style="text-decoration: none; font-weight:900" type="submit" class="name_comment">${item.name}</a> 
                                </div>
                                <span style="font-size:12px; margin-left:40px;">${item.content}<span>
                                <div>
                                    <a style="text-decoration: none" type="submit" class="like">Thích</a> 
                                    <a style="text-decoration: none; margin-left:10px" type="submit" class="reply">Trả lời</a>
                                </div>
                            </div>
                            `
                        });
                    var commentSection = $(".post[data-post-id=" + id + "] .comment-success");
                    commentErr[index].style.display = 'none';
                    commentSection.empty();
                    commentSection.append(htmlComments);
                    content.val('')
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    let htmlCommentsErr = '';
                    let err = xhr.responseJSON.message
                    console.log(err);
                            htmlCommentsErr += `
                            <div style="margin-left:10px;">
                                <span style="font-size:12px; color:red">${err}<span>
                            </div>
                       `     
                    var commentSection = $(".post[data-post-id=" + id + "] .comment-error");
                    commentSection.empty();
                    commentSection.append(htmlCommentsErr);
                }
            });
    });
    // like 
    $(".like").click(function(e) {
        var post_id = $(this).attr('data-value');
        var like = document.getElementsByClassName('like');
        var unLike = document.getElementsByClassName('unlike');
        var heart = document.getElementsByClassName('heart');
        var index = $(this).attr('data-index-value');

        $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/like',
                data: {post_id: post_id,},
                success: function(data) {
                    like[index].style.display = 'none'; 
                    unLike[index].style.display = 'block'; 
                    heart[index].style.color = 'red';
                // Handle successful response
                },
                error: function(xhr, status, error) {
                // Handle error response
                }
            });      
    })

    $(".unlike").click(function(e) {
        var post_id = $(this).attr('data-value');
        var like = document.getElementsByClassName('like');
        var unLike = document.getElementsByClassName('unlike');
        var heart = document.getElementsByClassName('heart');
        var index = $(this).attr('data-index-value');

        $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/unlike',
                data: {post_id: post_id,},
                success: function(data) {
                    like[index].style.display = 'block'; 
                    unLike[index].style.display = 'none';
                    heart[index].style.color = '#A9A9A9';
                // Handle successful response
                },
                error: function(xhr, status, error) {
                // Handle error response
                }
            });      
    })
})
</script>
<title>Trang chủ</title>
@extends('layouts.app')

@section('content')
<div class="container" >
    <div style="display: flex; margin:5px">
        <div class="col-md-3">
            @section('sizebar')
                @include('clients.block.sizebar')
            @show
        </div>
        <div class="col-md-6 list-post" style="height:600px;overflow-y: scroll">
            @section('status')
                @include('clients.news.status')
            @show
        </div>
        <div class="col-md-3" >
            
            <div style="position: fixed; right: 50;top:80px; height: 150px; overflow-y: scroll;width: 22%;">
                @include('clients.block.ads')
            </div>

            <div style="position: fixed; right: 50;bottom:20px; height: 55%; overflow-y: scroll;width: 22%; border-top: 3px solid #A9A9A9; border-left: 3px solid #A9A9A9">
                @include('clients.block.addFriend')
            </div>
        </div>
        
    </div>
</div>
@endsection



