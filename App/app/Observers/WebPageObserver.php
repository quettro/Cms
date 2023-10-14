<?php

namespace App\Observers;

use App\Models\WebPage;

class WebPageObserver
{
    /**
     * @param WebPage $webPage
     * @return void
     */
    public function updated(WebPage $webPage): void
    {
        if ($webPage->wasChanged('a_route')) {
            foreach ($webPage->children as $child) {
                $child->a_route = implode('/', [$webPage->a_route, $child->route]);
                $child->a_route = WebPage::clearTheRouteOfExtraCharacters($child->a_route);
                $child->save();
            }
        }
    }

    /**
     * @param WebPage $webPage
     * @return void
     */
    public function saving(WebPage $webPage): void
    {
        if ($webPage->isDirty('route')) {
            if ($webPage->isRoot()) {
                $webPage->a_route = $webPage->route;
            } else {
                $webPage->a_route = implode('/', [$webPage->parent->a_route, $webPage->route]);
                $webPage->a_route = WebPage::clearTheRouteOfExtraCharacters($webPage->a_route);
            }
        }
    }

    /**
     * @param WebPage $webPage
     * @return void
     */
    public function deleted(WebPage $webPage): void
    {
        $webPage->languages->each(static fn ($row) => $row->delete());
    }
}
