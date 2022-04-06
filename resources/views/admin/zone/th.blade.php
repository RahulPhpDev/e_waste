@foreach($tableHeads as $th)
    <th for ="{{ $th }}"> {{ $th }}
    @if($th === 'District')
        <br>
        <select id = "district_filter"  class="browser-default"> 
            <option> 1 </option>
            <option> 1 </option>
            <option> 1 </option>
        </select>
        @endif
    </th>
@endforeach
