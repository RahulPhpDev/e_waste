<x-admin.layout>
    <div class="col s12 m12 l12">
        <div id="responsive-table" class="card card card-default scrollspy">
            <div class="card-content">
                @component('partials.back-component',
                                        [
                                            'link' =>'admin.product.index'
                                        ])
                            @endcomponent
                <h4 class="card-title camel-case">
                  {{$records->name }} Inventory

                </h4>
                <div class="row">
                    <div class="col s12">
{{-- 
                             <a
                           class="modal-trigger
                       waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-3 mb-2"
                           href="{{route('admin.product.inventories.create', $records->id)}}"
                           >

                           Add {{$records->name }} Inventory
                       </a> --}}

                            <div>
                                @if ($records->product_quantity )
                                  <h5>   In Stock :{{ $records->product_quantity}} </h5>
                                @endIf
                                @if ($records->cartProduct->sum('quantity') )
                                    <h5>   In Cart :{{ $records->cartProduct->sum('quantity')}} </h5>
                                @endIf
                            </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

</x-admin.layout>
