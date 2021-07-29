<tr>
    <td> {{$record->id}} </td>
    <td> {{$record->title}} </td>
    <td> {!! Str::of($record->description)->limit(20) !!} </td>




        @include( 'admin/event/image-modal', ['record' => $record])
        @include( 'admin/event/video-modal', ['record' => $record])



    <td>
             <a class="waves-effect waves-light btn modal-trigger btn-small-custom" href="#modal_{{$record->id}}">Banner</a>



        <a class="waves-effect waves-light btn modal-trigger btn-small-custom" href="#modal_video_{{$record->id}}">
@if(!$record->video) Add @endIf
        Video</a>

    </td>

    <td>
 <a class="modal-trigger waves-effect  waves-light btn gradient-45deg-light-blue-cyan z-depth-3  mr-3 btn-small-custom"
     href= "{{route('admin.event.edit',$record->id  )}}">Edit</a>
       <form class="display-inline" method="POST" action={{route('admin.event.destroy', [$record->id]  )}}>
           @csrf
           @method('delete')
           <button type="submit" class="waves-effect waves-light btn gradient-45deg-light-warning-cyan z-depth-4 btn-small-custom">
               Delete
           </button>
       </form>


    </td>
</tr>
