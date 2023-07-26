<div class="form-group">
    <input name="title" type="text" placeholder="Заголовок поста" class="form-control" required value="{{ old('title') ??$post->title ?? '' }}">
</div>
<div class="form-group">
    {{-- <textarea name="descr" class="form-control" rows="3" required>{{ old('descr') ??$post->descr ?? '' }}</textarea> --}}
    <input id="descr" type="hidden" name="descr" class="form-control" value="{{ old('descr') ?? $post->descr ?? '' }}" />
    <trix-editor class="trix-content" input="descr"></trix-editor>
</div>
<div class="form-group">
    <input name="img" type="file" id="">
</div>