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
 <div class="card" >
                <form style="margin-top:5px; display:flex;  justify-content: center;" action="" method="post" enctype="multipart/form-data">
                @csrf
                    <div>
                        <div class="form-group" style="width: 100%; border-radius: 25px;">
                            <textarea style="border-radius: 5px" class="form-control" name="content" id="post" rows="1" placeholder="Xin chào, Hôm nay bạn thế nào" ></textarea>
                            @error('content')
                            <span style="color:red">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group" style="margin-top:14px">
                            <input id="file" type="file" name="file" accept="image/jpeg, image/png">
                        </div>
                    </div>
                    <div class="form-group" style=" margin-left:5px">
                        <button class="btn btn-secondary" type="submit">Đăng</button>
                    </div>
                </form>
            </div>
            @if($allPost -> count() > 0)
                @foreach($allPost as $key => $item)
                    <div class="card post" data-post-id="{{$item->id}}" style="margin-top:5px; padding:0px">
                       <div style="border-bottom:1px solid #A9A9A9">
                            <div style="margin-left:10px;">
                                <div>
                                    <img src="{{ asset('Uploads/image/'.$item->image_avatar) }}" alt="Avatar" class="avatar" style="vertical-align: middle;width: 40px;height: 40px;border-radius: 50%;">
                                    <a style="text-decoration: none; font-weight:900" type="submit" class="name_comment">{{$item->name}}</a>
                                </div>
                                <span style="font-size: 11px;">{{$item->created_at}}</span> <br/>
                                <span>{{$item->content}}<span>
                            </div>
                            <div style="margin-top:5px">
                                @if ($item->image)
                                    <img height="400px" width="100%" src="{{ asset('Uploads/image/'.$item->image) }}" alt="image">
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
                                            <div style="margin-right:3px; margin-top: 4px">
                                                <i style="color:#A9A9A9" class="fas fa-heart heart"></i>
                                            </div>
                                            <div>
                                                <a style="text-decoration: none; font-weight:900" type="submit" class="like" data-value="{{$item->id}}" data-index-value="{{$key}}">Thích</a>
                                                <a style="text-decoration: none;  font-weight:900; display:none" type="submit" class="unlike" data-value="{{$item->id}}" data-index-value="{{$key}}">Bỏ Thích</a>
                                            </div>
                                        </div>  
                                    @else 
                                    <div style="display:flex">
                                            <div style="margin-right:3px; margin-top: 4px">
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