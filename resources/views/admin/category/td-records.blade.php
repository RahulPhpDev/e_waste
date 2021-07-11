<tr>
    <td> {{$record->id}} </td>
    <td> {{$record->name}} </td>
    <td> {{$record->description}} </td>

    <td>
 <a class="modal-trigger waves-effect  waves-light btn gradient-45deg-light-blue-cyan z-depth-3  mr-3"

                    href= "{{route('admin.category.edit',$record->id  )}}">Edit</a>
       <form class="display-inline" method="POST" action={{route('admin.category.destroy', [$record->id]  )}}>
           @csrf
           @method('delete')
           <button type="submit" class="waves-effect waves-light btn gradient-45deg-light-warning-cyan z-depth-4">
               Delete
           </button>
       </form>


    </td>
</tr>
