<tr>
    <td> {{$record->id}} </td>
    <td @mouseover="open = true"  x-data="{ open: false }"  @mouseleave="open = false">
        {{$record->title}}
         <i
         x-show="open"
            href="#modal1"
            onclick="fetchHindiRecord( {{$record->id}} , 'title' )"
            class="modal-trigger tiny material-icons">edit</i>

     </td>
    <td @mouseover="des_open = true" x-data ="{des_open: false}"
    @mouseleave="des_open = false"> {!! Str::of($record->description)->limit(20) !!}
     <i
         x-show="des_open"
            href="#modal1"
            onclick="fetchHindiRecord( {{$record->id}} , 'description' )"
            class="modal-trigger tiny material-icons">edit</i>
  </td>



   

    <td>

       <form class="display-inline" method="POST" action={{route('admin.event.destroy', [$record->id]  )}}>
           @csrf
           @method('delete')
           <button type="submit" class="waves-effect waves-light btn gradient-45deg-light-warning-cyan z-depth-4 btn-small-custom">
               Delete
           </button>
       </form>


    </td>
</tr>
