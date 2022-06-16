<tr>
    <td> {{$record->id}} </td>
    <td> {{$record->name}}</td>
    <td> {{$record->unit->name}} </td>
    <td> {{$record->category->name}} </td>
    <td> {{$record->price}} </td>


    <td>

         <a
             class="modal-trigger waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-3  mr-3"
             href= "{{route("admin.product.inventories.index", $record->id )}}">



         Inventory</a>
    </td>


    <td>
        <button class= "success btn-sm {{ $record->active ? ' green': ' red' }}">
         @if( $record->active ) Active @else Inactive @endif
        </button>
    </td>
    <td>
             <a
             class="modal-trigger waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-3  mr-3"
             href= "{{route('admin.product.edit',$record->id  )}}">Edit</a>

    </td>
</tr>
