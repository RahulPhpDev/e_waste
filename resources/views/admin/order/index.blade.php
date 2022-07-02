<x-admin.layout>
    <div class="col s12 m12 l12">
        <div id="responsive-table" class="card card card-default scrollspy">
            <div class="card-content">
                <h4 class="card-title camel-case">
                   Order

                </h4>
                
                <div class="row">
                    <div class="col s6 display-content">

                         
                            @foreach($records as $record)
                            <div class="order-header">

                                <a 
                                class="btn gradient-45deg-light-blue-cyan waves-effect waves-light btn-small-custom"
                                href = {{route('admin.order.detail', $record->id)}}
                                > Details </a>

                                  @include('admin.order.order-info', [ 'title' => 'User', 'value' => $record->user->name])
                                  @include('admin.order.order-info', [ 'title' => 'Order Num', 'value' => $record->order_num])
                                  @include('admin.order.order-info', [ 'title' => 'Product', 'value' => $record->product->name])
                                  @include('admin.order.order-info', [ 'title' => 'Created At', 'value' => $record->created_at])
                                  @include('admin.order.order-info', 
                                  [ 
                                     'title' => 'Amount <sup class="text-small"> (qua * amount) </sup>',
                                     'value' => "<span class='text-sm'> $record->quantity  *  $record->price  = </span>". $record->quantity * $record->price. "</span> ",
                                     ]
                                  )
                                  @include('admin.order.order-info', [ 'title' => 'Status', 'value' => $record->order_status])

                               {{-- 1. if order is accept send the dispatch or cancel --}}
                               {{-- action={{route('admin.product.update', $record->id)}}> --}}
                               @if($record->status === 1)
                              <form method="post" enctype="multipart/form-data" action={{route('admin.order.update', $record->id)}}>
                                @csrf
                                @method('PUT')
                                   @includeWhen($record->status === 1 , 'admin.order.change-status',[  'record' => $record])
                                   <div class = "info " style ="margin-top:20px">
                                      <button  class="btn cyan waves-effect waves-light" type="submit" name="action">Update</button>
                                   </div>
                              </form> 
                              @endif
                              

                    </div>
                            @endforeach

                         <div style="width:30%;"> {{$records->links()}} </div>

                            

                </div>
            </div>

        </div>
    </div>




    @push('css')
    <style>
        .order-header {
                margin-inline: 1rem;
            box-shadow: 1px 1px 11px;
            padding: 1.5rem;
               display: inline-block;
            position: relative;
            margin-bottom: 1.2rem;
        }
        .order-info {
            padding-top:  0.2rem;
            padding-bottom:  0.2rem;
        }
        .title {
                width: 37%;
                display: inline-block;
                text-align: end;
        }
        .order-info span {
            font-size: 16px;
            letter-spacing: 0.5px;
            margin-left: 10px;
        }
        .info {
            position: relative;
        }
        .order-info::after {
            content: '';
            border-bottom: 1px dashed #e1e1e1;
            width: 75%;
            position: absolute;
            right: 2rem;
            top: 3rem;
            margin-left: 7rem;
}
.display-content {
    display: contents;

}

</style>
    @endpush

</x-admin.layout>

