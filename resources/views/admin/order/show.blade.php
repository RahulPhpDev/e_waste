<x-admin.layout>
  <div class="row ">
            <div class="col-lg-6 col-md-12">
              <div class="card">
                @component('partials.back-component',
                        [
                            'link' =>'admin.order.index'
                        ])
               @endcomponent

                <div class="card-body ml-4">
                  <div class="tab-content">
                    <div class="tab-pane active show" id="profile">
                        <h6> Order Num: <span> {{$record->order_num}}</span>  </h6>
                    </div>

                     <div class="tab-pane active show" id="profile">
                        <h6> User: <span> {{$record->user->name}}</span>  </h6>
                    </div>

                     <div class="tab-pane active show" id="profile">
                        <h6> Phone Number : <span> {{$record->orderAddress->phone}}</span>  </h6>
                    </div>
                    @if ($record->orderAddress->alternative_phone)
	                     <div class="tab-pane active show" id="profile">
	                        <h6> Name: <span> {{$record->orderAddress->alternative_phone}}</span>  </h6>
	                    </div>
                    @endif

                     <div class="tab-pane active show" id="profile">
                        <h6> pin_code: <span> {{$record->orderAddress->pin_code}}</span>  </h6>
                    </div>

                     <div class="tab-pane active show" id="profile">
                        <h6> Address: <span> {{$record->orderAddress->address}}</span>  </h6>
                    </div>

                     <div class="tab-pane active show" id="profile">
                        <h6> landmark: <span> {{$record->landmark}}</span>  </h6>
                    </div>

                     <div class="tab-pane active show" id="profile">
                        <h6> Product: <span> {{$record->product->name}}</span>  </h6>
                    </div>

                    @if($record->product->image && $record->product->image->url)
                     <div class="tab-pane active show" id="profile">
                        <img  width="auto" style="max-height: 200px" src ="/storage/{{$record->product->image->url}}"/>
                    </div>

                    @endif


                  </div>
                </div>
              </div>
            </div>

          </div>

          @push('css')
          <style type="text/css">
              .tab-pane  {
                margin-bottom: 1.5rem;
              }
              .tab-pane:after {
                content: '';
                width: 60%;
                height: 2px;
                border-bottom: 1px dashed #ddd;
                position: absolute;
              }
          </style>
          @endpush

        </x-admin.layout>