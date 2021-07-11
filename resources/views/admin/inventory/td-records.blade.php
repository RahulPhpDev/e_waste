<tr>
    <td> {{$record->id}} </td>
    <td> {{$record->type->name}} </td>
    <td> {{$record->quantity}}</td>
    <td> {{$record->price}} </td>



    <td>
        <button class= "success btn-sm {{ $record->approved ? ' green': ' red' }}">
         @if( $record->active ) Approved @else Not Approved @endif
        </button>
    </td>
     <td>
        @if($record->image && $record->image->url)
         <img class="img" src = "{{asset('storage/'.$record->image->url)}}" height="200" width="200" />
        @endIf
    </td>
    <td>
             <a
             class="btn-small-custom modal-trigger waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-3  mr-3"
             href= "{{route('admin.inventories.edit',$record->id  )}}">Edit</a>

          <form class="display-inline" method="POST" action={{route('admin.inventories.destroy', [$record->id]  )}}>
           @csrf
           @method('delete')
           <button type="submit" class="btn-small-custom waves-effect waves-light btn gradient-45deg-light-warning-cyan z-depth-4 materialize-red">
               Delete
           </button>
       </form>

    </td>
</tr>
