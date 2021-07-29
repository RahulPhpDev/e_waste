<x-admin.layout>
    <div class="col s12 m12 l12">
        <div id="responsive-table" class="card card card-default scrollspy">
            <div class="card-content">
                <h4 class="card-title camel-case">  Why We </h4>
                <div class="row">
                    <div class="col s12">


<div>
    <div  role="document">
        <div >


                <form method="post" enctype="multipart/form-data" action={{route('admin.why-we.update', $page->id)}}>
                     @method('PUT')
                    @csrf

                    <div class="row">

                                        <textarea name="description" id = "description"  required="true">{{$page->description}}</textarea>

                        <div class="input-field col m4 s12" >
                            <div class="input-field col s12">
                                <button  class="btn cyan waves-effect waves-light" type="submit"
                                        name="action">Update</button>
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
</x-admin.layout>
