<tr>
    <td> {{$record->id}} </td>
    <td> {{$record->name}}

    </td>
    <td> {{$record->email}} </td>
    <td> {{$record->phone}} </td>
    <td>
        <button class= "success btn {{ $record->active ? ' green': ' red' }}">
         @if( $record->active ) Active @else Inactive @endif
        </button>


    <td>
 <a
 class="modal-trigger waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-3  mr-3"
 href= "{{route('admin.user.edit',$record->id  )}}">Edit</a>



    </td>
</tr>
