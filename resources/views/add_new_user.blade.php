<html>
    <head>
        <title>ADD NEW USER</title>
    </head>
    <body>
        <h1><b>ADD NEW USER</b></h1>
        <form action="">
            <div>
                <label for="">Enter User Name:</label>
                <input type="text" name="user_name" id="">
            </div>
            <div>
                <label for="">Enter Use Age:</label>
                <input type="text" name="user_age" id="">
            </div>
            <div>
                <label for="">Enter State:</label>
                <select name="state" id="state" class="form-control select" >
                    <option value="" selected>{{ trans('Select State') }}</option>
                    @foreach($states as $state)
                        <option value="{{$state->id}}">{{ trans($state->name) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="">Enter City:</label>
                <select name="city" id="city" class="form-control select" >
                    <option value="" selected>{{ trans('Select City') }}</option>
                    @foreach($cities as $city)
                        <option value="{{$city->id}}">{{ trans($city->name) }}</option>
                    @endforeach
                </select>
            </div>
        </form>
        
    </body>
</html>

@section('javascript')
<script>
    // Filter city based on selected state 
    $(document).delegate('#state','change',function(){    
        var stateId = $(this).val();
        console.log(stateId);
        if (stateId != '') {
            $.ajax({
                url: URL_BASE + "/getcity",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                data: {
                    "id": stateId
                },
                success: function(response) {
                    if (response.cities != "") {
                        $("#city").html(response.cities);
                    }
                    jQuery('.select').select2();
                }
            });
        } else {
            $("#city").html("<option value=''>" + select_city_msg + " </option>");
        }
    });
</script>

@endsection