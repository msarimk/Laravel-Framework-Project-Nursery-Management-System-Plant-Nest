@foreach($tools as $tool)
    <div class="p-2" ><a href="{{route('toolDetails',$tool->id)}}">{{ $tool->name }} (Tool)</a></div>
@endforeach

@foreach($plants as $plant)
    <div class="p-2" ><a href="{{route('plantDetails',$plant->id)}}">{{ $plant->name }} (Plant)</a></div>
@endforeach