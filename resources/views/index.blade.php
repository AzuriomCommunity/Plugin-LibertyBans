@extends('layouts.app')

@section('title', trans('libertybans::messages.title'))

@section('content')
    <div>
        <div class="d-flex justify-content-between align-items-center">
            <h1>{{ trans('libertybans::messages.title') }}</h1>

            <form action="{{ route('libertybans.index') }}" method="GET">
                <label for="searchInput" class="form-label sr-only">{{ trans('messages.actions.search') }}</label>

                <div class="input-group">
                    <input type="text" class="form-control" id="searchInput" name="q"
                        value="{{ request()->input('q') }}" placeholder="{{ trans('libertybans::messages.search_placeholder') }}">

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search fa-sm"></i>
                    </button>
                </div>
            </form>
        </div>

        <div class="table-responsive mt-3">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ trans('messages.fields.type') }}</th>
                        <th scope="col">{{ trans('libertybans::messages.victim') }}</th>
                        <th scope="col">{{ trans('libertybans::messages.reason') }}</th>
                        <th scope="col">{{ trans('libertybans::messages.operator') }}</th>
                        <th scope="col">{{ trans('messages.fields.date') }}</th>
                        <th scope="col">{{ trans('libertybans::messages.expires_at') }}</th>
                        <th scope="col" class="text-end">{{ trans('messages.fields.status') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($punishments as $punishment)
                        <tr class="text-nowrap align-middle">
                            <th scope="row">
                                {{ $punishment->id }}
                            </th>
                            <td>
                                @switch($punishment->type)
                                    @case(0)
                                        <span class="badge bg-danger text-uppercase">{{ trans('libertybans::messages.types.ban') }}</span>
                                    @break

                                    @case(1)
                                        <span class="badge bg-light text-uppercase">{{ trans('libertybans::messages.types.mute') }}</span>
                                    @break

                                    @case(2)
                                        <span class="badge bg-warning text-uppercase">{{ trans('libertybans::messages.types.warn') }}</span>
                                    @break

                                    @case(3)
                                        <span class="badge bg-secondary text-uppercase">{{ trans('libertybans::messages.types.kick') }}</span>
                                    @break
                                @endswitch
                            </td>
                            <td class="d-flex align-items-center" data-bs-toggle="tooltip" data-bs-title="UUID: {{ $punishment->victim_uuid }}">
                                <img style="max-width: none;" width="30" height="30" src="https://crafthead.net/avatar/{{ $punishment->victim_uuid }}/30">
                                <span class="ms-2">{{ $punishment->victim_name ?? 'N/A' }}</span>
                            </td>
                            <td>
                                <span>{{ $punishment->reason }}</span>
                            </td>
                            <td class="d-flex align-items-center" data-bs-toggle="tooltip" data-bs-title="UUID: {{ $punishment->operator_uuid }}">
                                <img style="max-width: none;" width="30" height="30" src="https://crafthead.net/avatar/{{ $punishment->operator_uuid }}/30">
                                <span class="ms-2">{{ $punishment->operator_name ?? 'N/A' }}</span>
                            </td>
                            <td>{{ format_date(Carbon\Carbon::createFromTimestamp($punishment->start), true) }}</td>
                            <td>
                                @if ($punishment->end != 0)
                                    {{ format_date(Carbon\Carbon::createFromTimestamp($punishment->end), true) }}</span>
                                @else
                                    {{ trans('libertybans::messages.never') }}
                                @endif
                            </td>
                            <td class="text-end">
                                @if ($punishment->active && !(time() > $punishment->end && $punishment->end != 0))
                                    <span class="badge bg-success">{{ trans('libertybans::messages.active') }}</span>
                                @else
                                    <span class="badge bg-danger">{{ trans('libertybans::messages.finished') }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">{{ trans('libertybans::messages.no_punishments_found') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $punishments->links() }}

        </div>
    </div>
@endsection
