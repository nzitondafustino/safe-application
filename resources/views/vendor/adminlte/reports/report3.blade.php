<h2>
	{{$user->station->name}} Police Station<br />
	{{$title}}<br />
	{{$date}}<br />
</h2>
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
            <tr>
                <td>{{$id->type}}</td>
                <td>{{$id->number}}</td>
                <td>{{$id->owner}}</td>
                <td>{{$id->category}}</td>
                @if($id->status == 1)
                    <td><small class="label pull-center bg-red">Hold</small></td>
                @endif
                @if($id->status == 2)
                    <td><small class="label pull-center bg-green">Released</small></td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
<br />
Done at <b>{{$user->station->name}}</b> on <b>{{date('Y-m-d')}}</b><br />
By <b>{{$user->name}}</b><br />