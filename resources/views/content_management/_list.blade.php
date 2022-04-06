<div class="ajax-listing">
    <div class="table-responsive">
        <table class="display table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th class="text-center">Name</th>
                <th class="text-center">Slug</th>
                <th class="text-center">Content</th>
                <th class="text-center" style="min-width: 90px">Action</th>
            </tr>
            </thead>
            <tbody>
            @if($items->count())
                @foreach($items as $item)
                    <tr>
                        <td>{{$item['name']}}</td>
                        <td>{{$item['slug']}}</td>
                        <td class="text-center">{{ $item['content'] }}</td>
                        <td class="text-center">
                            <a href="{{url('content-management/'.$item->id)}}" class="text-success">
                                <i class="nav-icon i-Eye1 font-weight-bold"></i>
                            </a>
                            <a href="{{url('content-management/'.$item->id.'/edit')}}" class="text-success">
                                <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="9" align="center">
                        <strong class="red-text">Record not found</strong>
                    </td>
                </tr>
            @endif

            </tbody>
        </table>
    </div>
    <div class="pagination-container">
        {{ $items->links() }}
    </div>
</div>
