<tr>
    <td> {{$record->id}} </td>
    <td> {{$record->scrap_num}}</td>
    <td> {{$record->user->name}}</td>
    <td> {{$record->category->name}} </td>
    <td> {{$record->phone}} </td>
  
    <td> 
  
    {{  $record->scrap_status }}

    </td>
    <td> {{ $record->created_at->format('d-M-Y') }} </td>
    <td>
    @if($record->status == 0)
        <form class="display-inline" method="POST" action={{route('admin.scrap.approval', [$record->id]  )}}>
            @csrf
            @method('patch')
                <select name ="status">
                    <option> Select </option>
                    <option value = "1"> Approve </option>
                    <option value = "2"> Discard </option>
                </select>

            <button type="submit" class="btn-small">
                Update
            </button> 
       </form>
       @endif
    </td>



    <td>
        <a   class="modal-trigger waves-effect  waves-light btn gradient-45deg-light-blue-cyan z-depth-3  mr-3 btn-small" href="{{route('admin.scrap.show', [$record->id] )}}">
            Details
        </a>
    </td>
</tr>
