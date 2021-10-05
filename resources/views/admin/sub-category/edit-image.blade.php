<x-admin.layout>
    <div class="col s12 m12 l12">
        <div id="responsive-table" class="card card card-default scrollspy">
            <div class="card-content">
                <h4 class="card-title camel-case">Edit Sub Category Image </h4>
                <div class="row">
                    <div class="col s12">


<div>
    <div  role="document">
        <div >

            <div >

                <form method="post" enctype="multipart/form-data" action={{route('admin.sub-category.update-image', $record->id) }} >
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="input-field col m6 s6">
                             <label for="icon_prefix2" class="active"> Image </label>
                            <input id="icon_prefix2" type="file"  value="{{ $record->name }}"  class = 'validate' name = 'image'>

                           
                        </div>


                        <
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
