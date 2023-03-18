<a href="{{ route('products.create') }}">Create New Product</a>
<table>
  <tr>
    <th>Name</th>
    <th>Description</th>
    <th>Price</th>
    <th>Category ID</th>
    <th>Action</th>
  </tr>
  @foreach ($productList as $product)
    <tr>
      <td>{{ $product->name }}</td>
      <td>{{ $product->description }}</td>
      <td>{{ $product->price }}</td>
      <td>{{ $product->category_id }}</td>
      <td>
        <form action="{{ route('products.destroy', $product->id) }}" method="post">
          @csrf
          @method('delete')
          <a href="{{ route('products.show', $product->id) }}">Show</a>
          <a href="{{ route('products.update', $product->id) }}">Edit</a>
          <button type="submit">Delete</button>
        </form>
      </td>
    </tr>
  @endforeach
</table>
