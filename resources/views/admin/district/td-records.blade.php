<tr>
    <td> {{$record->id}}  </td>


    <td @mouseover="open = true"  x-data="{ open: false }"  @mouseleave="open = false"> {{$record->name}}
         <i
         x-show="open"
            href="#modal1"
            onclick="fetchHindiRecord( {{$record->id}} , 'name' )"
            class="modal-trigger tiny material-icons">edit</i>




     </td>
    <td> {{$record->code}} </td>

    <td>
 <a class="modal-trigger waves-effect  waves-light btn gradient-45deg-light-blue-cyan z-depth-3  mr-3"

                    href= "{{route('admin.district.edit',$record->id  )}}">Edit</a>
       <form class="display-inline" method="POST" action={{route('admin.district.destroy', [$record->id]  )}}>
           @csrf
           @method('delete')
           <button type="submit" class="waves-effect waves-light btn gradient-45deg-light-warning-cyan z-depth-4">
               Delete
           </button>
       </form>


    </td>
</tr>


