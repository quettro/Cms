<?php

namespace App\Http\Controllers;

use App\Filters\UserHistoryQueryFilter;
use App\Http\Requests\UserHistory\StoreRequest;
use App\Http\Requests\UserHistory\UpdateRequest;
use App\Models\UserHistory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserHistoryController extends Controller
{
    /**
     * @param UserHistoryQueryFilter $filter
     * @return Application|Factory|View
     */
    public function index(UserHistoryQueryFilter $filter): View|Factory|Application
    {
        return view('web.UserHistory.index', [
            'collection' => UserHistory::filter($filter)->paginate(), 'filter' => $filter,
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('web.UserHistory.create');
    }

    /**
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $userHistory = new UserHistory($request->validated());
        $userHistory->save();

        $success = 'История #'. $userHistory->id .' - успешно была создана.';

        $attributes = [];
        $attributes['message']  = 'Добавил новую запись в разделе `История пользователей`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $userHistory->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('user-history.show', $userHistory->id)
            ->with('toast:success', $success);
    }

    /**
     * @param UserHistory $userHistory
     * @return Application|Factory|View
     */
    public function show(UserHistory $userHistory): View|Factory|Application
    {
        return view('web.UserHistory.detail', [
            'userHistory' => $userHistory,
            'edit' => false,
        ]);
    }

    /**
     * @param UserHistory $userHistory
     * @return Application|Factory|View
     */
    public function edit(UserHistory $userHistory): View|Factory|Application
    {
        return view('web.UserHistory.detail', [
            'userHistory' => $userHistory,
            'edit' => true,
        ]);
    }

    /**
     * @param UpdateRequest $request
     * @param UserHistory $userHistory
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, UserHistory $userHistory): RedirectResponse
    {
        $userHistory->update($request->validated());

        $success = 'История #' . $userHistory->id . ' - успешно была обновлена.';

        $attributes = [];
        $attributes['message']  = 'Отредактировал запись в разделе `История пользователей`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $userHistory->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->back()
            ->with('toast:success', $success);
    }

    /**
     * @param UserHistory $userHistory
     * @return RedirectResponse
     */
    public function destroy(UserHistory $userHistory): RedirectResponse
    {
        $userHistory->delete();

        $success = 'История #' . $userHistory->id . ' - успешно была удалена.';

        $attributes = [];
        $attributes['message']  = 'Удалил запись в разделе `История пользователей`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $userHistory->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('user-history.index')
            ->with('toast:success', $success);
    }
}
