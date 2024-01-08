@extends('admin.layouts.dashboard')
@section('title', textLang('title_reply', 'contact::lang'))

@section('page')

@component('admin.components.pages.header', [
    'title' => textLang('title_reply', 'contact::lang'),
    'description' => textLang('description_reply', 'contact::lang'),
    'btnback' => config('contact.routes.index')
])
@endcomponent

<div class="card">
    <form 
        action="{{ route(config('contact.routes.update'), ['contact' => $contact->id]) }}" 
        method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="mt-5 accordion-collapse" id="accordion-collapse" data-accordion="collapse">
            <h2 id="message-accordion-heading-1">
                <button 
                    type="button"  
                    data-accordion-target="#message-accordion-body-1" 
                    aria-expanded="true" 
                    aria-controls="message-accordion">
                    <span>{{ textLang('mail_details', 'contact::lang.form') }}</span>
                    <x-admin.elements.icon 
                        icon="angle-down"
                        class="w-3 h-3 shrink-0" 
                        data-accordion-icon />
                </button>
            </h2>
            <div id="message-accordion-body-1" class="hidden accordion-body" aria-labelledby="message-accordion-heading-1">
                <div class="flex gap-2">
                    <strong>{{ textLang('name', 'contact::lang.form') }}:</strong> 
                    <p>{{ $contact->name }}</p>
                </div>
                <div class="flex gap-2">
                    <strong>{{ textLang('email', 'contact::lang.form') }}:</strong> 
                    <p>{{ $contact->email }}</p>
                </div>
                <div class="flex gap-2">
                    <strong>{{ textLang('phone', 'contact::lang.form') }}:</strong> 
                    <p>{{ $contact->phone }}</p>
                </div>
                <div>
                    <strong>{{ textLang('message', 'contact::lang.form') }}:</strong> 
                    <p>{{ $contact->message }}</p>
                </div>
            </div>
        </div>

        <x-admin.elements.input 
            name="title" 
            :label="textLang('mail_title', 'contact::lang.form')"
            minLength="5" 
            required />

        <x-admin.elements.textarea 
            name="message" 
            :label="textLang('mail_body', 'contact::lang.form')"
            cols="30" 
            rows="10"
            minlength="10"
            required>
        </x-admin.elements.textarea>

        <x-admin.elements.select 
            name="status" 
            :label="textLang('status', 'contact::lang.form')">
            <option 
                value="1" 
                @if ($contact->status == true) selected @endif>
            <span>{{ textLang('Actived') }}</span>
            </option>
            <option 
                value="0" 
                @if ($contact->status == false) selected @endif>
            <span>{{ textLang('Disabled') }}</span>
            </option>
        </x-admin.elements.select>
        
        <div class="flex items-center justify-end gap-3">
            <x-admin.elements.button
                class="mt-4 btn btn-sm btn-primary" 
                type="submit" 
                :title="textLang('reply', 'contact::lang.form')" />
        </div>
    </form>
</div>
@endsection