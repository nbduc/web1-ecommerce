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
    <input class="form-control @error('price') is-invalid @enderror" type="text" placeholder="Example: 21.990.000" name="price" required
        value="{{ old('price') }}@isset($product){{ $product->price }}@endisset">
    @error('price')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label for="in_stock">In Stock(Max:1000)</label>
    <input class="form-control @error('in_stock') is-invalid @enderror" type="number"  name="in_stock" min="1" max="1000" required
        value="{{ old('in_stock') }}@isset($product){{ $product->in_stock }}@endisset">
    @error('in_stock')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label for="display">Display</label>
    <input class="form-control @error('display') is-invalid @enderror" type="text" placeholder="Example: Retina" name="display" required
        value="{{ old('display') }}@isset($product){{ $product->productDetail->display }}@endisset">
    @error('display')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label for="front_camera">Front Camera</label>
    <input class="form-control @error('front_camera') is-invalid @enderror" type="text" placeholder="Example: 12MP" name="front_camera" required
        value="{{ old('front_camera') }}@isset($product){{ $product->productDetail->front_camera }}@endisset">
    @error('front_camera')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label for="rear_camera">Rear Camera</label>
    <input class="form-control @error('rear_camera') is-invalid @enderror" type="text" placeholder="Example: 12MP" name="rear_camera" required
        value="{{ old('rear_camera') }}@isset($product){{ $product->productDetail->rear_camera }}@endisset">
    @error('rear_camera')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label for="storage">Storage</label>
    <input class="form-control @error('storage') is-invalid @enderror" type="text" placeholder="Example: 32GB" name="storage" required
        value="{{ old('storage') }}@isset($product){{ $product->productDetail->storage }}@endisset">
    @error('storage')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label for="os">OS</label>
    <input class="form-control @error('os') is-invalid @enderror" type="text" placeholder="Example: ios 14" name="os" required
        value="{{ old('os') }}@isset($product){{ $product->productDetail->os }}@endisset">
    @error('os')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control @error('description') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3" name="description" required
        value="{{ old('description') }}@isset($product){{ $product->description }}@endisset">
    </textarea>
    @error('description')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label for="feature_img">Feature Img</label>
    <input type="file" class="form-control-file @error('name') is-invalid @enderror" id="exampleFormControlFile1" name="feature_img">
</div>
<div class="form-group">

    <label for="sup_img">Product Imgs</label>
    <div class="form-group">
        <label for="sup_img">Product Img 1</label>
        <input type="file" class="form-control-file @error('name') is-invalid @enderror" id="exampleFormControlFile1" name="sup_img1">
    </div>
    <div class="form-group">
        <label for="sup_img">Product Img 2</label>
        <input type="file" class="form-control-file @error('name') is-invalid @enderror" id="exampleFormControlFile1" name="sup_img2">
    </div>
    <div class="form-group">
        <label for="sup_img">Product Img 3</label>
        <input type="file" class="form-control-file @error('name') is-invalid @enderror" id="exampleFormControlFile1" name="sup_img3">
    </div>
 
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
