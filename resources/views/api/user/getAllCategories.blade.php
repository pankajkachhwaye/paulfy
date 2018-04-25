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
    URL::   {{url('/').'/api/getAllCategories'}}

</h1>
<form method="POST" enctype="multipart/form-data" action="{{url('/api/getAllCategories')}}">



    This is get api api just hit the url and get data

    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">Submit</button>

</form>

</body>
</html>