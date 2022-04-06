{!! Form::open(['url' => route('cm-update', $item['id']), 'class'=> 'ajax', 'method' => 'post', 'id' => 'update-cm-form']) !!}
<div class="row">
    {{ csrf_field() }}
    <div class="col-md-6 form-group mb-3">
        <label for="name">Name <span class="required">*</span></label>
        {!! Form::text('name', $item->name ?? '', ['class'=>'form-control form-control-rounded', 'id' => 'name']) !!}
        <div class="form-error name"></div>
    </div>

    <div class="col-md-6 form-group mb-3">
        <label for="slug">Slug <span class="required">*</span></label>
        {!! Form::text('slug', $item->slug ?? '', ['class'=>'form-control form-control-rounded', 'id' => 'slug', 'readonly'=>true]) !!}
        <div class="form-error slug"></div>
    </div>
    @if($item->type)
        @if($item->type == \App\Services\ContentManagement\IContentManagement::TYPE_IMAGE)
            <div class="col-md-6 form-group mb-3">
                <label for="logo" class="col-md-12">Image</label>
                {!! Form::file('content', ['class'=>'inputfile', 'id' => 'content',  'data-preview-file-type' => 'text']) !!}
                <label for="content" class="inputfilelabel"><strong>Choose a file</strong></label>
                <div class="form-error content"></div>
                <div id="target" class="mt-4">
                    @if(isset($item))
                        @if($item['content'])
                            <img class="office-logo rounded img-thumbnail" src="{{ asset('public/storage/'.$item->content) }}" alt="">
                        @endif
                    @endif
                </div>
            </div>
        @else
            <div class="col-md-12 form-group mb-3">
                <label for="content">Content <span class="required">*</span></label>
                {!! Form::textarea('content', $item->content ?? '', ['class'=>'form-control form-control-rounded', 'id' => 'content']) !!}
                <div class="form-error content"></div>
            </div>
        @endif
    @endif

    <div class="col-md-12">
        {!! Form::hidden('type', $item->type) !!}
        <button type="submit" class="btn btn-primary submit">Save</button>
    </div>
</div>
{!! Form::close() !!}
<script type="text/javascript">
    $(document).ready(
        function () {
            let label = $('#name');
            label.keyup(function () {
                let label_val = label.val();
                $('#slug').val(convertToSlug(label_val));
            });
            $("#update-cm-form").on("form-success-event", function (event, data) {
                $(this).find('input').val('');
                window.location = '/content-management';
            });
        }
    );

    function convertToSlug(Text)
    {
        return Text
            .toLowerCase()
            .replace(/ /g,'_')
            .replace(/[^\w-]+/g,'')
            ;
    }
</script>
<script type="text/javascript">
    // var input   = $('.inputfile')[0];
    let label   = $('.inputfilelabel')[0];
    labelVal = label.innerHTML;

    $('input[type=file]').on('change', function(e) {
        let file = e.target.files[0];
        let filename = file.name;
        if( filename ) {
            let reader = new FileReader();
            reader.onload = function (e2) {
                $('#target').html('<img class="office-logo rounded img-thumbnail" src="'+e2.target.result+'" alt="">');
            };
            reader.readAsDataURL(file);
            label.innerHTML = filename;
        } else {
            label.innerHTML = labelVal;
        }
    });
</script>
