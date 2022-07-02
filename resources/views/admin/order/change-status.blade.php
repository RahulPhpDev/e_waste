                <div class="order-info display-inline-block " x-data="{ status: false}" >
                    <div style ="display: flex;">    
                        <h6 class="display-inline-block title ">
                            Change Status :
                        </h6>
                     

                        <select
                            name="status"
                            x-model="status" 
                        >
                            <option value = ""> Select Option </option>
                            <option value ="2"> Dispatched </option>
                            <option value ="3"> Rejected </option>
                            
                        </select>
                    </div>
                        

                         <div x-show="status == 2"  class="order-info display-inline-block " style ="display: flex;">
                            <h6 class="display-inline-block title ">
                                Schedule At:
                            </h6>
                           <input type="text" class="datepicker" name ="dispatch_date">
                        </div>  

                        <div x-show="status == 3"  class="order-info display-inline-block " style ="display: flex;">
                            <h6 class="display-inline-block title ">
                               Reason:
                            </h6>
                            <input id="icon_prefix2" type="text" class = 'validate' name = 'reason'>
                        </div> 

                    </div>
 @push('scripts')
    <script>
        $(document).ready( function () {
            console.log('dfs');
               $('.datepicker').pickadate({
                format: 'yyyy-mm-dd',
                selectMonths: true, // Enable Month Selection
                selectYears: 1 // Creates a dropdown of 10 years to control year
                }); 
        })

        </script>
    @endpush





