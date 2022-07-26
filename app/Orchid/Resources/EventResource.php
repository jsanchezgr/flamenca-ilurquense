<?php

namespace App\Orchid\Resources;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Orchid\Crud\Filters\DefaultSorted;
use Orchid\Crud\Resource;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\SimpleMDE;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;

class EventResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Event::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Input::make('name')
                ->title('Título')
                ->placeholder('Introducir el nombre del artista o artistas'),
            SimpleMDE::make('description')
                ->title('Descripción del Evento'),
            Picture::make('image')
                ->acceptedFiles('.jpg,.jpeg,.png'),
        ];
    }

    /**
     * Get the columns displayed by the resource.
     *
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('name', 'Nombre'),
            TD::make('date', 'Fecha y hora')
                ->render(function ($event) {
                    return Carbon::create($event->date)->format('d/m/Y H:i');
                }),
        ];
    }

    /**
     * Get the sights displayed by the resource.
     *
     * @return Sight[]
     */
    public function legend(): array
    {
        return [
            Sight::make('id'),
            Sight::make('name'),
            Sight::make('date'),
            Sight::make('slug'),
            Sight::make('image'),
            Sight::make('description'),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(): array
    {
        return [
            new DefaultSorted('date', 'desc'),
            // \App\Orchid\Filters\EventFilter::class,
        ];
    }

    public static function label(): string
    {
        return 'Eventos';
    }

    public static function singularLabel(): string
    {
        return 'Evento';
    }

    public static function displayInNavigation(): bool
    {
        return false;
    }

    public static function trafficCop(): bool
    {
        return false;
    }

}
