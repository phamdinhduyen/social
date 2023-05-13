
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
     $(document).ready(function(){
          $(".add-friend").click(function(){
               var deleteFriend = document.getElementsByClassName('delete-friend');
               var addFriend = document.getElementsByClassName('add-friend');
               var index = $(this).attr('data-index-value')
               var user_id = $(this).attr('data-value');
               deleteFriend[index].style.display = 'block';
               addFriend[index].style.display = 'none';

               $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/add-friend',
                data: {user_id: user_id,},
                success: function(data) {
                // Handle successful response
                },
                error: function(xhr, status, error) {
                // Handle error response
                }
            }); 
          });

          $(".delete-friend").click(function(){
               var deleteFriend = document.getElementsByClassName('delete-friend');
               var addFriend = document.getElementsByClassName('add-friend');
               var index = $(this).attr('data-index-value')
               var user_id = $(this).attr('data-value');
               deleteFriend[index].style.display = 'none';
               addFriend[index].style.display = 'block';

               $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/delete-friend',
                data: {user_id: user_id,},
                success: function(data) {
                // Handle successful response
                },
                error: function(xhr, status, error) {
                // Handle error response
                }
            }); 
          });

     })
</script>




@if($users)
   @foreach($users as $key => $item)
   <div style="margin-bottom:20px; display:flex; justify-content: space-between; margin:15px;">
     <div>
          <img src="{{ asset('Uploads/image/'.$item->image_avatar) }}" alt="" class="avatar" style="vertical-align: middle;width: 40px;height: 40px;border-radius: 50%;">
          <a href="{{route('profile')}}" style="text-decoration: none; font-weight:900; font-size:12px" type="submit" class="name">{{$item->name}}</a>
     </div>
     <div>
          <button class="btn btn-sm add-friend" type="submit" style="background-color:#159b4b"  data-value="{{$item->id}}" data-index-value="{{$key}}" >Kết bạn</button>
          <button class="btn btn-sm delete-friend" type="submit" style="background-color:#159b4b; display:none" data-value="{{$item->id}}" data-index-value="{{$key}}" >Hủy kết bạn</button>
     </div>
</div>
   @endforeach
@endif


    

