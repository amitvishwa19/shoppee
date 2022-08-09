
<h5><img src="{{setting('app_icon')}}" alt="" height="30"></h5>

Dear {{$data->client->name}},

<br>

@if($data->description)
    <p>{{$data->description}}</p>
@endif


@if($data->notes)
    <p>{{$data->notes}}</p>
@endif

@if($data->requirements->count() > 0)
    <ul>
        @foreach($data->requirements as $requirement)
            <li>{{$requirement->requirement}}</li>
        @endforeach
    </ul>
@endif

<p>Feel free to revert or call us in case of ony doubts or require any clarifications.</p>

Regards <br>
Team Devlomatix <br>
Email: info@devlomatix.com <br>
Mb: 9712340450

{{-- Data : {{$data['title']}} --}}
