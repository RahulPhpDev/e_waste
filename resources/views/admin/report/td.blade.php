<tr>
    <td> {{$record->id}} </td>
    <td> {{$record->scrap_num}}</td>
    <td> {{$record->user->name}}</td>
   <td> {{$record->scrapproducts[0] && $record->scrapproducts[0]->category ? $record->scrapproducts[0]->category->name : ''}} </td>
    <td> {{$record->phone}} </td>
  
    <td> 
  
    {{  $record->scrap_status }}

    </td>
     <td> {{ $record->created_at->format('d-M-Y') }} </td>
    <td>
  
    </td>



</tr>
