<form action="/" method="POST" enctype="application/x-www-form-urlencoded">
    {!! $constructor->render()->input('name') !!}
    {!! $constructor->render()->input('email') !!}
    {!! $constructor->render()->input('phone') !!}

    <div class="mb-3">
        <label for="youtube" class="form-label">YouTube</label>
        <input id="youtube" name="youtube" type="text" placeholder="YouTube" class="form-control" required="">
    </div>

    <button type="submit" class="btn btn-primary">Отправить</button>

    <x-form-submitted>
        <div class="mb-3">
            <div class="card card-body">
                Спасибо, ваша заявка принята!
            </div>
        </div>
    </x-form-submitted>
</form>
