
<x-admin.layout>

    <div class="col s12 m12 l12">
        <div id="responsive-table" class="card card card-default scrollspy">
            <div class="card-content">
                   <a
                           class="modal-trigger
                       waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-3 mb-2"
                           href="{{route('admin.scrap.index')}}"
                           >

                           Back
                       </a>
                <div class="row" style = "padding: 10px; line-height:3">
                    

                <div class="tab-content">

<div class="tab-pane active show" id="profile">
      <h6> ID: <span> {{$record->id}}</span>  </h6>
  </div>

  <div class="tab-pane active show" id="profile">
      <h6> User Name: <span> {{$record->user->name}}</span>  </h6>
  </div>

<div class="tab-pane active show" id="profile">
      <h6>  Phone: <span> {{$record->phone}}</span>  </h6>
  </div>

  <div class="tab-pane active show" id="profile">
      <h6> Zone: <span> {{$record->zone->name}}</span>  </h6>
  </div>

   <div class="tab-pane active show" id="profile">
      <h6> Schedule Date: <span> {{$record->schedule->date}}</span>  </h6>
  </div>

  <div class="tab-pane active show" id="profile">
      <h6> Schedule Time: <span> {{$record->schedule->time}}</span>  </h6>
  </div>

   <div class="tab-pane active show" id="profile">
      <h6> Create At: <span> {{$record->created_at}}</span>  </h6>
  </div>

  
  <div class="tab-pane active show" id="profile">
      <h6> Description: <span> {{ $record->scrapproducts->pluck('description')->implode(',') }}</span>  </h6>
  </div>

</div>

                </div>
            </div>

        </div>
    </div>

</x-admin.layout>


