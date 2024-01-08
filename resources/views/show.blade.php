@extends('admin.layouts.dashboard')
@section('title', textLang('title_show', 'contact::lang'))

@section('page')

@component('admin.components.pages.header', [
    'title' => textLang('title_show', 'contact::lang'),
    'description' => textLang('description_show', 'contact::lang'),
    'btnback' => config('contact.routes.index')
])
@endcomponent

<div class="card">
    @include('contact::partials.form')
    <x-admin.elements.textarea 
            name="message" 
            :label="textLang('message', 'contact::lang.form')"
            cols="30" 
            rows="10"
            minlength="3"
            disabled>
            {{ $contact->message ?? old('message') }}
        </x-admin.elements.textarea>
</div>
@endsection