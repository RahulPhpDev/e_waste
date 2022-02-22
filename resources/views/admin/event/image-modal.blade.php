
<div id="modal_{{$record->id}}" class="modal">
        <div class="modal-content center">
            @if ($record->image && $record->image->url)
             <img class="img" src = "{{asset('storage/'.$record->image->url)}}" height="200" width="200" />
             @else
                No Image upload
             @endIf
        </div>
        <div class="row center">

            <h4>  @if ($record->image && $record->image->url) Update @else Add @endIf Image </h4>
            <form method="post" enctype="multipart/form-data" action={{route('admin.article.image.store', $record->id)}}>
                    @csrf

                    <div class = "row">

                    <div class="col m6 s12 file-field input-field">
                        <div class="btn float-right">
                            <span>Banner</span>
                            <input type="file" name="banner">
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
               @if ($record->image && $record->image->url)
             <form class="display-inline" method="POST" action={{route('admin.article.destroy.image', [$record->id]  )}}>
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