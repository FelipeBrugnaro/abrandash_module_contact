<div class="card !p-0">
    <div class="card-header">
        <span>
            {{ textLang('last_pending_contacts', 'contact::lang.widgets', [
                'attributes' => 3
            ])}}
        </span>
    </div>
    <div class="card-body">
        <x-admin.elements.table :tools="false" :key="false" :actions="false">
            <x-slot:thead>
                <th>{{ textLang('name', 'contact::lang.thead') }}</th>
                <th>{{ textLang('email', 'contact::lang.thead') }}</th>
                <th>{{ textLang('view', 'contact::lang.thead') }}</th>
            </x-slot:thead>
            <x-slot:tbody>
                @foreach ($contacts as $key => $contact)
                <tr>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>
                        <x-admin.elements.link
                            :href="route(config('contact.routes.show'), ['contact' => $contact->id])"
                            :title="textLang('show', 'contact::lang.tbody')"
                            class="btn btn-primary" />
                    </td>
                <tr>
                @endforeach
            </x-slot:tbody>
        </x-admin.page.table.table>
    </div>
</div>