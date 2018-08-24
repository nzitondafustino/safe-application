<h2>
	{{$station[0]->name}} Police Station<br />
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
            <th>IDs</th>
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
    			<td class="text-center"><a href="/vehicle/{{ $accident->id }}"><span class="label label-primary">{{$accident->vehicles}}</span></a></td>
    			<td class="text-center"><a href="/ids/{{ $accident->id }}"><span class="label label-primary">{{$accident->identification}}</span></a></td>
    		</tr>
    	@endforeach
    </tbody>
</table>
<br />
Done at <b>{{$station[0]->name}}</b> on <b>{{date('Y-m-d')}}</b><br />
By <b>{{$station[0]->user}}</b><br />