@if(isset($item))
    {!! Form::open(['url' => route('category-update', $item['id']), 'class'=> 'ajax', 'method' => 'post', 'id' => 'update-category-form']) !!}
@else
    {!! Form::open(['url' => route('category-store'), 'class'=> 'ajax', 'method' => 'post', 'id' => 'create-category-form']) !!}
@endif
<div class="row">
    {{ csrf_field() }}
    <div class="col-md-6 form-group mb-3">
        <label for="name">Name <span class="required">*</span></label>
        {!! Form::text('name', $item->name ?? '', ['class'=>'form-control form-control-rounded', 'id' => 'name']) !!}
        <div class="form-error name"></div>
    </div>


    <div class="col-md-6 form-group mb-3">
        <label for="description">Description <span class="required">*</span></label>
        {!! Form::textarea('description', $item->description ?? '', ['class'=>'form-control form-control-rounded', 'id' => 'description']) !!}

        <div class="form-error description"></div>
    </div>
    <div class="col-md-6 form-group mb-3">
        <label for="logo" class="col-md-12">Image</label>
        {!! Form::file('image_url', ['class'=>'inputfile', 'id' => 'image_url',  'data-preview-file-type' => 'text']) !!}
        <label for="image_url" class="inputfilelabel"><strong>Choose a file</strong></label>
        <div class="form-error image_url"></div>
        <div id="target" class="mt-4">
            @if(isset($item))
                @if($item['image_url'])
                    <img class="office-logo rounded img-thumbnail" src="{{ asset('public/'.$item->image_url) }}"
                         alt="">
                @endif
            @endif
        </div>
    </div>

    <div class="col-md-12">
        {!! Form::hidden('old_image_url', $item->image_url ?? null) !!}
        <button type="submit" class="btn btn-primary submit">Save</button>
    </div>
</div>

{!! Form::close() !!}
<script type="text/javascript">
    // var input   = $('\inputfile')[0];
    let label = $('.inputfilelabel')[0];
    labelVal = label.innerHTML;

    $('input[type=file]').on('change', function (e) {
        let file = e.target.files[0];
        let filename = file.name;
        if (filename) {
            let reader = new FileReader();
            reader.onload = function (e2) {
                $('#target').html('<img class="office-logo rounded img-thumbnail" src="' + e2.target.result + '" alt="">');
            };
            reader.readAsDataURL(file);
            label.innerHTML = filename;
        } else {
            label.innerHTML = labelVal;
        }
    });
</script>
