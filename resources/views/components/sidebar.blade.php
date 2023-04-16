<div class="container">
  @foreach ($majorCategoryNames as $majorCategoryName)
    <h2>{{ $majorCategoryName }}</h2>
    @foreach ($categories as $category)
      @if ($category->major_category_name === $majorCategoryName)
        <label class="samuraimart-sidebar-category-label">
          <a href="#">{{ $category->name }}</a>
        </label>
      @endif
    @endforeach
  @endforeach
</div>
