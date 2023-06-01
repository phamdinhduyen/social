<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
     
    <div>
        @if($allPost -> count() > 0)
                @foreach($allPost as $key => $item)
                    <div class="card post" data-post-id="{{$item->id}}" style="margin-top:5px; padding:0px">
                       <div style="border-bottom:1px solid #A9A9A9">
                            <div style="margin-left:10px;">
                                <div>
                                    <img src="{{ asset('Uploads/image/'.$item->image_avatar) }}" alt="" class="avatar" style="vertical-align: middle;width: 40px;height: 40px;border-radius: 50%;">
                                    <a href="{{ route('user-profile', ['id' => $item->user_id]) }}" style="text-decoration: none; font-weight:900" type="submit" class="name_comment">{{$item->name}}</a>
                                </div>
                                <span style="font-size: 11px;">{{$item->created_at}}</span> <br/>
                                <span>{{$item->content}}<span>
                            </div>
                            <div style="margin-top:5px">
                                @if ($item->image)
                                    <img  height="auto" width="100%" src="{{ asset('Uploads/image/'.$item->image) }}" alt="image">
                                @endif
                            </div>
                       </div>
                       <div style="border-bottom:1px solid #A9A9A9;display:flex; justify-content: space-between;">
                            <div>
                                <span style="margin-left:10px;color: 2F4F4F">{{$item->like_count }}</span>
                                <span style="color: 2F4F4F">người khác đã thích</span>
                            </div>
                            <div>
                                <span style="color: 2F4F4F">{{$item->comment_count }}</span>
                                <span style="margin-right:10px;color: 2F4F4F">Bình luận</span>
                            </div>
                        </div>
                        
                        <div style="border-bottom:1px solid #A9A9A9 ">
                            <div style="display:flex; justify-content: space-around; ">
                                <div> 
                                    @if($item->is_liked == 0)
                                        <div style="display:flex">
                                            <div style="margin-right:3px;">
                                                <i style="color:#A9A9A9" class="fas fa-heart heart"></i>
                                            </div>
                                            <div>
                                                <a style="text-decoration: none; font-weight:900" type="submit" class="like" data-value="{{$item->id}}" data-index-value="{{$key}}">Thích</a>
                                                <a style="text-decoration: none;  font-weight:900; display:none" type="submit" class="unlike" data-value="{{$item->id}}" data-index-value="{{$key}}">Bỏ Thích</a>
                                            </div>
                                        </div>  
                                    @else 
                                    <div style="display:flex">
                                            <div style="margin-right:3px;">
                                            <i style="color:red" class="fas fa-heart heart"></i> 
                                            </div>
                                            <div>
                                                <a style="text-decoration: none;  font-weight:900" type="submit" class="unlike" data-value="{{$item->id}}" data-index-value="{{$key}}">Bỏ Thích</a>
                                                <a style="text-decoration: none; font-weight:900; display:none" type="submit" class="like" data-value="{{$item->id}}" data-index-value="{{$key}}">Thích</a>  
                                            </div>
                                        </div>
                                    @endif
                                </div> 
                                <div>
                                    <i style="color:A9A9A9" class="fas fa-comment-alt"></i>
                                    <a style="text-decoration: none;font-weight:900" type="submit" class="comments" data-value="{{$item->id}}" data-index-value="{{$key}}">Bình luận</a>
                                </div>
                                <div>
                                    <i style="color:A9A9A9" class="fas fa-share-square"></i>
                                    <a style="text-decoration: none;font-weight:900" type="submit" class="share">Chia sẻ</a>
                                </div>
                            </div>
                        </div>  
                        <div class="form-comment" style="display: none;">
                            <form id="comments-form" style="display:flex; margin-top:5px" action="" method="get">
                                @csrf
                                <div class="form-group" style="width: 70%; margin-left:5px; border-radius: 25px;">
                                    <textarea style="border-radius: 5px" class="form-control" name="content" id="comments-post-{{$item->id}}" rows="1" ></textarea>
                                    <span class="comment-error"></span>
                                </div>
                                <div class="form-group" style=" margin-left:5px">
                                    <button style="text-decoration: none;font-weight:900" type="submit" class="btn-secondary submit-comment" data-value="{{$item->id}}" data-index-value="{{$key}}"> Bình luận </button>
                                </div>
                            </form> 
                            
                            <div class="comment-success"></div>
                       </div>
                    </div>  
                @endforeach
        @endif
        
    </div>
    <div id="show_more_post"></div>
    <div style="text-align:center; color: green" id="show_more"> Xem thêm</div>
      
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
var page = 1; 
var key = 2
var numberPage = 2
$(document).ready(function() {
    // $('body').on('click', '.duyen', function() {
        
    // });
 
    //showmore
    $("#show_more").click(function() {
            page = page + 1
            key = (page) * numberPage; 
            $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/show-more-post',
                data: {page: page,},
                success: function(data) {
                // Handle successful response
                    let html_show_more = '';
                    data.forEach((item , index) => {
                        key =  index  + page * numberPage - numberPage; 
                        console.log(key);
                        html_show_more += `
                            <div class="card post" data-post-id="${item.id}" style="margin-top:5px; padding:0px">
                       <div style="border-bottom:1px solid #A9A9A9">
                            <div style="margin-left:10px;">
                                <div>
                                    <img src="Uploads/image/${item.image_avatar}" alt="" class="avatar" style="vertical-align: middle;width: 40px;height: 40px;border-radius: 50%;">
                                    <a href="/user-profile/${item.user_id}" style="text-decoration: none; font-weight:900" type="submit" class="name_comment">${item.name}</a>
                                </div>
                                <span style="font-size: 11px;">${item.created_at}</span> <br/>
                                <span>${item.content}<span>
                            </div>
                            <div style="margin-top:5px">
                             ${item.image != null ? `<img height="auto" width="100%" src="Uploads/image/${item.image}" alt="image">` : ''}
                            </div>
                       </div>
                       <div style="border-bottom:1px solid #A9A9A9;display:flex; justify-content: space-between;">
                            <div>
                                <span style="margin-left:10px;color: 2F4F4F">${item.like_count }</span>
                                <span style="color: 2F4F4F">người khác đã thích</span>
                            </div>
                            <div>
                                <span style="color: 2F4F4F">${item.comment_count }</span>
                                <span style="margin-right:10px;color: 2F4F4F">Bình luận</span>
                            </div>
                        </div>
                        
                        <div style="border-bottom:1px solid #A9A9A9 ">
                            <div style="display:flex; justify-content: space-around; ">
                                <div> 
                                    ${item.is_liked == 0 ? ` <div style="display:flex">
                                            <div style="margin-right:3px;">
                                                <i style="color:#A9A9A9" class="fas fa-heart heart"></i>
                                            </div>
                                            <div>
                                                <a style="text-decoration: none; font-weight:900" type="submit" class="like" data-value="${item.id}" data-index-value="${key}">Thích</a>
                                                <a style="text-decoration: none;  font-weight:900; display:none" type="submit" class="unlike" data-value="${item.id}" data-index-value="${key}">Bỏ Thích</a>
                                            </div>
                                        </div>`  :    `<div style="display:flex">
                                            <div style="margin-right:3px;">
                                            <i style="color:red" class="fas fa-heart heart"></i> 
                                            </div>
                                            <div>
                                                <a style="text-decoration: none;  font-weight:900" type="submit" class="unlike" data-value="${item.id}" data-index-value="${key}">Bỏ Thích</a>
                                                <a style="text-decoration: none; font-weight:900; display:none" type="submit" class="like" data-value="${item.id}" data-index-value="${key}">Thích</a>  
                                            </div>
                                    </div>`}
                                       
                                </div> 
                                <div>
                                    <i style="color:A9A9A9" class="fas fa-comment-alt"></i>
                                    <a style="text-decoration: none;font-weight:900" type="submit" class="comments" data-value="${item.id}" data-index-value="${key}">Bình luận</a>
                                </div>
                                <div>
                                    <i style="color:A9A9A9" class="fas fa-share-square"></i>
                                    <a style="text-decoration: none;font-weight:900" type="submit" class="share">Chia sẻ</a>
                                </div>
                            </div>
                        </div>  
                        <div class="form-comment" style="display: none;">
                            <form id="comments-form" style="display:flex; margin-top:5px" action="" method="get">
                                @csrf
                                <div class="form-group" style="width: 70%; margin-left:5px; border-radius: 25px;">
                                    <textarea style="border-radius: 5px" class="form-control" name="content" id="comments-post-${item.id}" rows="1" ></textarea>
                                    <span class="comment-error"></span>
                                </div>
                                <div class="form-group" style=" margin-left:5px">
                                    <button style="text-decoration: none;font-weight:900" type="submit" class="btn-secondary submit-comment" data-value="${item.id}" data-index-value="${key}"> Bình luận </button>
                                </div>
                            </form>   
                            <div class="comment-success"></div>
                       </div>
                    </div>
                        `
                    });
                  
                    $('#show_more_post').append(html_show_more); 
                },
                error: function(xhr, status, error) {
                // Handle error response
                }
            }); 
            
    })

    // get comment when click buttom comment
     $('body').on('click', '.comments', function() {
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
                                <a href="/user-profile/${item.user_id}" style="text-decoration: none; font-weight:900" type="submit" class="name_comment">${item.name}</a> 
                            </div>
                            <div style="margin-top:10px"> 
                                <span style="font-size:12p">${item.content}<span>
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
        
    });
 
    //add comment
    $('body').on('click', '.submit-comment', function(e){
        console.log(111);
        e.preventDefault();
        var content = $(`#content`);
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
                                    <a href="/user-profile/${item.user_id}" style="text-decoration: none; font-weight:900" type="submit" class="name_comment">${item.name}</a> 
                                </div>
                                <span style="font-size:12px;">${item.content}<span>
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
    $('body').on('click', '.like', function() {
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
    });

    $('body').on('click', '.unlike', function() {
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
    });
 
  
})
</script>

<style>
@media only screen and (min-width: 600px) and (max-width: 1920px) {
.form-status{
    display: flex;
    margin-top:4px;
    justify-content: center
   }
}
@media only screen and (min-width: 320px) and (max-width: 414px) {
   .form-group{
       width: 100% !important;
      justify-content: flex-start
   }
   .form-status{
     margin-top:4px
   }
}
 
</style>
  