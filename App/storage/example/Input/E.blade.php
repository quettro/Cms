<div class="mb-3">
    <label for="email" class="form-label">Адрес электронной почты</label>
    <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="Адрес электронной почты" class="form-control" required="">

    @error('email')
        <div class="small text-danger mt-1">
            {{ $message }}
        </div>
    @enderror
</div>
