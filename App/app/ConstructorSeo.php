<?php

namespace App;

class ConstructorSeo
{
    /**
     * @var Constructor
     */
    public Constructor $constructor;

    /**
     * @param Constructor $constructor
     * @return void
     */
    public function setConstructor(Constructor $constructor): void
    {
        $this->constructor = $constructor;
    }

    /**
     * @return string|null
     */
    public function title(): ?string
    {
        $blade = $this->constructor->moduleDatabaseTranslated?->seo_title;
        $blade = $blade ?: $this->constructor->webPageLanguage->title;

        return $this->constructor->render()->render($blade);
    }

    /**
     * @return string|null
     */
    public function description(): ?string
    {
        $blade = $this->constructor->moduleDatabaseTranslated?->seo_description;
        $blade = $blade ?: $this->constructor->webPageLanguage->description;

        return $this->constructor->render()->render($blade);
    }

    /**
     * @return string|null
     */
    public function keyword(): ?string
    {
        $blade = $this->constructor->moduleDatabaseTranslated?->seo_keywords;
        $blade = $blade ?: $this->constructor->webPageLanguage->keywords;

        return $this->constructor->render()->render($blade);
    }

    /**
     * @return string|null
     */
    public function ogTitle(): ?string
    {
        $blade = $this->constructor->moduleDatabaseTranslated?->og_title;
        $blade = $blade ?: $this->constructor->webPageLanguage->og_title;

        return $this->constructor->render()->render($blade);
    }

    /**
     * @return string|null
     */
    public function ogDescription(): ?string
    {
        $blade = $this->constructor->moduleDatabaseTranslated?->og_description;
        $blade = $blade ?: $this->constructor->webPageLanguage->og_description;

        return $this->constructor->render()->render($blade);
    }

    /**
     * @return string|null
     */
    public function ogImage(): ?string
    {
        $og_image = $this->constructor->moduleDatabaseTranslated?->ogImageFile;
        $og_image = $og_image ?: $this->constructor->webPageLanguage->ogImageFile;

        return $og_image?->link();
    }
}
