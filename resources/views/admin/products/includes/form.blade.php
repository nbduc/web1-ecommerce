@csrf

<div class="form-group">
    <label for="name">Name</label>
    <input class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Example: Iphone 12 pro max" name="name" required
        value="{{ old('name') }}@isset($product){{ $product->name }}@endisset">
    @error('name')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label for="price">Price</label>
    <input class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Example: 21.990.000" name="price" >
</div>
<div class="form-group">
    <label for="in_stock">In Stock(Max:1000)</label>
    <input class="form-control @error('name') is-invalid @enderror" type="number"  name="in_stock" min="1" max="1000">
</div>
<div class="form-group">
    <label for="display">Display</label>
    <input class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Example: Retina" name="display" >
</div>
<div class="form-group">
    <label for="front_camera">Front Camera</label>
    <input class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Example: 12MP" name="front_camera" >
</div>
<div class="form-group">
    <label for="rear_camera">Rear Camera</label>
    <input class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Example: 12MP" name="rear_camera" >
</div>
<div class="form-group">
    <label for="storage">Storage</label>
    <input class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Example: 32GB" name="storage" >
</div>
<div class="form-group">
    <label for="os">OS</label>
    <input class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Example: ios 14" name="os" >
</div>
<div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control @error('name') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
</div>
<div class="form-group">
    <label for="feature_img">Feature Img</label>
    <input type="file" class="form-control-file @error('name') is-invalid @enderror" id="exampleFormControlFile1" name="feature_img">
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
