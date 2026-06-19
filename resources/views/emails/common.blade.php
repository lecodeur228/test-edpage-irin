@php
use Creopse\Creopse\Models\AppInformation;

$appNameItem = AppInformation::where('key', 'name')->first();
$appName = $appNameItem ? $appNameItem->value : config('app.name');
@endphp
<x-mail::message>
# {{ $contentData['title'] }}

<p>
{{ $contentData['message'] }}
</p>

@if(!empty($contentData['action_url']) && !empty($contentData['action_text']))
<x-mail::button :url="$contentData['action_url']">
{{ $contentData['action_text'] }}
</x-mail::button>
@endif

@lang('Regards'),<br>
{{ $appName }}
</x-mail::message>
