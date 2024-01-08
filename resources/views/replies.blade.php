@extends('admin.layouts.dashboard')
@section('title', textLang('title', 'contact::replies'))

@section('page')

@component('admin.components.pages.header', [
    'title' => textLang('title', 'contact::replies'),
    'description' => textLang('description', 'contact::replies'),
    'btnback' => config('contact.routes.index')
])
@endcomponent

<div class="card">
    <x-admin.elements.table
        :actions="false"
        :paginate="$replies->links('admin.components.paginate')">
        <x-slot:thead>
            <th>{{ textLang('user', 'contact::replies.thead') }}</th>
            <th>{{ textLang('message', 'contact::replies.thead') }}</th>
            <th>{{ textLang('date', 'contact::replies.thead') }}</th>
        </x-slot:thead>
        <x-slot:tbody>
                @foreach ($replies as $key => $reply)
                <tr>
                    <th scope="row">{{ $key }}</th>
                    <td>{{ $reply->user->name }}</td>
                    <td>
                        <x-admin.elements.textarea disabled>
                            {{
                                'Title: '.$reply->message['title'].PHP_EOL.'Message: '.$reply->message['message'] 
                            }}
                        </x-admin.elements.textarea>
                    </td>
                    <td>{{ date('d/m/Y H:i', strtotime($reply->created_at)) }}</td>
                <tr>
                @endforeach
        </x-slot:tbody>
    </x-admin.page.table.table>
</div>
@endsection