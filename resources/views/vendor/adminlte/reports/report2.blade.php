<h2>
	{{$user->station->name}} Police Station<br />
	{{$title}}<br />
	{{$date}}<br />
</h2>
<table id="accidents" class="display" style="border-collapse: collapse;" border="1" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>Type</th>
            <th>Plate</th>
            <th>Owner</th>
            <th>Penalities</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($vehicles as $vehicle)
            <tr>
                <td>{{$vehicle->type}}</td>
                <td>{{$vehicle->plate}}</td>
                <td>{{$vehicle->owner}}</td>
                <td>{{$vehicle->amande}}</td>
                @if($vehicle->status == 1)
                    <td><a href="#" onclick="$('#rowidH').val('{{ $vehicle->id }}');$('#myModalLabel4').html('{{ $vehicle->type }} {{ $vehicle->plate }} is Hold')" data-toggle="modal" data-target="#hold"><small class="label pull-center bg-red">Hold</small></a></td>
                @endif
                @if($vehicle->status == 2)
                    <td><a href="#" onclick="$('#rowidR').val('{{ $vehicle->id }}');$('#myModalLabel3').html('{{ $vehicle->type }} {{ $vehicle->plate }} is Released')" data-toggle="modal" data-target="#released"><small class="label pull-center bg-green">Released</small></a></td>
                @endif
                @if($vehicle->status == 3)
                    <td><a href="#" onclick="$('#rowid').val('{{ $vehicle->id }}');$('#myModalLabel2').html('{{ $vehicle->type }} {{ $vehicle->plate }} is transfered')" data-toggle="modal" data-target="#transfered"><small class="label label-warning pull-center">Transfered</small></td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
<br />
Done at <b>{{$user->station->name}}</b> on <b>{{date('Y-m-d')}}</b><br />
By <b>{{$user->name}}</b><br />