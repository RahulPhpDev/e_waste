<x-admin.layout>
    <div class="col s12 m12 l12">
        <div id="responsive-table" class="card card card-default scrollspy">
            <div class="card-content">
                <h4 class="card-title camel-case">
                     Why We

                </h4>
                <div class="row">
                       @if (!$record)
                    <div class="col s12">
                          <a
                           class="modal-trigger
                       waves-effect pull-left waves-light btn gradient-45deg-light-blue-cyan z-depth-3 mb-2"
                           href="{{route('admin.why-we.create')}}"
                           >

                        Add Why We
                       </a>


                    </div>
                    @endIf
                </div>


                   <div class="row">
                    <div class="col s12 mt-7">
                        @if ($record)
                         <textarea name="description" disabled id = "description"  required="true">

                              {!! optional($record)->description !!}
                         </textarea>
                         @endIf
                       </div>
                   </div>

                 @if($record)
                 <div class="row">
                    <div class="col s12 mt-7">
                          <a
                           class="modal-trigger waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-3"
                           href="{{route('admin.why-we.edit', $record->id)}}"
                           >

                        Edit
                       </a>


                    </div>
                </div>
                @endIf


            </div>

        </div>
    </div>

</x-admin.layout>
