<div class="form-group">
    <input name="title" type="text" class="form-control" required value="{{ old('title') ??$post->title ?? '' }}">
</div>
<div class="form-group">
    <textarea name="descr" class="form-control" rows="3" required>{{ old('descr') ??$post->descr ?? '' }}</textarea>
</div>
<div class="form-group">
    <input name="img" type="file" id="">
</div>