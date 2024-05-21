<?php

namespace App\Repositories;

use App\Models\Shared\InputSource;
use Flytedan\DanxLaravel\Exceptions\ValidationError;
use Flytedan\DanxLaravel\Models\Utilities\StoredFile;
use Flytedan\DanxLaravel\Repositories\ActionRepository;
use Illuminate\Database\Eloquent\Model;

class InputSourcesRepository extends ActionRepository
{
    public static string $model = InputSource::class;

    /**
     * @param string                 $action
     * @param Model|InputSource|null $model
     * @param array|null             $data
     * @return InputSource|bool|mixed|null
     * @throws ValidationError
     */
    public function applyAction(string $action, $model = null, ?array $data = null)
    {
        return match ($action) {
            'create' => $this->createInputSource($data),
            'update' => $this->updateInputSource($model, $data),
            default => parent::applyAction($action, $model, $data)
        };
    }

    /**
     * @param array $data
     * @return InputSource
     */
    public function createInputSource(array $data): InputSource
    {
        $data['team_id'] = team()->id;
        $data['user_id'] = user()->id;

        $inputSource = InputSource::make()->forceFill($data)->validate();
        $inputSource->save();

        $this->syncStoredFiles($inputSource, $data);

        return $inputSource;
    }

    /**
     * @param InputSource $inputSource
     * @param array       $data
     * @return InputSource
     */
    public function updateInputSource(InputSource $inputSource, array $data): InputSource
    {
        $inputSource->update($data);
        $this->syncStoredFiles($inputSource, $data);

        return $inputSource;
    }

    /**
     * Sync the stored files for the input source and set them to be transcoded
     *
     * @param InputSource $inputSource
     * @param array       $data
     * @return void
     */
    public function syncStoredFiles(InputSource $inputSource, array $data): void
    {
        if (isset($data['files'])) {
            $files = StoredFile::whereIn('id', collect($data['files'])->pluck('id'))->get();
            $inputSource->storedFiles()->sync($files);
            $inputSource->is_transcoded = false;
            $inputSource->save();
        }
    }
}
