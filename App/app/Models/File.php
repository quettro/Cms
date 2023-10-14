<?php

namespace App\Models;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\File
 *
 * @property int $id
 * @property string|null $hash
 * @property string $disk
 * @property string $relative
 * @property string $absolute
 * @property string $hashName
 * @property string $mimeType
 * @property string $filename
 * @property string $extension
 * @property int $size
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|File newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File query()
 * @method static \Illuminate\Database\Eloquent\Builder|File whereAbsolute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereHashName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereMimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereRelative($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class File extends Model
{
    /**
     *
     */
    use HasFactory;

    /**
     *
     */
    use DefaultOrderBy;

    /**
     * @var string[]
     */
    protected $guarded = ['id', 'updated_at', 'created_at'];

    /**
     * @var string
     */
    protected static string $orderByColumn = 'id';

    /**
     * @var string
     */
    protected static string $orderByColumnDirection = 'desc';

    /**
     * @return bool
     */
    public function rm(): bool
    {
        return $this->filesystem()->delete($this->relative);
    }

    /**
     * @return string
     */
    public function link(): string
    {
        return $this->filesystem()->url($this->relative);
    }

    /**
     * @return Filesystem|FilesystemAdapter
     */
    public function filesystem(): Filesystem|FilesystemAdapter
    {
        return Storage::disk($this->disk);
    }

    /**
     * @param UploadedFile $file
     * @param string $disk
     * @param string $path
     * @param string $hashName
     * @return File
     */
    public static function store(UploadedFile $file, string $disk = 'public', string $path = '', string $hashName = ''): File
    {
        $hashName = empty($hashName) ? $file->hashName() : basename($hashName);

        $attributes = [];
        $attributes['disk'] = $disk;
        $attributes['relative'] = $file->storeAs($path, $hashName, $disk);
        $attributes['absolute'] = Storage::disk($disk)->path($attributes['relative']);
        $attributes['hashName'] = $hashName;
        $attributes['mimeType'] = $file->getClientMimeType();
        $attributes['filename'] = $file->getClientOriginalName();
        $attributes['extension'] = $file->getClientOriginalExtension();
        $attributes['size'] = $file->getSize();
        $attributes['hash'] = \Illuminate\Support\Facades\File::hash($attributes['absolute'], 'sha256');

        return File::updateOrCreate(['absolute' => $attributes['absolute']], $attributes);
    }
}
