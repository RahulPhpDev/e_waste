<x-admin.layout>
    <div class="col s12 m12 l12">
        <div id="responsive-table" class="card card card-default scrollspy">
            <div class="card-content">
                <h4 class="card-title camel-case">Edit Article </h4>
                <div class="row">
                    <div class="col s12">


<div>
    <div  role="document">
        <div >

            <div >

                <form method="post" enctype="multipart/form-data" action={{route('admin.article.update', $record->id)}}>
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="input-field col m6 s6">
                            <label for="icon_prefix2" class="active"> Title </label>
                            <input id="icon_prefix2" type="text" class = 'validate' value="{{ $record->title }}"   name = 'title'>

                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">

                        <div class="input-field col m12 s12">
                              <label for="description" class="active"> Description</label>
                              <textarea id = "description" name = "description" id="message5" class="materialize-textarea">{{$record->description}}</textarea>

                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                    </div>

                     <div class="input-field col m4 s12">
                            <div class="input-field col s12">
                                <button  class="btn cyan waves-effect waves-light" type="submit"
                                        name="action">Update</button>
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
