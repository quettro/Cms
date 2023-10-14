<div class="mb-3">
    <label for="phone" class="form-label">Номер телефона</label>
    <input id="phone" name="phone" type="number" value="{{ old('phone') }}" placeholder="Номер телефона" class="form-control" required="">

    @error('phone')
        <div class="small text-danger mt-1">
            {{ $message }}
        </div>
    @enderror
</div>
