
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
            <th>Number</th>
            <th>Owner</th>
            <th>Category</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ids as $id)
        <?php $penalty+=(int)$id->amande ?>
            <tr>
                <td>
                    {{$id->type==1?'Licence':''}}
                    {{$id->type==2?'Immatriculation':''}}
                    {{$id->type==3?'Insurence':''}}
                </td>
                <td>{{$id->number}}</td>
                <td>{{$id->owner}}</td>
                <td>
                    {{$id->type==1?'Hold':'Released'}}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<h3>Total penalty:{{$penalty}} RwF</h3>
<br />
Done at <b>{{$user->station->name}}</b> on <b>{{date('d/m/Y')}}</b><br />
By <b>{{$user->name}}</b><br />