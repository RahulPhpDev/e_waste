<tr class = "record_tr" id ="recrod_{{ $record->id }}" data-district = {{$record->district->name }}  >
    <td> {{$record->id}} </td>
    <td> {{$record->name}} </td>
    <td> {{$record->zip_code}} </td>
    <td> {{$record->lattitude}} </td>
    <td> {{$record->longitute}} </td>
    <td class="district_column" data-type = "district"> {{$record->district->name }} </td>
    <td> {{$record->landmark }} </td>



    <td>
 <a
 class="modal-trigger waves-effect  waves-light btn gradient-45deg-light-blue-cyan z-depth-3  mr-3"
 href= "{{route('admin.zone.edit',$record->id  )}}">Edit</a>
       <form class="display-inline" method="POST" action={{route('admin.zone.destroy', [$record->id]  )}}>
           @csrf
           @method('delete')
           <button type="submit" class="waves-effect waves-light btn gradient-45deg-light-warning-cyan z-depth-4">
               Delete
           </button>
       </form>


    </td>
</tr>
