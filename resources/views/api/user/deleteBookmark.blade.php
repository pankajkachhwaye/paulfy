<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Api-Panel</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Jquery Core Js -->
    <script src="{{URL::asset('public/plugins/jquery/jquery.min.js')}}"></script>


</head>
<body>

<h1>
    URL::   {{url('/').'/api/deleteBookmarks'}}

</h1>
<form method="POST" enctype="multipart/form-data" action="{{url('/api/deleteBookmarks')}}" >



    Delete Bookmark (bookmark_id):: <input type="text" name="bookmark_id">

    <br/>

    <br/>
    Select User (user_id) ::  *<select name="user_id">
        <option>--select user--</option>
        @foreach($users as $user)
            <option value="{{$user->id}}">{{$user->email}}</option>
        @endforeach

    </select>
    <br/>
    <br/>



    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">Submit</button>

</form>

</body>
</html>