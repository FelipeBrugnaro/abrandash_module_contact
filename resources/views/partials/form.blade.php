<x-admin.elements.input 
    name="name" 
    :label="textLang('name', 'contact::lang.form')"
    value="{{ $contact->name ?? old('name') }}"
    disabled/>
<div class="grid grid-cols-1 gap-2 md:grid-cols-2">
    <x-admin.elements.input 
        name="phone" 
        :label="textLang('phone', 'contact::lang.form')"
        value="{{ $contact->phone ?? old('phone') }}"
        disabled/>
    <x-admin.elements.input 
        name="email" 
        :label="textLang('email', 'contact::lang.form')"
        value="{{ $contact->email ?? old('email') }}"
        disabled/>
</div>