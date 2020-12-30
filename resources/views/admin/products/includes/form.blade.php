@csrf
<div class="form-group">
    <label for="name">Name</label>
    <input class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Example: Dell Gaming G7 7590" name="name" required
        value="{{ old('name') }}@isset($product){{ $product->name }}@endisset">
    @error('name')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div id="editor"></div>
<br>
<button class="btn btn-block btn-success" type="submit">Submit</button>
<a href="{{ route('admin.products.index') }}" class="btn btn-block btn-primary">Return</a>

@section('css')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endsection

@section('js')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    var toolbarOptions = [
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
        ['blockquote', 'code-block'],
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
        [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
        [{ 'align': [] }],
        ['clean']                                         // remove formatting button
    ];
    var options = {
        modules: {
            toolbar: toolbarOptions,
        },
        ops: [{
            // An image link
            insert: {
                image: 'https://quilljs.com/assets/images/icon.png'
            },
            attributes: {
                link: 'https://quilljs.com'
            }
        }],
        placeholder: 'Compose an epic...',
        theme: 'snow'
    };
    var editor = new Quill('#editor', options);
</script>
@endsection
