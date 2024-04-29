<!-- resources/views/admin/dashboard.blade.php -->
<h1>User Details</h1>
<table id="user" name="user">
    <thead>
        <tr>
            <th>Name</th>
            <th>Age</th>
            <th>State</th>
            <th>City</th>
            <th>Hobbies</th>
            <!-- Add more fields as needed -->
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $user)
        <tr>
            <td>{{ $user->user_name }}</td>
            <td>{{ $user->user_age }}</td>
            <td>{{ $user->state }}</td>
            <td>{{ $user->city }}</td>
            <td>{{ $user->hobbies }}</td>

            <!-- Display more fields as needed -->
        </tr>
        @endforeach
    </tbody>

    <a href="{{route('add_user')}}">ADD NEW USER</a>
</table>



<script type="text/javascript">
	
	var countryTable = $('#user').DataTable({
			dom: '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',

            processing: false,
            language: {
            emptyTable: '<h5 class="text-center p-5 text-muted fw-light m-0">No results have been found</h5>'
            },
            scrollCollapse: true,
            responsive: true,
            lengthMenu: [50, 100, 200, 500],
            pagingType: 'simple_numbers',
            order: [[0, "asc" ]]
        });

</script>