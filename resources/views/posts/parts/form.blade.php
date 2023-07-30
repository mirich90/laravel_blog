<div class="form-group">
    <input name="title" type="text" placeholder="Заголовок поста" class="form-control" required value="{{ old('title') ?? $post->title ?? '' }}">
</div>

@if (count($categories) > 0)
<div class="form-group">
    <label for="">категория</label>
    
    <select name="category_id" id="" class="form-control">
        @foreach ($categories as $category)
        <option value="{{ $category->id }}" {{ $category->id == old('category_id') ? 'selected' : '' }}>
            {{ $category->title }}
        </option>
        @endforeach
    </select>
</div>    
@endif


<div class="form-group">
    {{-- <textarea name="descr" class="form-control" rows="3" required>{{ old('descr') ??$post->descr ?? '' }}</textarea> --}}
    <input id="descr" type="hidden" name="descr" class="form-control" value="{{ old('descr') ?? $post->descr ?? '' }}" />
    <trix-editor class="trix-content" input="descr"></trix-editor>
</div>

<div class="form-group">
    <input name="img" type="file" id="">
</div>