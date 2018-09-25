<h2>
	{{$user->station->name}} Police Station<br />
	{{$title}}<br />
	{{$date}}<br />
</h2>
<table id="accidents" class="display" style="border-collapse: collapse;" border="1" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>#</th>
            <th>Date</th>
            <th>Comment</th>
            <th>Injury</th>
            <th>Dead</th>
            <th>Vehicles</th>
            <th>ID Owner</th>
            <th>IDs Number</th>
        </tr>
    </thead>
    <tbody>
    	<?php
    	$i=1;
    	?>
    	@foreach($accidents as $accident)
    		<tr>
    			<td>{{$i++}}</td>
    			<td>{{$accident->date}}</td>
    			<td >{{$accident->comment}}</td>
    			<td class="text-center"><span class="label label-warning">{{$accident->injury}}</span></a></td>
    			<td class="text-center"><span class="label bg-red">{{$accident->dead}}</span></a></td>
    			<td class="text-center">
                    <a href="/vehicle/{{ $accident->id }}">
                        @foreach($accident->vehicles as $vehicle)
                        <span class="label label-primary">
                            {{$vehicle->plate}}
                           
                        </span>
                        @endforeach
                    </a>
                </td>
                <td class="text-center">
                    <a href="/ids/{{ $accident->id }}">
                        @foreach($accident->identifications as $identification)
                        <span class="label label-primary">
                            {{ $identification->owner }} 
                            @else

                        </span>
                        @endforeach
                    </a>
                </td
    			<td class="text-center">
                    <a href="/ids/{{ $accident->id }}">
                        @foreach($accident->identifications as $identification)
                        <span class="label label-primary">
                            {{ $identification->number }} 
                        </span>
                        @endforeach
                    </a>
                </td>
    		</tr>
    	@endforeach
    </tbody>
</table>
<br />
Done at <b>{{$user->station->name}}</b> on <b>{{date('Y-m-d')}}</b><br />
By <b>{{$user->name}}</b><br />