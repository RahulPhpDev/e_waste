<tr>
    <td> {{$record->id}} </td>
    <td> {{$record->user->name}}</td>
    <td> {{$record->category->name}} </td>
    <td> {{$record->phone}} </td>
  
    <td> 
    @if($record->status === 1)
    Approved
    @elseif($record->status === 2)
    Decline

    @else
    Pending

    @endif
    
    

    </td>
    <td> {{ $record->created_at->format('d-M-Y') }} </td>
    <td>
    <form class="display-inline" method="POST" action={{route('admin.scrap.approval', [$record->id]  )}}>
           @csrf
           @method('patch')
           <label>
            <input name ="status" type="checkbox"  />
                <span></span>
         </label>
           <!-- <button type="submit" class="waves-effect waves-light btn gradient-45deg-light-warning-cyan z-depth-4">
               Change approve status
           </button> -->
           <button type="submit" class="btn-small">
               Approved
           </button> 
       </form>
    </td>



    <td>
        Make Comment

        

    </td>
</tr>
