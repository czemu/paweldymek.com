<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Select;
use Benjaminhirsch\NovaSlugField\Slug;
use Benjaminhirsch\NovaSlugField\TextWithSlug;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use NovaButton\Button;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use NovaAttachMany\AttachMany;

class Post extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Post';

    /**
     * Get the value that should be displayed to represent the resource.
     *
     * @return string
     */
    public function title()
    {
        return $this->name;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name',
    ];

    /**
     * Indicates whether Nova should check for modifications between viewing and updating a resource.
     *
     * @var bool
     */
    public static $trafficCop = false;

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Select::make('Locale', 'locale')
                ->options(array_combine(\LaravelLocalization::getSupportedLanguagesKeys(), \LaravelLocalization::getSupportedLanguagesKeys()))
                ->rules('required'),
            TextWithSlug::make('Name', 'name')
                    ->slug('slug')->rules('required', 'max:255')
                    ->displayUsing(function($title) {
                        return \Str::limit($title, 55);
                    }),
            Slug::make('Slug', 'slug')
               ->disableAutoUpdateWhenUpdating()
               ->sortable()
               ->rules('required', 'max:255')
               ->creationRules('unique:posts,slug')
               ->updateRules('unique:posts,slug,{{resourceId}}')
               ->hideFromIndex(),
            Text::make('External URL')->hideFromIndex(),
            Textarea::make('Intro'),
            Markdown::make('Content', 'content'),
            Images::make('Image', 'image')
                ->setFileName(function($originalFilename, $extension, $model) {
                    return $model->slug;
                })
                ->customPropertiesFields([
                    Text::make('Alt attribute', 'alt'),
                    Text::make('Description', 'description'),
                ])
                ->conversionOnIndexView('small'),
            Boolean::make('Is published'),
            AttachMany::make('Tags', 'tags'),
            Button::make(__('Show'))->link($this->getUrl())->style('primary-outline'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
