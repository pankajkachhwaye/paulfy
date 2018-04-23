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
    URL::   {{url('/').'/api/login'}}

</h1>
<form method="POST" enctype="multipart/form-data" action="{{url('/api/login')}}" >



    User Name or Email (value) ::*<input type="text"  name="value" >
    <br />
    <br />

    Password(password) ::  * <input type="password" name="password">
    <br />
    <br />
    Device Type(device_type) ::  * <select name="device_type">
        <option value="android">android</option>
        <option value="ios">ios</option>
        <option value="web">web</option>
    </select>
    <br />
    <br />
    Device Token(device_token) ::<input type="text"  name="device_token" >
    <br />
    <br />


    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">Submit</button>

</form>
<script type="text/javascript">
    $(document).ready(function () {

        $(document).on('click','#add_qulaification' ,function () {
            var counter = parseInt($(this).attr('data-counter'));
            $(this).attr('data-counter',+counter+1);
            var clone = $(this).prev().clone();
            clone.find('input[type=text]').val('');
            $(this).before(clone);

        });

        $(document).on('click','#remove_qulaification' ,function () {
            var counter_rom = parseInt($(this).prev().attr('data-counter'));
            if(counter_rom > 1){
                $(this).prev().prev().remove();
                $(this).prev().attr('data-counter',+counter_rom-1);
            }
        });

        $(document).on('click','input[name=work_experience]' ,function () {
            if ($("#freasher").is(":checked")) {
                $('.experience_cadidate').hide()
            }

            if ($("#experience").is(":checked")) {
                $('.experience_cadidate').show()
            }


        });

    });

</script>

</body>
</html>