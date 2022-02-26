<tr>
    <td> {{$record->id}} </td>
    <td @mouseover="open = true"  x-data="{ open: false }"  @mouseleave="open = false"> 
        
        {!! Str::limit($record->name, 20) !!}

         <i
         x-show="open"
            href="#modal1"
            onclick="fetchHindiRecord( {{$record->id}} , 'name' )"
            class="modal-trigger tiny material-icons">edit</i>
    </td>
    <td @mouseover="des_open = true" x-data ="{des_open: false}"
    @mouseleave="des_open = false"
     >
        {!! Str::limit($record->description, 15) !!}

       <i
         x-show="des_open"
            href="#modal1"
            onclick="fetchHindiRecord( {{$record->id}} , 'description' )"
            class="modal-trigger tiny material-icons">edit</i>
  </td>
    <td>
         @if($record->image && $record->image->url)
             <img class="img" src = "{{asset('storage/'.$record->image->url)}}" height="100" width="100" />
            @endIf

<a   class="modal-trigger waves-effect  waves-light btn gradient-45deg-light-blue-cyan z-depth-3  mr-3 btn-small" href="{{route('admin.category.image-edit', [$record->id] )}}">
        Edit
    </a>
       
    </td>
    <td>
        <div  class="flex">
 <a class="modal-trigger waves-effect  waves-light btn gradient-45deg-light-blue-cyan z-depth-3  mr-3 btn-small"

                    href= "{{route('admin.category.edit',$record->id  )}}">Edit</a>
       <form class="display-inline" method="POST" action={{route('admin.category.destroy', [$record->id]  )}}>
           @csrf
           @method('delete')
           <button type="submit" class="waves-effect btn-small waves-light btn gradient-45deg-light-warning-cyan z-depth-4">
               Delete
           </button>
       </form>

       </div>
    </td>
</tr>
