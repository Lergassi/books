<select name="{{$name}}" {{$attr}}>
    @foreach($items as $key => $item)
        <option value="{{$key}}" {{$value == $key ? "selected" : ""}}>{{$item}}</option>
    @endforeach
</select>
