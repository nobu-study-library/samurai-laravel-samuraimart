<a href="#">Create New Product</a>
<table>
  <tr>
    <th>Name</th>
    <th>Description</th>
    <th>Price</th>
    <th>Category ID</th>
    <th>Action</th>
  </tr>
  @foreach ($products as $product)
    <tr>
      <td>{{ $product->name }}</td>
      <td>{{ $product->desciption }}</td>
      <td>{{ $product->price }}</td>
      <td>{{ $product->category_id }}</td>
      <td>
        <a href="#">Show</a>
        <a href="#">Edit</a>
      </td>
    </tr>
  @endforeach
</table>
