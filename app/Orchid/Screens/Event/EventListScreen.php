<?php

namespace App\Orchid\Screens\Event;

use App\Models\Event;
use App\Orchid\Layouts\Events\EventListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;


class EventListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'events' => Event::paginate()
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Eventos';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Nuevo Evento')
                ->icon('plus')
                ->route('platform.event.create'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            EventListLayout::class,
        ];
    }
}
