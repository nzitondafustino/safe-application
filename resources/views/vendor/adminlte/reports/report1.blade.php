
<h1> Republic of Rwanda<br>
    {{Auth::user()->province->name}} Province<br>
    {{Auth::user()->district->name}} District<br>
    
    @if(Auth::user()->hasAnyRole('user'))
    {{$user->station->name}} Police Station  Accidents Summary<br />
    @endif
    @if(Auth::user()->hasAnyRole('district-admin'))
    {{$user->district->name}}Police  Stations  Accidents Summary<br />
    @endif
    @if(Auth::user()->hasAnyRole('province-admin'))
    {{$user->province->name}} Police Stations Accidents Summary<br />
    @endif
    @if(Auth::user()->hasAnyRole('overall-admin'))
     All Police Stations   Accidents Summary<br />
    @endif
    

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
                        @foreach($accident->vehicles as $vehicle)
                            {{ $vehicle->plate }} <br>
                        @endforeach
                </td>
    		</tr>
    	@endforeach
    </tbody>
</table>
<br />
Done at <b>{{$user->station->name}}</b> on <b>{{date('d/m/Y')}}</b><br />
By <b>{{$user->name}}</b><br />