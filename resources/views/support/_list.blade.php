<div class="ajax-listing">
    <div class="table-responsive">
        <table class="display table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th>Name</th>
                <th class="text-center">User Email</th>
                <th class="text-center">Description</th>
                <th class="text-center">Status</th>
                <th class="text-center">Created At</th>
                <th class="text-center" style="min-width: 90px">Actions</th>
            </tr>
            </thead>
            <tbody>
            @if($requests->count())
                @foreach($requests as $request)

                    <tr>
                        <td>{{$request->name}}</td>
                        <td class="text-center">{{ $request->description}}</td>
                        <td class="text-center">{{ $request->client_email ?? '' }}</td>
                        <td class="text-center">{{ $request->status ? 'Closed' : 'Open' }}</td>
                        <td class="text-center">{{ $request->created_at->format('d-m-y')}}</td>
                        <td class="text-center">
                            <a href="{{url('support/'.$request->id)}}" class="text-primary">
                                <i class="nav-icon i-Eye1 font-weight-bold"></i>
                            </a>
                            @if($request->status)
                                <form id="open-form-{{$request->id}}" method="post" class="open-form ajax2 inline-block"
                                      action="{{route('support-open', $request->id )}}">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="POST">
                                    <button class="text-danger submit p-0 border-0 bg-none" type="submit" title="open">
                                        <i class="nav-icon i-Add font-weight-bold"></i>
                                    </button>
                                </form>

                            @else
                                <form id="close-form-{{$request->id}}" method="post" class="close-form ajax2 inline-block"
                                      action="{{route('support-close', $request->id )}}">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="POST">
                                    <button class="text-success submit p-0 border-0 bg-none" type="submit" title="close">
                                        <i class="nav-icon i-Remove font-weight-bold"></i>
                                    </button>
                                </form>
                            @endif
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
        {{ $requests->links() }}
    </div>
</div>

