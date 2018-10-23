
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
<?php
$penalty=0;
?>
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
         <?php $penalty+=(int)$vehicle->amande ?>
            <tr>
                <td>
                    {{$vehicle->type==1?'Car':''}}
                    {{$vehicle->type==2?'Motocycle':''}}
                    {{$vehicle->type==3?'Bicycle':''}}
                </td>
                <td>{{$vehicle->plate}}
                </td>
                <td>{{$vehicle->owner}}</td>
                <td>{{$vehicle->amande}}</td>
                <td>{{$vehicle->status==1?'Hold':''}}
                    {{$vehicle->status==2?'Released':''}}
                    {{$vehicle->status==3?'Transfer to the court':''}}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<h3>Total penalty:{{$penalty}} RwF</h3>
<br />
Done at <b>{{$user->station->name}}</b> on <b>{{date('d/m/Y')}}</b><br />
By <b>{{$user->name}}</b><br />