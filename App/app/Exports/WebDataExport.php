<?php

namespace App\Exports;

use App\Models\Input;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class WebDataExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     *
     */
    use Exportable;

    /**
     * @var Collection|null
     */
    protected Collection|null $columns = null;

    /**
     * @param Collection $collection
     */
    public function __construct(protected Collection $collection)
    {
        $this->columns = new Collection([]);

        $this->assembleColumnsIntoAnArray();
    }

    /**
     * @return Collection
     */
    public function collection(): Collection
    {
        return $this->collection;
    }

    /**
     * @return void
     */
    protected function assembleColumnsIntoAnArray(): void
    {
        $this->collection()->each(
            fn ($row) =>
                $this->columns->push(...collect($row->all)->keys())
        );
        $this->columns = $this->columns->unique();
    }

    /**
     * @return string[]
     */
    public function headings(): array
    {
        $array = [];
        $array[] = 'Id';
        $array[] = 'Форма';
        $array[] = 'Веб-сайт';
        $array[] = 'Язык';
        $array[] = 'Ip';
        $array[] = 'Направлен с';
        $array[] = 'Дата создания';

        foreach ($this->columns as $column)
        {
            $input = Input::where(['key' => trim($column)])->first();

            if ($input) {
                $array[] = trim($input->name);
            }
            else {
                $array[] = trim(ucwords($column));
            }
        }

        return $array;
    }

    /**
     * @param $row
     * @return array
     */
    public function map($row): array
    {
        $array = [];
        $array[] = $row->id;
        $array[] = $row->form?->key;
        $array[] = $row->webSite?->domain;
        $array[] = $row->language?->name;
        $array[] = $row->ip;
        $array[] = $row->referer;
        $array[] = $row->created_at;

        foreach ($this->columns as $column) {
            $value = @$row->all[$column];

            if (!is_array($value)) {
                $array[] = $value;
            }
            else {
                $str = '';

                foreach ($value as $v) {
                    if (!is_array($v)) {
                        $str .= $v . PHP_EOL;
                    }
                    else {
                        $str  = print_r($value, true); break;
                    }
                }

                $array[] = $str;
            }
        }

        return $array;
    }
}
