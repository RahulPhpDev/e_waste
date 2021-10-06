<x-admin.layout>
    <div class="col s12 m12 l12">
        <div id="responsive-table" class="card card card-default scrollspy">
            <div class="card-content">
                <h4 class="card-title camel-case">Edit Video </h4>
                <div class="row">
                    <div class="col s12">


<div>
    <div  role="document">
        <div >

            <div >

                <form method="post" enctype="multipart/form-data" action={{route('admin.video.update', $record->id)}}>
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="input-field col m6 s6">
                             <label for="icon_prefix2" class="active"> Title </label>
                            <input id="icon_prefix2" type="text"  value="{{ $record->title }}"  class = 'validate' name = 'title'>

                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                      </div>
                      

                    <div class="row">
                        <div class="input-field col m6 s6">
                             <label for="icon_prefix2" class="active"> Url </label>
                            <input id="icon_prefix2" type="text"  value="{{ $record->url }}"  class = 'validate' name = 'url'>

                            @error('url')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                      </div>  

                        
                      <div class="row">
                        <div class="input-field col m4 s12">
                            <div class="input-field col s12">
                                <button  class="btn cyan waves-effect waves-light" type="submit"
                                        name="action">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin.layout>
