@component('profiles.activities.activity')
    @slot('heading')
        {{$profileUser->name}} published
        <a href="{{ $activity->subject->path() }}">"{{ $activity->subject->title }}"</a>
    @endslot

    @slot('body')
        {{ $activity->subject->body }}
    @endslot
@endcomponent

{{--<div class="panel panel-default">--}}
{{--    <div class="panel-heading">--}}
{{--        <div class="level">--}}
{{--            <span class="flex">--}}
{{--                {{$profileUser->name}} published--}}
{{--                <a href="{{ $activity->subject->path() }}">"{{ $activity->subject->title }}"</a>--}}
{{--            </span>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="panel-body">--}}
{{--        {{ $activity->subject->body }}--}}
{{--    </div>--}}
{{--</div>--}}
