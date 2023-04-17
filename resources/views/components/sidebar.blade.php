<div class="container">
  @foreach ($majorCategories as $majorCategory)
    <h2>{{ $majorCategory->name }}</h2>
    @foreach ($categories as $category)
      @if ($category->major_category_id === $majorCategory->id)
        <label class="samuraimart-sidebar-category-label">
          <a href="#">{{ $category->name }}</a>
        </label>
      @endif
    @endforeach
  @endforeach
</div>
