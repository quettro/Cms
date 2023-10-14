<div>
    <h3 style="margin-top: 0; margin-bottom: 30px;">
        Новая заявка №{{ $webData->id }}
    </h3>

    <table style="width: 100%;">
        <tbody>
            <tr>
                <td style="width: 50%; border-bottom: 1px solid #d9d9d9; padding: 15px 0;">Номер:</td>
                <td style="border-bottom: 1px solid #d9d9d9; padding: 15px 0;">№{{ $webData->id }}</td>
            </tr>

            <tr>
                <td style="width: 50%; border-bottom: 1px solid #d9d9d9; padding: 15px 0;">Направлен с:</td>
                <td style="border-bottom: 1px solid #d9d9d9; padding: 15px 0;">{{ $webData->referer }}</td>
            </tr>

            <tr>
                <td style="width: 50%; border-bottom: 1px solid #d9d9d9; padding: 15px 0;">Ip:</td>
                <td style="border-bottom: 1px solid #d9d9d9; padding: 15px 0;">{{ $webData->ip }}</td>
            </tr>

            <tr>
                <td style="width: 50%; border-bottom: 1px solid #d9d9d9; padding: 15px 0;">Сайт:</td>
                <td style="border-bottom: 1px solid #d9d9d9; padding: 15px 0;">{{ $webData->webSite?->domain }} | {{ $webData->webSite?->name }}</td>
            </tr>

            <tr>
                <td style="width: 50%; border-bottom: 1px solid #d9d9d9; padding: 15px 0;">Язык:</td>
                <td style="border-bottom: 1px solid #d9d9d9; padding: 15px 0;">{{ $webData->language?->codename }} | {{ $webData->language?->name }}</td>
            </tr>

            <tr>
                <td style="width: 50%; border-bottom: 1px solid #d9d9d9; padding: 15px 0;">Идентификатор формы:</td>
                <td style="border-bottom: 1px solid #d9d9d9; padding: 15px 0;">{{ $webData->form?->key }}</td>
            </tr>

            <tr>
                <td style="width: 50%; border-bottom: 1px solid #d9d9d9; padding: 15px 0;">Дата создания:</td>
                <td style="border-bottom: 1px solid #d9d9d9; padding: 15px 0;">{{ $webData->created_at }}</td>
            </tr>

            @foreach($webData->all as $input => $value)
                @php $textarea = $value; @endphp

                @if(is_array($value))
                    @php $textarea = ''; @endphp

                    @foreach($value as $v)
                        @if(!is_array($v))
                            @php $textarea .= $v . PHP_EOL; @endphp
                        @else
                            @php $textarea  = print_r($value, true); @endphp @break
                        @endif
                    @endforeach
                @endif

                <tr>
                    <td style="width: 50%; border-bottom: 1px solid #d9d9d9; padding: 15px 0;">{{ \App\Models\Input::where('key', $input)->first()?->name ?? ucwords($input) }}:</td>
                    <td style="border-bottom: 1px solid #d9d9d9; padding: 15px 0; white-space: pre-line;">{{ $textarea }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
