@extends('admin.layouts.dashboard')
@section('title', textLang('title', 'contact::lang'))

@section('page')

@component('admin.components.pages.header', [
    'title' => textLang('title', 'contact::lang'),
    'description' => textLang('description', 'contact::lang')
])
@if(Auth::user()->permission('REPLIES_HISTORIC_CONTACT'))
@slot('slot')
<a class="btn btn-primary" href="{{ route(config('contact.routes.replies')) }}">
<x-admin.elements.icon 
    icon="timeline" 
    class="inline w-4 h-3 -mt-[3px] mr-2" />
<span>{{ textLang('response_history', 'contact::lang') }}</span>
</a>
@endslot
@endif
@endcomponent

<div class="card">
    <x-admin.elements.table
        :paginate="$contacts->links('admin.components.paginate')">
        <x-slot:thead>
            <th>{{ textLang('name', 'contact::lang.thead') }}</th>
            <th>{{ textLang('email', 'contact::lang.thead') }}</th>
            <th>{{ textLang('phone', 'contact::lang.thead') }}</th>
            <th>{{ textLang('completed', 'contact::lang.thead') }}</th>
            <th>{{ textLang('date', 'contact::lang.thead') }}</th>
        </x-slot:thead>
        <x-slot:tbody>
                @foreach ($contacts as $key => $contact)
                <tr>
                    <th scope="row">{{ $key }}</th>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>
                        @if($contact->completed_id)
                        <span class="text-green-500">
                            {{ textLang('completed', 'contact::lang.tbody') }}
                            <br>
                            <small>{{ $contact->user->name }}</small>    
                        </span>
                        @else
                        <span class="text-red-500">{{ textLang('not_completed', 'contact::lang.tbody') }}</span>
                        @endif
                    </td>
                    <td>{{ date('d/m/Y H:i', strtotime($contact->created_at)) }}</td>
                    <x-admin.elements.table.action>
                        @slot('buttons')
                            <li>
                                <x-admin.elements.link 
                                    :title="textLang('show', 'contact::lang.tbody')" 
                                    :href="route(config('contact.routes.show'), ['contact' => $contact->id])"  
                                    data-te-dropdown-item-ref>
                                    @slot('icon')
                                    <x-admin.elements.icon 
                                        icon="eye" 
                                        class="inline w-3 h-3 -mt-[3px] mr-1" />
                                    @endslot
                                </x-admin.elements-link>
                            </li>
                            @if(Auth::user()->permission('REPLY_CONTACT'))
                            <li>
                                <x-admin.elements.link 
                                    :title="textLang('reply', 'contact::lang.tbody')" 
                                    :href="route(config('contact.routes.reply'), ['contact' => $contact->id])"  
                                    data-te-dropdown-item-ref>
                                    @slot('icon')
                                    <x-admin.elements.icon 
                                        icon="reply" 
                                        class="inline w-3 h-3 -mt-[3px] mr-1" />
                                    @endslot
                                </x-admin.elements-link>
                            </li>
                            @endif
                            @if(Auth::user()->permission('DELETE_CONTACT'))
                            <li>
                            <form 
                                class="block full"
                                action="{{ route(config('contact.routes.delete'), ['contact' => $contact->id]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <x-admin.elements.button 
                                    type="submit" 
                                    :title="textLang('delete', 'contact::lang.tbody')"
                                    data-te-dropdown-item-ref>
                                    @slot('icon')
                                    <x-admin.elements.icon 
                                        icon="trash" 
                                        class="inline w-3 h-3 -mt-[3px] mr-1" />
                                    @endslot
                                </x-admin.elements.button>
                            </form>
                            </li>
                            @endif
                            <li>
                            <form 
                                class="block full"
                                action="{{ route(config('contact.routes.completed'), ['contact' => $contact->id]) }}"
                                method="POST">
                                @csrf
                                <x-admin.elements.button 
                                    type="submit" 
                                    :title="textLang($contact->completed_title, 'contact::lang.tbody')"
                                    data-te-dropdown-item-ref>
                                    @slot('icon')
                                    <x-admin.elements.icon 
                                        icon="rectangle-list" 
                                        class="inline w-3 h-3 -mt-[3px] mr-1" />
                                    @endslot
                                </x-admin.elements.button>
                            </form>
                            </li>
                        @endslot
                    </x-admin.elements.table.action>
                <tr>
                @endforeach
        </x-slot:tbody>
    </x-admin.page.table.table>
</div>
@endsection