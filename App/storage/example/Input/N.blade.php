<div class="mb-3">
    <label for="name" class="form-label">Имя</label>
    <input id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Имя" class="form-control" required="">

    @error('name')
        <div class="small text-danger mt-1">
            {{ $message }}
        </div>
    @enderror
</div>
