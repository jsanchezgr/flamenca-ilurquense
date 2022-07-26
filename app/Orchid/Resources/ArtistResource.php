<?php

namespace App\Orchid\Resources;

use Orchid\Crud\Resource;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\SimpleMDE;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;


class ArtistResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Artist::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Input::make('name')
                ->title('Nombre')
                ->placeholder('Nombre completo (real) del artista'),
            Input::make('nick')->title('Nombre artístico'),
            Input::make('birthplace')
                ->title('Procedencia')
                ->placeholder('Localidad y provincia de procedencia'),
            DateTimer::make('birthdate')
                ->title('Fecha de Nacimiento'),
            Picture::make('image')
                ->title('Foto')
                ->acceptedFiles('.jpg,.jpeg,.png'),
            SimpleMDE::make('biography')
                ->title('Biografía'),
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
            TD::make('nick', 'Nombre Artístico'),
            TD::make('name', 'Nombre'),
            TD::make('birthplace', 'Origen'),
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
            Sight::make('name', 'Nombre Completo'),
            Sight::make('nick', 'Nombre Artístico'),
            Sight::make('birthplace', 'Procedencia'),
            Sight::make('birthdate', 'Fecha de Nacimiento'),
            Sight::make('slug'),
            Sight::make('image', 'Foto')
                ->render(function ($artist) {
                    return '<img src="' . $artist->image . '">';
                }),
            Sight::make('biography', 'Biografía'),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(): array
    {
        return [];
    }

    public static function displayInNavigation(): bool
    {
        return false;
    }


}
