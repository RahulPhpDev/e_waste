<x-admin.layout>
    <div class="col s12 m12 l12">
        <div id="responsive-table" class="card card card-default scrollspy">
            <div class="card-content">
                <h4 class="card-title camel-case">  Add Article </h4>
                <div class="row">
                    <div class="col s12">


<div>
    <div  role="document">
        <div >

            <div >

                <form method="post" enctype="multipart/form-data" action={{route('admin.article.store')}}>
                    @csrf
                    <div class="row">
                        <div class="input-field col m6 s6">
                             <label for="icon_prefix2" class="active"> Title </label>
                            <input id="icon_prefix2" type="text" class = 'validate' name = 'title'>

                            @error('title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class = "row">

                        <div class="input-field col m12 s12">


                              <textarea id = "description" name = "description" id="message5" class="materialize-textarea"></textarea>

                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>



                    </div>

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

                       <div class="col m6 s12 file-field input-field">
                        <div class="btn float-right">
                            <span>Video</span>
                            <input type="file" name="video">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                    </div>


                    </div>

                         <div class = "row">
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
