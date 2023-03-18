<div>
  <h2>Edit Product</h2>
</div>
<div>
  <a href="{{ route('products.index') }}">Back</a>
</div>

<form action="{{ route('products.update', $product->id) }}" method="post">
  @csrf
  @method('PUT')
  <div>
    <strong>Name：</strong>
    <input type="text" name="name" value="{{ $product->name }}" placeholder="Name">
  </div>
  <div>
    <strong>Description：</strong>
    <textarea name="height:150px" name="description" placeholder="description">{{ $product->description }}</textarea>
  </div>
  <div>
    <strong>Price:</strong>
    <input type="number" name="price" value="{{ $product->price }}">
  </div>
  <div>
    <strong>Category：</strong>
    <select name="categoryId">
      @foreach ($categoryList as $category)
        @if ($category->id === $product->category_id)
          <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
        @else
          <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endif
      @endforeach
    </select>
  </div>
  <div>
    <button type="submit">Submit</button>
  </div>
</form>
