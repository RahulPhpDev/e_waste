<div id="modal_video_{{$record->id}}" class="modal">
        <div class="modal-content center">
          <h4> @if(!$record->video) Add @endIf Video</h4>
          @if($record->video)
           <video width="320" height="240" controls>
                  <source src="{{asset('storage/'.$record->video)}}" type="video/mp4">
                  <source src="{{asset('storage/'.$record->video)}}"  type="video/ogg">
                Your browser does not support the video tag.
            </video>
        @endIf
        </div>

          <div class="row center">
          	 <form method="post" enctype="multipart/form-data" action={{route('admin.article.video.store', $record->id)}}>
                    @csrf

                    <div class = "row">

                    <div class="col m6 s12 file-field input-field">
                        <div class="btn float-right">
                            <span>Video</span>
                            <input type="file" name="video">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                    </div>

                            <div class="input-field col m4 s12">
                                <div class="input-field col s12">
                                    <button  class="btn cyan waves-effect waves-light btn-small-custom" type="submit"
                                            name="action">Update</button>
                                </div>
                            </div>

                     </div>

                      </form>

        </div>


        <div class="modal-footer">
  @if($record->video)
                  <form class="display-inline" method="POST" action={{route('admin.article.destroy.video', [$record->id]  )}}>
                   @csrf
                   @method('delete')
                   <button type="submit" class="waves-effect waves-light btn gradient-45deg-light-warning-cyan z-depth-4 btn-small-custom">
                       Delete
               </button>
           </form>
           @endIf
          <a href="#!" class=" modal-action red modal-close waves-effect waves-danger btn-flat">Close</a>
        </div>
  </div>