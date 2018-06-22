<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Api-Panel</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Jquery Core Js -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>

</head>
<body>
<script>
    var APP_URL = {!! json_encode(url('/')) !!}
</script>
<h1>
    URL::   {{url('/').'/api/upvoteOnComment'}}

</h1>
<form method="POST" enctype="multipart/form-data" action="{{url('/api/upvoteOnComment')}}" >



    <br/>
    <br/>
    Select NEws (news_id) ::  * <select name="news_id" id="news">
        <option>--select news--</option>
        @foreach($news as $new)


            <option value="{{$new->id}}">{{$new->title}}</option>
        @endforeach

    </select>
    <br/>

    <br/>

    Comment(comment_id) ::  * <select name="comment_id" id="comment_id">
        <option>--select news--</option>

    </select>
    <br/>

    <br/>
    Select User (user_id) ::  * <select name="user_id">
        <option>--select user--</option>
        @foreach($users as $user)
            <option value="{{$user->id}}">{{$user->email}}</option>
        @endforeach

    </select>
    <br/>
    <br/>



</textarea>

    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">Submit</button>

</form>
<script>
    $(document).ready(function () {
        console.log(APP_URL);
        $(document).on('change','#news',function () {
            var id = $('#news option:selected').val()
            $('#comment_id').children().remove();
            $.ajax({
                type: "GET",
                url: APP_URL + '/api-details/get-commet-news/' + id,
                dataType: 'json',
                data: id,
                success:function (resposne) {
                    resposne.forEach(function (value,index) {
                        var   template ='<option value="'+value.id+'">'+value.comment+'<option>'
                        $('#comment_id').append(template);
                    })

                }
            })
        })
    })
</script>
</body>
</html>
