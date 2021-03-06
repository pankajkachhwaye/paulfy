<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Api-Panel</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
            $( "#accordion" ).accordion();
        });
    </script>
</head>
<body>

<div id="accordion">
    <h3>User</h3>
    <div>
        <p><a href="{{url('/api-details/register-form')}}">User Register</a></p>
        <p><a href="{{url('/api-details/login-form')}}">User Login</a></p>
        <p><a href="{{url('/api-details/getAllCategories')}}">getAllCategories</a></p>
        <p><a href="{{url('/api-details/getnewsByCategoriesId')}}">getnewsByCategoriesId</a></p>
        <p><a href="{{url('/api-details/getnewsLikesComment')}}">getnewsLikesComment <span style="color: red">New</span></a></>
        <p><a href="{{url('/api-details/likeNews')}}">likeNews</a></p>
        <p><a href="{{url('/api-details/commentOnNews')}}">commentOnNews</a></p>
        <p><a href="{{url('/api-details/upvoteOnCommentForm')}}">Upvote on comment<span style="color: red">New</span></a></p>
        <p><a href="{{url('/api-details/replyOnCommentForm')}}">Reply On Comment <span style="color: red">New</span></a></p>
        <p><a href="{{url('/api-details/bookmarkNews')}}">bookmarkNews</a></p>
        <p><a href="{{url('/api-details/deleteComment')}}">deleteComment</a></p>
        <p><a href="{{url('/api-details/deleteBookmark')}}">deleteBookmark</a></p>
        <p><a href="{{url('/api-details/getAllBokkmarkNews')}}">getAllBokkmarkNews</a></p>
    </div>

</div>




</body>
</html>