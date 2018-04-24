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
    URL::   {{url('/').'/api/register'}}

</h1>
<form method="POST" enctype="multipart/form-data" action="{{url('/api/getnewsByCategoriesId')}}" >



    <br/>
    Device Type(device_type) ::  * <select name="categories_id">

        @foreach($categories as $categories)


        <option value="{{$categories->id}}">{{$categories->name}}</option>
            @endforeach

    </select>
    <br/>
    <br/>



    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">Submit</button>

</form>

</body>
</html>