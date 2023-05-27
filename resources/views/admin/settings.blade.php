@extends('admin.layouts.admin')

@section('title', trans('libertybans::admin.settings.title'))

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">

            <form action="{{ route('libertybans.admin.settings') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="driver">{{ trans('libertybans::admin.settings.driver') }}</label>
                    <select class="form-control" id="driver" name="driver" required="required">
                        <option value="mysql" @selected($driver === 'mysql')>MySQL</option>
                        <option value="pgsql" @selected($driver === 'pgsql')>PostgreSQL</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="host">{{ trans('libertybans::admin.settings.host') }}</label>
                    <input class="form-control" id="host" name="host" value="{{ $host }}" required="required" placeholder="127.0.0.1">
                </div>

                <div class="mb-3">
                    <label class="form-label" for="port">{{ trans('messages.fields.port') }}</label>
                    <input class="form-control" id="port" name="port" value="{{ $port }}" required="required" placeholder="3306">
                </div>

                <div class="mb-3">
                    <label class="form-label" for="database">{{ trans('libertybans::admin.settings.database') }}</label>
                    <input class="form-control" id="database" name="database" value="{{ $database }}" required="required" placeholder="libertybans">
                </div>

                <div class="mb-3">
                    <label class="form-label" for="username">{{ trans('libertybans::admin.settings.username') }}</label>
                    <input class="form-control" id="username" name="username" value="{{ $username }}" required="required" placeholder="libertybans">
                </div>
                
                <div class="mb-3">
                    <label class="form-label" for="password">{{ trans('libertybans::admin.settings.password') }}</label>
                    <input type="password" class="form-control" id="password" name="password" value="{{ $password }}" required="required">
                </div>

                <div class="mb-3">
                    <label class="form-label" for="perPage">{{ trans('libertybans::admin.settings.perPage') }}</label>
                    <input type="number" min="1" max="100" class="form-control" id="perPage" name="perPage" value="{{ $perPage }}" required="required" placeholder="10">
                </div>

                <div class="mb-3">
                    <label class="form-label" for="path">{{ trans('libertybans::admin.settings.path') }}</label>
                    <input type="text" class="form-control" id="path" name="path" value="{{ $path }}" required="required" placeholder="libertybans" aria-labelledby="pathHelpBlock">
                    <div id="pathHelpBlock" class="form-text">
                        {!! trans('libertybans::admin.settings.pathHelp', [
                            'baseURL' => url('/')
                        ]) !!}
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> {{ trans('messages.actions.save') }}
                </button>

            </form>

        </div>
    </div>
@endsection
