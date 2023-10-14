<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use App\Models\WebSite;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UserController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(): Factory|View|Application
    {
        return view('web.User.index', [
            'users' => User::paginate()
        ]);
    }

    /**
     * @param StoreRequest $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        $websites = $request->input('websites', []);
        $websites = WebSite::find($websites);

        $permissions = $request->input('permissions', []);

        DB::beginTransaction();

        try {
            $user = User::create($validated);

            $user->websites()->attach($websites);

            $user->givePermissionTo($permissions);
        }
        catch (Throwable $exception) {
            DB::rollBack();

            $success = 'Не удалось добавить пользователя. Произошла ошибка: ' . $exception->getMessage();

            return redirect()->back()
                ->with('toast:error', $success);
        }

        DB::commit();

        $success = 'Пользователь `' . $user->email . '` успешно был создан.';

        $attributes = [];
        $attributes['message']  = 'Добавил новую запись в разделе `Пользователи`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $user->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('users.show', $user->id)
            ->with('toast:success', $success);
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): Factory|View|Application
    {
        return view('web.User.create');
    }

    /**
     * @param User $user
     * @return Application|Factory|View
     */
    public function show(User $user): Factory|View|Application
    {
        return view('web.User.detail', [
            'user' => $user,
            'edit' => false,
        ]);
    }

    /**
     * @param User $user
     * @return Application|Factory|View
     */
    public function edit(User $user): Factory|View|Application
    {
        return view('web.User.detail', [
            'user' => $user,
            'edit' => true,
        ]);
    }

    /**
     * @param UpdateRequest $request
     * @param User $user
     * @return RedirectResponse
     * @throws Throwable
     */
    public function update(UpdateRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();
        $validated['password'] = $request->filled('password') ? Hash::make($validated['password']) : $user->password;

        $websites = $request->input('websites', []);
        $websites = WebSite::find($websites);

        $permissions = $request->input('permissions', []);

        DB::beginTransaction();

        try {
            $user->update($validated);

            $user->websites()->sync($websites);

            $user->syncPermissions($permissions);
        }
        catch (Throwable $exception) {
            DB::rollBack();

            $message = 'Не удалось обновить данные пользователя. Произошла ошибка: ' . $exception->getMessage();

            return redirect()->back()
                ->with('toast:error', $message);
        }

        DB::commit();

        $success = 'Пользователь `' . $user->email . '` успешно был обновлен.';

        $attributes = [];
        $attributes['message']  = 'Отредактировал запись в разделе `Пользователи`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $user->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->back()
            ->with('toast:success', $success);
    }

    /**
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        $success = 'Пользователь `' . $user->email . '` успешно был удален.';

        $attributes = [];
        $attributes['message']  = 'Удалил запись в разделе `Пользователи`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $user->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('users.index')
            ->with('toast:success', $success);
    }
}
