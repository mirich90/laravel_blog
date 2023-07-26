<div class="form-group">
    <input name="title" type="text" placeholder="Название категории" class="form-control" required value="{{ old('title') ?? $category->title ?? '' }}">
</div>